import { generateNavTree } from "./navigationHandler.js";
import { setupElement } from "./dynamicCodeHandler.js";

// Custom toHTML that fixes < > and injects PHP placeholders
export function toHTMLWithPHP(comp) {
  // Get normal HTML
  let html = comp.toHTML();

  // Fix encoded < >
  html = html.replace(/&lt;/g, "<").replace(/&gt;/g, ">");
  console.log(html);
  // Get component ID
  const compId = comp.getId();

  // If the component is registered as dynamic text, inject PHP
  // (you can extend this mapping logic later if needed)
  if (compId && compId.startsWith("centarzakulturu")) {
    html = `<?php echo htmlspecialchars($dynamicText['${compId}']['text'] ?? 'KULTURNI NEXUS', ENT_QUOTES); ?>`;
  }

  return html;
}

export function handleExport(editor, tipUstanove, komponenta) {
  if (komponenta) {
    return exportComponent(editor, komponenta);
  } else if (tipUstanove) {
    return exportFullPage(editor, tipUstanove);
  }
}

async function exportComponent(editor, komponenta) {
  const wrapper = editor.DomComponents.getWrapper();
  const combinedHTML = wrapper.toHTML();

  const payload = {
    saveComponents: true,
    components: [komponenta], // ako PageExporter očekuje niz
    cmp: komponenta,
    html: combinedHTML,
  };

  try {
    const res = await fetch("savePage", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload),
    });

    if (!res.ok) {
      const text = await res.text();
      console.log("Error response:", text);
      return;
    }

    const text = await res.text();
    alert("Component saved! Response: " + text);
  } catch (err) {
    console.error("Error saving component: " + err.message);
  }
}

function exportFullPage(editor, tipUstanove) {
  const bodyComponent = editor.DomComponents.getWrapper();
  const landingPageFiles = [];
  const tree = [];
  const dynamicTexts = [];

  bodyComponent.components().each((child) => {
    const tag = child.get("tagName") || child.get("type");
    const pageSlug = tipUstanove.toLowerCase().replace(/[^a-z0-9]+/g, "-");

    switch (tag) {
      case "header":
        generateNavTree(child, tree, "navBarID", "dropdown");
        landingPageFiles.push({
          [`landingPage/${tag}.php`]: toHTMLWithPHP(child),
        });
        break;
      case "section":
        setupElement(child, landingPageFiles);
        break;
      case "footer":
        landingPageFiles.push({
          [`landingPage/${tag}.php`]: toHTMLWithPHP(child),
        });
        break;
      case "div":
        if (child.getId() == "mobileMenu") {
          const _ = [];
          generateNavTree(child, _, "navBarIDm", "mobile-dropdown");
        }
        landingPageFiles.push({
          [`landingPage/${tag}${child.getId()}.php`]: toHTMLWithPHP(child),
        });
        break;
    }
  });

  const css = editor.getCss();
  const fullHtml = editor.getHtml();
  const scripts = fullHtml.match(/<script[\s\S]*?<\/script>/gi) || [];
  const js = scripts.join("\n").replace(/&lt;/g, "<").replace(/&gt;/g, ">");

  const exportData = {
    css: css,
    typeOfInstitution: tipUstanove,
    components: landingPageFiles,
    tree: tree,
    js: js,
  };
  fetch("/admin/savePage.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      ...exportData,
      saveComponents: true,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.text();
    })
    .then((msg) => {
      console.log("Export successful:", msg);
      alert("Page exported successfully!");
    })
    .catch((err) => {
      console.error("Export error:", err);
      alert("Error exporting page: " + err.message);
    });
}
