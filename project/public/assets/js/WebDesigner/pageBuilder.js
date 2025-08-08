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

let isUndoing = false;

// Dugmici i paneli za glavni interfejs
const btns = {
  component: document.getElementById("component"),
  settings: document.getElementById("settingsbtn"),
  nav: document.getElementById("navbtn"),
};
const panels = {
  component: document.getElementById("blocks"),
  settings: document.getElementById("settingsBlock"),
  nav: document.getElementById("navBlock"),
};

// Resetuje sve panele i dugmice
function resetAll() {
  Object.values(btns).forEach((b) => b.classList.remove("primary"));
  Object.values(panels).forEach((p) => {
    p.style.display = "none";
    p.classList.add("hidden");
  });
}

// Kreira handler za prikaz panela
function makeHandler(key) {
  return () => {
    resetAll();
    btns[key].classList.add("primary");
    panels[key].classList.remove("hidden");
    panels[key].style.display = "block";
  };
}

// Dodaje event listenere za dugmice
btns.component.addEventListener("click", makeHandler("component"));
btns.settings.addEventListener("click", makeHandler("settings"));
btns.nav.addEventListener("click", makeHandler("nav"));

// Opcije za linkove
const dynamicOptions = [
  { value: "#home", name: "Home" },
  { value: "#services", name: "Services" },
  { value: "#contact", name: "Contact" },
  { value: "https://example.com", name: "External Link" },
];
const pages = [
  { slug: "/", title: "Početna" },
  { slug: "/about", title: "O Nama" },
];

// Dugmici za promenu uredjaja (desktop/tablet/mobile)
document.querySelectorAll(".device-btn").forEach((btn) =>
  btn.addEventListener("click", () => {
    editor.setDevice(btn.dataset.device);
    document
      .querySelectorAll(".device-btn")
      .forEach((b) => b.classList.toggle("active", b === btn));
  })
);

// Inicijalizacija GrapeJS editora
const editor = grapesjs.init({
  container: "#gjs",
  fromElement: false,
  height: "100%",
  width: "auto",
  parser: {
    optionsHtml: {
      allowScripts: true,
    },
  },
  fromElement: true,
  storageManager: false,
  blockManager: { appendTo: "#blocks" },
  styleManager: { appendTo: "#settingsBlock" },
  panels: { defaults: [] },
  deviceManager: {
    devices: [
      { id: "desktop", name: "Desktop", width: "" },
      { id: "tablet", name: "Tablet", width: "768px" },
      { id: "mobile", name: "Mobile", width: "375px" },
    ],
  },
  canvas: { scripts: ["https://cdn.tailwindcss.com"] },
});

// Azuriranje tipova linkova
function updateLinkType(options) {
  editor.DomComponents.removeType("link");
  editor.DomComponents.addType("link", {
    isComponent: (el) => el.tagName === "A",
    model: {
      defaults: {
        tagName: "a",
        traits: [
          { type: "select", name: "href", options },
          { type: "text", name: "title" },
          { type: "text", name: "data-role" },
          {
            type: "select",
            name: "target",
            options: [
              { value: "_self", name: "Same window" },
              { value: "_blank", name: "New window" },
            ],
          },
        ],
      },
      init() {
        this.listenTo(
          this,
          "change:href change:title change:data-role change:target",
          this.updateAttrs
        ).updateAttrs();
      },
      updateAttrs() {
        const {
          href = "#",
          title = "",
          "data-role": dr,
          target = "_self",
        } = this.attributes;
        this.setAttributes({
          href,
          title,
          target,
          ...(dr && { "data-role": dr }),
        });
      },
    },
    view: { events: { click: (e) => e.preventDefault() } },
  });
}
updateLinkType(pages.map((p) => ({ value: p.slug, name: p.title })));

// Obrada selektovanih komponenti
editor.on("component:selected", (comp) => {
  if (!comp) return;

  // Provera za dugme u mega meniju
  if (comp.getEl()?.tagName?.toLowerCase() === "button") {
    let parent = comp.parent();
    while (parent && !parent.getClasses().includes("megaMenu")) {
      parent = parent.parent();
    }

    if (parent) {
      const processComponent = (component) => {
        const classes = component.getClasses();

        // Zamena 'invisible' klase sa 'visible'
        if (classes.includes("invisible")) {
          component.removeClass("invisible");
          component.addClass("visible");
        }

        // Rekurzivna obrada dece
        const children = component.components();
        children.forEach((child) => processComponent(child));
      };

      processComponent(parent);
    }
  }
});

// Ucitavanje HTML-a i skripti
function injectHTMLAndScripts(container, html) {
  const parser = new DOMParser();
  const doc = parser.parseFromString(html, "text/html");

  // Dodavanje HTML elemenata (bez skripti)
  Array.from(doc.body.childNodes).forEach((node) => {
    if (node.tagName !== "SCRIPT") {
      container.appendChild(node.cloneNode(true));
    }
  });

  // Dodavanje skripti
  const scripts = doc.querySelectorAll("script");
  scripts.forEach((oldScript) => {
    const newScript = document.createElement("script");
    if (oldScript.src) {
      newScript.src = oldScript.src;
      if (oldScript.async) newScript.async = true;
      if (oldScript.defer) newScript.defer = true;
    } else {
      newScript.textContent = oldScript.textContent;
    }
    document.body.appendChild(newScript);
  });
}

