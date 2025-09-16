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

// Initialize editor
const editor = initializeEditor();

// Initialize panels and user interface
initializePanels();

// Handle component selected event
editor.on("component:selected", (comp) => {
  if (!comp) return;

  if (comp.getEl()?.tagName?.toLowerCase() === "button") {
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
  multiLink,
};

Object.entries(blocks).forEach(([name, block]) =>
  editor.BlockManager.add(name.replace(/([A-Z])/g, "-$1").toLowerCase(), block)
);
