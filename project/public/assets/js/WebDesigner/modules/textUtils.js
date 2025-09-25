// Generate// Generate a hash for the element's path
function hashPath(element) {
  const path = [];
  let current = element;
  while (current) {
    const tag = current.get("tagName") || "";
    // Get index among siblings
    let index = 0;
    if (current.parent()) {
      const siblings = current.parent().components();
      siblings.forEach((sibling, idx) => {
        if (sibling === current) index = idx;
      });
    }
    path.unshift(`${tag.toLowerCase()}_${index}`);
    current = current.parent();
  }
  return hashText(path.join("_"));
}
function hashText(text) {
  let hash = 0;
  for (let i = 0; i < text.length; i++) {
    const char = text.charCodeAt(i);
    hash = (hash << 5) - hash + char;
    hash = hash & hash;
  }
  return Math.abs(hash).toString(36).substring(0, 6);
}

// Get occurrence count of similar text in siblings
function getOccurrence(element, text) {
  const siblings = element.parent().components();
  let count = 0;
  siblings.forEach((sibling) => {
    if (sibling === element) return;
    if (sibling.get("content") === text) count++;
  });
  return count;
}

// Generate unique instance key for text content
export function generateInstanceKey(element, text, pageSlug) {
  const pathHash = hashPath(element);
  const textHash = hashText(text);
  const occurrence = getOccurrence(element, text);
  return `${pageSlug}__${pathHash}_${textHash}_occ${occurrence}`;
}

// Check if content needs dynamic replacement
export function needsDynamicReplacement(content) {
  return (
    content &&
    !content.includes("<?php") &&
    content.trim().length > 0 &&
    !/^[\s\d.,!?]+$/.test(content)
  ); // Exclude pure whitespace, numbers, and basic punctuation
}