// Ucitavanje template-a ili komponente iz URL parametara
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

// Konfiguracija editora nakon ucitavanja
editor.on("load", () => {
  const sm = editor.StyleManager;
  sm.getSectors().reset([]);

  // Dodavanje CSS fajlova u iframe
  const head = editor.Canvas.getFrameEl().contentDocument.head;
  [
    "/output.css",
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css",
  ].forEach((href) =>
    head.appendChild(
      Object.assign(document.createElement("link"), { rel: "stylesheet", href })
    )
  );

  // Brisanje nepotrebnih sektora
  ["osnovno", "razmaci", "granice"].forEach((id) => sm.removeSector(id));

  // Dodavanje Tailwind sektora
  [
    { id: "spacing", name: "Razmaci", buildProps: ["margin", "padding"] },
    {
      id: "typography",
      name: "Tipografija",
      buildProps: [
        "font-family",
        "font-size",
        "font-weight",
        "line-height",
        "text-align",
        "color",
      ],
    },
    {
      id: "background",
      name: "Pozadina",
      buildProps: [
        "background-color",
        "background-image",
        "background-size",
        "background-position",
      ],
    },
    {
      id: "layout",
      name: "Layout",
      buildProps: [
        "display",
        "flex-direction",
        "justify-content",
        "align-items",
        "width",
        "height",
      ],
    },
  ].forEach((cfg) => sm.addSector(cfg.id, cfg));

  // Podesavanje undo/redo dugmica
  const undo = document.getElementById("undo-btn"),
    redo = document.getElementById("redo-btn");
  editor.on("undo redo", () => {
    undo.disabled = !editor.UndoManager.hasUndo();
    redo.disabled = !editor.UndoManager.hasRedo();
  });
  undo.addEventListener("click", () => {
    editor.UndoManager.undo();
    isUndoing = true;
  });
  redo.addEventListener("click", () => {
    editor.UndoManager.redo();
    isUndoing = false;
  });

  // Brisanje elemenata
  function clearElements(element) {
    const newChildren = element
      .components()
      .filter((child) => child.get("tagName") === "i");

    element.components([]);
    newChildren.forEach((child) => element.append(child));
    element.components([newChildren]);
  }

  // Konverzija HTML-a u PHP kod
  function htmlToDynamicCode(target, type) {
    const components = target
      .components()
      .filter((child) => child.get("tagName") === "div");
    const nStartingCards = components.length;

    if (!nStartingCards) return;

    const modelDiv = components[0];
    const inputElements = modelDiv.find("[id^='g-']");

    inputElements.forEach((element) => {
      const key = element.getId().slice(2);
      const tag = element.get("tagName").toLowerCase();

      if (tag === "img") {
        clearElements(element);
        element.addAttributes({
          imageSourceGen: `<?php echo $${type}_item['${key}'] ; ?>`,
        });
      } else {
        clearElements(element);
        element.append([
          {
            type: "textnode",
            content: `<?php echo htmlspecialchars($${type}_item['${key}'] ?? '', ENT_QUOTES); ?>`,
          },
        ]);
      }
    });

    // Generisanje PHP loopa
    let templateHTML = modelDiv
      .toHTML()
      .replace(/\ssrc="[^"]*"/g, "")
      .replace(/imageSourceGen=/g, "src=");

    const phpLoop = `<?php $__i = 0; foreach ($${type} as $${type}_item): if ($__i++ >= ${nStartingCards}) break; ?>\n${templateHTML}\n<?php endforeach; ?>`;

    target.components([]);
    target.append([{ type: "textnode", content: phpLoop }]);
  }

  // Priprema elemenata za eksport
  function setupElement(child, landingPageFiles) {
    const id = child.getId();
    switch (id) {
      case "gallery": {
        const target = child
          .find("*")
          .find((model) => model.getId() === "galleryCards");
        htmlToDynamicCode(target, "images");
        const onceDecoded = child.toHTML().replace(/&amp;/g, "&");
        const fullyDecoded = onceDecoded
          .replace(/&lt;/g, "<")
          .replace(/&gt;/g, ">");
        landingPageFiles.push({
          [`landingPage/${id}.php`]: fullyDecoded,
        });
        break;
      }
      case "events": {
        const target = child
          .find("*")
          .find((model) => model.getId() === "eventsCards");
        htmlToDynamicCode(target, "events");
        const onceDecoded = child.toHTML().replace(/&amp;/g, "&");
        const fullyDecoded = onceDecoded
          .replace(/&lt;/g, "<")
          .replace(/&gt;/g, ">");
        landingPageFiles.push({
          [`landingPage/${id}.php`]: fullyDecoded,
        });
        break;
      }
      default:
        landingPageFiles.push({
          [`landingPage/${id}.php`]: child.toHTML(),
        });
    }
  }

  // Generisanje navigacionog stabla
  function navTree(target, tree, navID, dropDownclass) {
    const nav = target.find("*").find((child) => child.getId() === navID);
    if (!nav) return;

    nav.components().forEach((comp) => {
      if (comp.get("tagName") == "a") {
        const el = comp.view.el;
        let text = el.textContent
          .trim()
          .replace(" ", "-")
          .normalize("NFD")
          .replace(/[\u0300-\u036f]/g, "")
          .replace(/[^\x00-\x7F]/g, "")
          .toLowerCase();

        if (text == "pocetna") text = "";
        comp.addAttributes({ href: "/" + text });
        comp.view.render();
        tree.push({ root: text });
      } else if (comp.getClasses().includes(dropDownclass)) {
        let current;
        comp.components().forEach((ch) => {
          const tag = ch.get("tagName");

          if (tag === "button") {
            const text = ch.view.el.innerText.trim();
            current = { root: text, elements: [] };
            tree.push(current);
          }

          if (tag === "div" && current) {
            ch.components().forEach((link) => {
              if (link.get("tagName") == "a") {
                const el = link.view.el;
                const text = el.textContent
                  .trim()
                  .replace(" ", "-")
                  .replace(/[^\x00-\x7F]/g, "");
                link.addAttributes({
                  href: ("/" + current.root + "/" + text)
                    .toLowerCase()
                    .replace(" ", "-"),
                });
                link.view.render();
                current.elements.push({ root: text });
              }
            });
          }
        });
      }
    });
    return tree;
  }

  // Eksport cele stranice
  function fullPageExport() {
    const bodyComponent = editor.DomComponents.getWrapper();
    const landingPageFiles = [];
    const tree = [];

    bodyComponent.components().each((child) => {
      const tag = child.get("tagName") || child.get("type");
      const classList = child.get("classes");
      const classes = classList
        ? Array.from(classList)
            .map((c) => c.getName())
            .join(".")
        : "";
      switch (tag) {
        case "header":
          navTree(child, tree, "navBarID", "dropdown");
          landingPageFiles.push({
            [`landingPage/${tag}.php`]: child.toHTML(),
          });
          break;
        case "section":
          setupElement(child, landingPageFiles);
          break;
        case "footer":
          landingPageFiles.push({
            [`landingPage/${tag}.php`]: child.toHTML(),
          });
          break;
        case "div":
          if (child.getId() == "mobileMenu") {
            const _ = [];
            navTree(child, _, "navBarIDm", "mobile-dropdown");
          }
          landingPageFiles.push({
            [`landingPage/${tag}${child.getId()}.php`]: child.toHTML(),
          });
      }
    });

    const css = editor.getCss();
    const fullHtml = editor.getHtml();
    const scripts = fullHtml.match(/<script[\s\S]*?<\/script>/gi) || [];
    const js = scripts.join("\n").replace(/&lt;/g, "<").replace(/&gt;/g, ">");

    // Slanje podataka na server
    fetch("/savePage", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        css: css,
        components: landingPageFiles,
        tree: tree,
        js: js,
      }),
    })
      .then((r) => r.text())
      .then((msg) => alert(msg))
      .catch((err) => alert("Error: " + err));
  }

  // Dugme za eksport
  document.getElementById("export").addEventListener("click", async () => {
    if (komponenta) {
      const wrapper = editor.DomComponents.getWrapper();
      const sections = [];

      // Prikupljanje sekcija
      const traverse = (components) => {
        components.each((comp) => {
          if (comp.get("tagName") === "section") {
            sections.push(comp);
          }
          if (comp.components().length) {
            traverse(comp.components());
          }
        });
      };
      traverse(wrapper.components());
      const combinedHTML = sections.map((s) => s.toHTML()).join("");

      // Slanje komponente na server
      const formData = new FormData();
      formData.append("cmp", komponenta);
      formData.append("html", combinedHTML);

      try {
        const res = await fetch("/saveComponent", {
          method: "POST",
          body: formData,
        });

        if (!res.ok) {
          const text = await res.text();
          throw new Error(`Server error (${res.status}): ${text}`);
        }

        const json = await res.json();
        alert("Component saved! Bytes written: " + json.bytes_written);
      } catch (err) {
        alert("Error saving component: " + err.message);
      }
    } else if (tipUstanove) {
      fullPageExport();
    }
  });

  // Prevencija default kombinacija tastatura
  editor.on("keydown", (e) => {
    if ((e.ctrlKey || e.metaKey) && ["z", "y"].includes(e.key)) {
      e.preventDefault();
      alert("Koristite dugmad Poništi/Ponovi na alatnoj traci!");
    }
  });
});

// Registracija blokova
Object.entries({
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
}).forEach(([name, block]) =>
  editor.BlockManager.add(name.replace(/([A-Z])/g, "-$1").toLowerCase(), block)
);
