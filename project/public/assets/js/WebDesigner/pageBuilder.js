import { topNavbarComponent } from "./components/tNavBar.js";
import { heroGradient } from "./components/heroGradient.js";
import { heroVideo } from "./components/heroVideo.js";
import { featuresGrid } from "./components/featuresGrid.js";
import { testimonial } from "./components/testimonials.js";
import { contactForm } from "./components/contactForm.js";
import { footer } from "./components/footer.js";
import { pricing } from "./components/pricing.js";
import { stats } from "./components/stats.js";
import { teamSection } from "./components/teamSection.js";
import { buttonComponent } from "./components/button.js";
import { gallery } from "./components/gallery.js";
import { faqSection } from "./components/faqSection.js";
import { link } from "./components/link.js";
import { multiLink } from "./components/multinav.js";

import { initializeEditor } from "./modules/editorSetup.js";
import { initializePanels } from "./modules/panelManager.js";
import { handleExport } from "./modules/exportHandler.js";
import { generateNavTree } from "./modules/navigationHandler.js";
import { setupElement } from "./modules/dynamicCodeHandler.js";
import { megaMenu } from "./components/megaMenu.js";

// Wait for DOM to be fully loaded
document.addEventListener("DOMContentLoaded", async () => {
  try {
    // Initialize editor
    const editor = initializeEditor();
    // expose editor globally for simple integrations
    window._grapesEditor = editor;

    // Wait for editor to be ready
    await new Promise((resolve) => {
      editor.on("load", () => {
        console.log("Editor loaded successfully");
        resolve();
      });
    });

    // Initialize panels and user interface
    initializePanels();

    // Keep track of last selected link component and its DOM element to toggle highlight
    let lastSelectedLink = null;
    let lastSelectedLinkEl = null;

    // Inject CSS into editor canvas to highlight selected link (only inside canvas)
    const injectSelectedLinkStyle = () => {
      try {
        const head = editor.Canvas.getFrameEl().contentDocument.head;
        if (!head.querySelector("#gjs-selected-link-style")) {
          const style = document.createElement("style");
          style.id = "gjs-selected-link-style";
          // inject rule into the canvas iframe so it only affects canvas elements
          // target only anchors and their children so other elements are unaffected
          style.textContent = `a.selected-link-editor, a.selected-link-editor * { color: #ffffff !important; outline: 2px dashed rgba(255,255,255,0.2); }`;
          head.appendChild(style);
        }
      } catch (e) {
        // ignore if cross-origin or not available yet
      }
    };
    injectSelectedLinkStyle();

    // Handle component selected event
    editor.on("component:selected", (comp) => {
      if (!comp) return;

      // Robust detection: prefer tagName, fallback to type
      const tagFromModel =
        (comp.get && comp.get("tagName")) ||
        (comp.get && comp.get("type")) ||
        "";
      const elTag = (comp.getEl && comp.getEl()?.tagName) || tagFromModel || "";
      const normTag = String(elTag).toLowerCase();

      // Remove highlight from previous selection if it's not the same
      if (lastSelectedLink && lastSelectedLink !== comp) {
        try {
          if (lastSelectedLinkEl) {
            try {
              lastSelectedLinkEl.style.color = "";
              lastSelectedLinkEl.style.outline = "";
            } catch (e) {}
            lastSelectedLinkEl = null;
          }
        } catch (e) {}
        lastSelectedLink = null;
      }

      // If an anchor (<a>) is selected, open nav panel and populate fields
      if (normTag === "a") {
        // ensure nav panel is visible
        document.getElementById("navbtn").click();

        // style the actual DOM element inside the editor canvas so styling is local and removable
        try {
          const el = comp.view && comp.view.el;
          if (el) {
            if (lastSelectedLinkEl && lastSelectedLinkEl !== el) {
              try {
                lastSelectedLinkEl.style.color = "";
                lastSelectedLinkEl.style.outline = "";
              } catch (e) {}
            }
            try {
              el.style.color = "#ffffff";
              el.style.outline = "2px dashed rgba(255,255,255,0.2)";
            } catch (e) {}
            lastSelectedLinkEl = el;
          }
          lastSelectedLink = comp;
        } catch (e) {
          console.error("Could not style selected link element", e);
        }

        // compute visible text and attributes (detailed extraction will follow below)

        const hrefInput = document.getElementById("linkHref");
        const textInput = document.getElementById("linkText");
        const applyBtn = document.getElementById("applyLink");
        const resetBtn = document.getElementById("resetLink");

        if (!hrefInput || !textInput || !applyBtn || !resetBtn) return;

        // Safely get attributes/text
        const attrs = comp.getAttributes ? comp.getAttributes() : {};
        hrefInput.value = attrs.href || "";
        // get inner text if available
        const inner = comp.getEl() ? comp.getEl().textContent.trim() : "";
        textInput.value = inner || comp.get("content") || "";

        // Keep shared current link target in sync so parent-side handlers (apply/delete)
        // which are attached once can operate on the currently selected link.
        try {
          const anchorEl = comp.getEl ? comp.getEl() : null;
          const originalStatic = attrs["data-static"] || attrs["static"] || "";
          window._gjs_current_link = window._gjs_current_link || {};
          window._gjs_current_link.anchor = anchorEl;
          window._gjs_current_link.comp = comp;
          window._gjs_current_link.originalHref = attrs.href || "";
          window._gjs_current_link.originalStatic = originalStatic;
        } catch (e) {
          // ignore
        }

        // Apply handler
        const applyHandler = () => {
          const newHref = hrefInput.value;
          const newText = textInput.value;
          try {
            comp.addAttributes && comp.addAttributes({ href: newHref });
            // update view text / content — preserve other child elements if they exist by replacing only text nodes
            try {
              const childs = comp.components && comp.components();
              if (
                childs &&
                childs.length &&
                childs.some((c) => c.get && c.get("type") !== "textnode")
              ) {
                // remove existing textnode children and append new textnode, preserving non-text children
                const preserved = [];
                childs.forEach((c) => {
                  if (c.get && c.get("type") !== "textnode") preserved.push(c);
                });
                comp.components([]);
                preserved.forEach((p) => comp.append(p));
                if (newText)
                  comp.append([{ type: "textnode", content: newText }]);
              } else {
                // simple replace
                comp.components([]);
                if (newText)
                  comp.append([{ type: "textnode", content: newText }]);
              }
            } catch (innerErr) {
              // fallback
              comp.components && comp.components([]);
              if (newText)
                comp.append &&
                  comp.append([{ type: "textnode", content: newText }]);
            }

            // re-render component view if possible
            if (comp.view && comp.view.render) comp.view.render();
          } catch (e) {
            console.error("Failed to apply link changes", e);
          }
        };

        const resetHandler = () => {
          hrefInput.value = attrs.href || "";
          textInput.value = inner || comp.get("content") || "";
        };

        // Use direct assignment to avoid accumulating handlers on repeated selections
        applyBtn.onclick = applyHandler;
        resetBtn.onclick = resetHandler;

        return;
      }

      if (normTag === "button") {
        let parent = comp.parent();
        while (parent && !parent.getClasses().includes("megaMenu")) {
          parent = parent.parent();
        }

        if (parent) {
          const processComponent = (component) => {
            if (component.getClasses().includes("invisible")) {
              component.removeClass("invisible");
              component.addClass("visible");
            }
            component.components().forEach((child) => processComponent(child));
          };
          processComponent(parent);
        }
      }
    });

    // Prevent anchor navigation inside the grapesjs canvas and map clicks to selection
    try {
      const frameEl = editor.Canvas.getFrameEl();
      const frameDoc = frameEl && frameEl.contentDocument;
      if (frameDoc) {
        frameDoc.addEventListener(
          "click",
          (e) => {
            try {
              const a = e.target.closest && e.target.closest("a");
              if (!a) return;
              // prevent navigation
              e.preventDefault();
              e.stopPropagation();

              // find component whose view.el is this anchor (or contains it)
              const wrapper = editor.DomComponents.getWrapper();
              const found =
                wrapper.find &&
                wrapper.find((m) => {
                  try {
                    return (
                      (m.view && m.view.el === a) ||
                      (m.view &&
                        m.view.el &&
                        m.view.el.contains &&
                        m.view.el.contains(a))
                    );
                  } catch (e) {
                    return false;
                  }
                });
              if (found && found.length) {
                editor.select(found[0]);
              }
            } catch (err) {
              // ignore errors inside iframe click handling
            }
          },
          true
        );
      }
    } catch (e) {
      // ignore if iframe not accessible yet
    }

    // Ensure highlight removed when deselected or removed
    try {
      editor.on("component:deselected", (comp) => {
        if (lastSelectedLink) {
          try {
            if (lastSelectedLinkEl) {
              lastSelectedLinkEl.style.color = "";
              lastSelectedLinkEl.style.outline = "";
              lastSelectedLinkEl = null;
            }
          } catch (e) {}
          lastSelectedLink = null;
        }
      });
    } catch (e) {}

    try {
      editor.on("component:remove", (comp) => {
        if (lastSelectedLink && lastSelectedLink === comp) {
          try {
            if (lastSelectedLinkEl) {
              lastSelectedLinkEl.style.color = "";
              lastSelectedLinkEl.style.outline = "";
              lastSelectedLinkEl = null;
            }
          } catch (e) {}
          lastSelectedLink = null;
        }
      });
    } catch (e) {}

    // Load template or component from URL parameters
    const params = new URLSearchParams(location.search);
    const tipUstanove = params.get("tipUstanove");
    const komponenta = params.get("komponenta");

    if (tipUstanove) {
      fetch(`/template?tipUstanove=${encodeURIComponent(tipUstanove)}`)
        .then((r) => (r.ok ? r.text() : Promise.reject("Not found")))
        .then((html) => editor.setComponents(html))
        .catch(console.error);
    } else if (komponenta) {
      fetch(`/component?cmp=${encodeURIComponent(komponenta)}`)
        .then((r) =>
          r.ok ? r.text() : Promise.reject("Nije pronađena komponenta")
        )
        .then((html) => editor.setComponents(html))
        .catch(console.error);
    }

    // Export button handler
    document.getElementById("export").addEventListener("click", () => {
      handleExport(editor, tipUstanove, komponenta);
    });

    // Register blocks
    const blocks = {
      heroGradient,
      heroVideo,
      topNavbarComponent,
      featuresGrid,
      testimonial,
      contactForm,
      footer,
      pricing,
      stats,
      teamSection,
      buttonComponent,
      gallery,
      faqSection,
      link,
      megaMenu,
      multiLink,
    };

    Object.entries(blocks).forEach(([name, block]) =>
      editor.BlockManager.add(
        name.replace(/([A-Z])/g, "-$1").toLowerCase(),
        block
      )
    );

    // Listen for device change events from panelManager
    window.addEventListener("webdesigner:setDevice", (e) => {
      try {
        const device = e.detail.device;
        if (device && editor && typeof editor.setDevice === "function") {
          editor.setDevice(device);
        }
      } catch (err) {
        console.error("Failed to set device", err);
      }
    });
  } catch (error) {
    console.error("Error initializing editor:", error);
  }
}); // End of DOMContentLoaded event listener
