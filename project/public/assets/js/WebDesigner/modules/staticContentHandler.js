import { generateInstanceKey, needsDynamicReplacement } from "./textUtils.js";

function processTextNode(textNode, pageSlug) {
  try {
    const content = textNode.get("content");
    if (!content || !needsDynamicReplacement(content)) return null;

    const instanceKey = generateInstanceKey(textNode, content, pageSlug);
    return {
      key: instanceKey,
      originalContent: content,
      php: `<?php echo htmlspecialchars($dynamicText['${instanceKey}']['text'] ?? '${content}', ENT_QUOTES); ?>`,
    };
  } catch (error) {
    console.error("Error processing text node:", error);
    return null;
  }
}

export function processStaticContent(component, pageSlug, dynamicTexts = []) {
  if (!component || !pageSlug) return dynamicTexts;

  try {
    // Process text nodes
    if (component.get("type") === "textnode") {
      const result = processTextNode(component, pageSlug);
      if (result) {
        dynamicTexts.push({
          id: result.key,
          content: result.originalContent,
        });
        component.set("content", result.php);
      }
      return dynamicTexts;
    }

    // Skip processing for script and style tags
    const tagName = component.get("tagName");
    if (["script", "style"].includes(tagName?.toLowerCase()))
      return dynamicTexts;

    // Process children recursively
    const components = component.components();
    if (components && typeof components.forEach === "function") {
      components.forEach((child) => {
        if (child) {
          processStaticContent(child, pageSlug, dynamicTexts);
        }
      });
    }

    return dynamicTexts;
  } catch (error) {
    console.error("Error processing static content:", error);
    return dynamicTexts;
  }
}
