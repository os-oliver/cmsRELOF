function initializeDevices() {
  const deviceBtns = document.querySelectorAll(".device-btn");
  if (!deviceBtns) return;

  deviceBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const device = btn.getAttribute("data-device");
      if (!device) return;

      // Update button states
      deviceBtns.forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");

      // Update editor canvas
      if (window.editor) {
        window.editor.setDevice(device);
      }
    });
  });
}

function initializeResponsiveToolbar() {
  const toolbar = document.getElementById("toolbar");
  const toggleToolbar = () => {
    if (!toolbar) return;
    if (window.innerWidth < 768) {
      toolbar.classList.add("collapsed");
    } else {
      toolbar.classList.remove("collapsed");
    }
  };

  window.addEventListener("resize", toggleToolbar);
  toggleToolbar();
}

export function initializeEditor() {
  const editor = grapesjs.init({
    container: "#gjs",
    fromElement: true,
    height: "100%",
    width: "auto",
    parser: {
      optionsHtml: { allowScripts: true },
    },
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

  editor.DomComponents.addType("slider", {
    model: {
      defaults: {
        tagName: "div",
        draggable: true,
        droppable: true,
        selectable: true,
        traits: [
          {
            type: "number",
            name: "slides",
            label: "Slides",
            changeProp: 1,
            min: 1,
            placeholder: 3,
          },
        ],
        script: function () {
          const el = this;
          const track = el.querySelector(".slider-track");
          const items = el.querySelectorAll(".slider-item");
          const prev = el.querySelector(".slider-prev");
          const next = el.querySelector(".slider-next");
          const dotsWrap = el.querySelector(".slider-dots");

          if (!track || items.length === 0) return;

          let idx = 0;
          const total = items.length;

          // resize items responsively
          function resize() {
            const w = el.clientWidth;
            items.forEach((it) => (it.style.width = w + "px"));
            track.style.width = w * total + "px";
            track.style.transform = `translateX(${-idx * w}px)`;
          }
          resize();
          window.addEventListener("resize", resize);

          // dots
          function buildDots() {
            if (!dotsWrap) return;
            dotsWrap.innerHTML = "";
            for (let i = 0; i < total; i++) {
              const d = document.createElement("button");
              d.type = "button";
              d.className = "w-2 h-2 rounded-full bg-white/60";
              d.setAttribute("data-i", i);
              d.style.opacity = i === idx ? "1" : "0.6";
              d.addEventListener("click", () => goTo(i));
              dotsWrap.appendChild(d);
            }
          }
          buildDots();

          function updateDots() {
            if (!dotsWrap) return;
            Array.from(dotsWrap.children).forEach((d, i) => {
              d.style.opacity = i === idx ? "1" : "0.6";
            });
          }

          function goTo(i) {
            const w = el.clientWidth;
            idx = (i + total) % total;
            track.style.transform = `translateX(${-idx * w}px)`;
            updateDots();
          }

          prev && prev.addEventListener("click", () => goTo(idx - 1));
          next && next.addEventListener("click", () => goTo(idx + 1));

          // cleanup
          el._sliderCleanup = function () {
            window.removeEventListener("resize", resize);
          };
        },
      },
    },

    view: {
      onRender({ el }) {
        // simple preview effect (optional)
      },

      onRemove(el) {
        if (el._previewSliderTimer) clearInterval(el._previewSliderTimer);
        if (el._sliderCleanup) el._sliderCleanup();
      },
    },
  });

  // Zabrani drop na body, header, footer
  editor.DomComponents.addType("body", {
    isComponent: (el) => el.tagName === "BODY",
    model: {
      defaults: {
        droppable: false,
        draggable: false,
      },
    },
  });

  editor.DomComponents.addType("header", {
    isComponent: (el) => el.tagName === "HEADER",
    model: {
      defaults: {
        droppable: false,
        draggable: false,
      },
    },
  });

  editor.DomComponents.addType("footer", {
    isComponent: (el) => el.tagName === "FOOTER",
    model: {
      defaults: {
        droppable: false,
        draggable: false,
      },
    },
  });

  // Dozvoli drop samo u <main>
  editor.DomComponents.addType("main", {
    isComponent: (el) => el.tagName === "MAIN",
    model: {
      defaults: {
        droppable: true, // dozvoli da sadrži elemente
        draggable: false, // da se ne može premestiti
        highlightable: true, // vizuelno se označi pri hover/drop
      },
    },
  });
  editor.on("load", () => {
    configureStyleManager(editor);
    setupEditorCSS(editor);
    setupUndoRedo(editor);
    setupLinkLogging(editor);

    // Initialize UI components
    initializeDevices();
    initializeResponsiveToolbar();
    initializeIconChooser();
  });

  window.editor = editor;
  return editor;
}

function configureStyleManager(editor) {
  const sm = editor.StyleManager;
  sm.getSectors().reset([]);

  // Remove unnecessary sectors
  ["osnovno", "razmaci", "granice"].forEach((id) => sm.removeSector(id));

  // Add Tailwind sectors
  const sectors = [
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
  ];

  sectors.forEach((cfg) => sm.addSector(cfg.id, cfg));
}
function setupLinkLogging(editor) {
  const frame = editor.Canvas.getFrameEl();
  const doc = frame.contentDocument || frame.contentWindow.document;
  if (doc._gjs_click_logger_attached) return;
  doc._gjs_click_logger_attached = true;

  // Helper to open the nav link editor and wire apply/reset handlers
  const openNavEditor = (anchorEl, comp) => {
    try {
      // optionally open nav panel trigger
      const navBtn = document.getElementById("navbtn");
      if (navBtn) navBtn.click();

      // elements
      const hrefInput = document.getElementById("linkHref");
      const staticCheckbox = document.getElementById("linkStatic");
      const applyBtn = document.getElementById("applyLink");
      const resetBtn = document.getElementById("resetLink");
      const deleteBtn = document.getElementById("delete");
      if (!hrefInput || !applyBtn || !resetBtn || !deleteBtn) return;

      // store originals for reset
      const originalHref = (anchorEl && anchorEl.getAttribute("href")) || "";
      const originalStatic =
        (anchorEl &&
          (anchorEl.getAttribute("data-static") ||
            anchorEl.getAttribute("static"))) ||
        "";

      // init inputs
      hrefInput.value = originalHref;
      if (staticCheckbox) {
        staticCheckbox.checked =
          originalStatic === "true" ||
          originalStatic === "1" ||
          originalStatic === "yes";
      }

      applyBtn.onclick = () => {
        const newHref = hrefInput.value || "";
        const isStatic = !!(staticCheckbox && staticCheckbox.checked);
        // update GrapesJS component model if available
        if (comp) {
          try {
            if (typeof comp.addAttributes === "function") {
              comp.addAttributes({ href: newHref });
              if (isStatic) {
                comp.addAttributes({ static: "true" });
                comp.addAttributes({ movable: "false" });
              } else if (typeof comp.removeAttributes === "function") {
                comp.removeAttributes(["static"]);
              } else {
                // fallback: remove static from attributes object
                try {
                  const attrs =
                    typeof comp.getAttributes === "function"
                      ? { ...comp.getAttributes() }
                      : { ...(comp.attributes || {}) };
                  delete attrs.static;
                  if (typeof comp.set === "function")
                    comp.set("attributes", attrs);
                } catch (e) {
                  /* ignore fallback errors */
                }
              }
            } else if (typeof comp.set === "function") {
              // fallback: replace attributes object
              const attrs =
                typeof comp.getAttributes === "function"
                  ? { ...comp.getAttributes() }
                  : { ...(comp.attributes || {}) };
              attrs.href = newHref;
              if (isStatic) {
                attrs.static = "true";
                attrs.movable = "false";
              } else delete attrs.static;
              comp.set("attributes", attrs);
            }
          } catch (err) {
            console.warn("Failed to update component attributes:", err);
          }
        }

        // keep iframe/DOM anchor in sync (visual)
        try {
          if (anchorEl) {
            anchorEl.setAttribute("href", newHref);
            if (isStatic) anchorEl.setAttribute("data-static", "true");
            else anchorEl.removeAttribute("data-static");
          }
        } catch (e) {}

        // persist editor state if possible
        try {
          if (window.editor && typeof window.editor.store === "function")
            window.editor.store();
        } catch (e) {}
      };

      // RESET: restore inputs and visual DOM (user must still click Apply to persist)
      // Delete link handler
      deleteBtn.onclick = () => {
        if (comp) {
          try {
            console.log("Removing component", comp);
            // Remove component from editor
            comp.remove();
          } catch (err) {
            console.warn("Failed to remove component:", err);
          }
        }

        // Remove the anchor from DOM
        if (anchorEl && anchorEl.parentNode) {
          // Keep the content inside the anchor
          while (anchorEl.firstChild) {
            anchorEl.parentNode.insertBefore(anchorEl.firstChild, anchorEl);
          }
          anchorEl.parentNode.removeChild(anchorEl);
        }

        // Close nav editor if open
        const navBtn = document.getElementById("navbtn");
        if (navBtn) navBtn.click();

        // Store editor state
        try {
          if (window.editor && typeof window.editor.store === "function") {
            window.editor.store();
          }
        } catch (e) {}
      };

      resetBtn.onclick = () => {
        hrefInput.value = originalHref;
        if (staticCheckbox)
          staticCheckbox.checked =
            originalStatic === "true" ||
            originalStatic === "1" ||
            originalStatic === "yes";

        try {
          if (comp) {
            // restore model attr if possible
            if (typeof comp.addAttributes === "function") {
              comp.addAttributes({ href: originalHref });
              if (originalStatic)
                comp.addAttributes({ static: originalStatic });
              else if (typeof comp.removeAttributes === "function")
                comp.removeAttributes(["static"]);
            } else if (typeof comp.set === "function") {
              const attrs =
                typeof comp.getAttributes === "function"
                  ? { ...comp.getAttributes() }
                  : { ...(comp.attributes || {}) };
              attrs.href = originalHref;
              if (originalStatic) attrs.static = originalStatic;
              else delete attrs.static;
              comp.set("attributes", attrs);
            }
          }

          if (anchorEl) {
            anchorEl.setAttribute("href", originalHref);
            if (originalStatic)
              anchorEl.setAttribute("data-static", originalStatic);
            else anchorEl.removeAttribute("data-static");
          }
        } catch (e) {}
      };
    } catch (err) {
      console.error("openNavEditor error", err);
    }
  };

  // Intercept clicks inside the canvas, find anchors and open the editor
  doc.addEventListener(
    "click",
    (e) => {
      try {
        const wrapper = editor.DomComponents.getWrapper();

        const el = e.target;
        if (!el) return;
        console.log("Clicked element:", el);
        console.log("ClassList:", el.classList.value);
        console.log(
          "Has slide-overlay?",
          el.classList.contains("slide-overlay")
        );
        console.log("Inside slider-item?", !!el.closest(".slider-item"));
        console.log("Clickedfds asd:", el);
        console.log(el.classList.contains("slider-overlay"));
        console.log(el.classList);
        if (
          el.closest(".slider-item") &&
          el.classList.contains("slide-overlay")
        ) {
          console.log("Clicked inside slider-item");
          const sliderItem = el.closest(".slider-item");
          const imgEl = sliderItem.querySelector("img");
          console.log("Found img element:", imgEl);
          if (imgEl) {
            const imgCmp = editor
              .getWrapper()
              .find(`[src="${imgEl.getAttribute("src") || ""}"]`)[0];
            if (imgCmp) {
              editor.select(imgCmp);
              editor.runCommand("open-assets", { target: imgCmp });
            }
          }
        }

        // If click is on an <i> (icon) element, open the icon chooser in parent doc
        if (el.tagName && el.tagName.toLowerCase() === "i") {
          try {
            const anchorForIcon = el.closest && el.closest("a");
            const parentDoc = window.parent && window.parent.document;
            if (parentDoc) {
              // find component: prefer ID, else match element node
              let comp = null;
              try {
                const wrapper = editor.DomComponents.getWrapper();
                const id = anchorForIcon && anchorForIcon.id;
                if (id) comp = wrapper.find("#" + id)[0] || null;
                if (!comp && anchorForIcon) {
                  const all = wrapper.find();
                  for (let i = 0; i < all.length; i++) {
                    const c = all[i];
                    try {
                      const elFromComp =
                        typeof c.getEl === "function" ? c.getEl() : c.el;
                      if (elFromComp === anchorForIcon) {
                        comp = c;
                        break;
                      }
                    } catch (ee) {}
                  }
                }
              } catch (err) {
                comp = null;
              }

              // store the clicked icon DOM element, its nearest anchor, and the GrapesJS component (if found)
              parentDoc._gjs_icon_click_target = {
                anchor: anchorForIcon,
                iconEl: el,
                comp,
                anchorId: anchorForIcon && anchorForIcon.id,
              };
              const chooser = parentDoc.getElementById("iconChooser");
              if (chooser) {
                chooser.classList.remove("hidden");
                chooser.classList.add("flex");
              }
            }

            return;
          } catch (e) {
            // ignore errors here
          }
        }

        const anchor = el.closest && el.closest("a");
        if (!anchor) return;

        // Prevent actual navigation
        let comp = null;
        const id = anchor.id;
        comp = wrapper.find("#" + id)[0];
        openNavEditor(anchor, comp);
      } catch (err) {
        // swallow to avoid breaking editor
      }
    },
    true
  );
}

function initializeIconChooser() {
  const chooser = document.getElementById("iconChooser");
  const closeBtn = document.getElementById("closeIconChooser");
  const grid = document.getElementById("iconGrid");
  const colorInput = document.getElementById("iconColor");
  const sizeSelect = document.getElementById("iconSize");
  const previewI = document.getElementById("iconPreviewI");
  const applyBtn = document.getElementById("applyIconAndColor");
  const resetBtn = document.getElementById("resetIconAndColor");

  function closeChooser() {
    if (!chooser) return;
    chooser.classList.add("hidden");
    chooser.classList.remove("flex");
    if (document._gjs_icon_click_target) delete document._gjs_icon_click_target;
  }

  if (closeBtn) closeBtn.addEventListener("click", closeChooser);

  // Icon grid click handling
  if (grid) {
    grid.addEventListener("click", (ev) => {
      const btn = ev.target.closest(".icon-item");
      if (!btn) return;
      const iconClass = btn.getAttribute("data-icon");
      if (!iconClass) return;
      if (previewI) {
        console.log("Setting preview icon class to", iconClass);
        previewI.className = iconClass + " " + (sizeSelect?.value || "text-lg");
      }
      document._gjs_icon_choice = { iconClass };
    });
  }

  // Color and size preview updates
  if (colorInput) {
    colorInput.addEventListener("input", () => {
      if (previewI) previewI.style.color = colorInput.value;
    });
  }
  if (sizeSelect) {
    sizeSelect.addEventListener("change", () => {
      if (previewI && document._gjs_icon_choice?.iconClass) {
        previewI.className =
          document._gjs_icon_choice.iconClass + " " + sizeSelect.value;
      }
    });
  }

  // Apply icon changes
  if (applyBtn) {
    applyBtn.addEventListener("click", () => {
      const target = document._gjs_icon_click_target;
      if (!target) return closeChooser();

      const chosen = document._gjs_icon_choice || {};
      const iconClass = (chosen.iconClass || "").trim();
      const color = colorInput?.value || "";
      const sizeClass = sizeSelect?.value || "";

      try {
        if (target.iconEl) {
          console.log(
            target.iconEl,
            "Applying icon",
            iconClass,
            color,
            sizeClass
          );
          let id = target.iconEl.id;
          const wrapper = editor.DomComponents.getWrapper();
          let comp = null;
          if (id) comp = wrapper.find("#" + id)[0] || null;
          console.log("Setting preview icon class to", comp);
          if (comp) {
            // 🔹 Remove all classes
            comp.setClass([]);
            // Set base classes first
            comp.setClass([
              "mr-2",
              "group-hover:text-sage",
              "transition-colors",
              "text-sm",
              `text-[${color}]`,
            ]);

            // 🔹 Add the new class dynamically
            comp.addClass(iconClass);
            console.log("Updated component classes to", comp.getClasses());
          }
        }

        if (target.anchor) {
          target.anchor.setAttribute("data-icon", iconClass);
          target.anchor.setAttribute("data-icon-color", color);
          target.anchor.setAttribute("data-icon-size", sizeClass);
        }
      } catch (err) {
        console.error("Apply icon error", err);
      }

      closeChooser();
    });
  }

  // Reset icon chooser
  if (resetBtn) {
    resetBtn.addEventListener("click", () => {
      document._gjs_icon_choice = null;
      if (previewI) {
        previewI.className = "fas fa-home text-2xl";
        previewI.style.color = "#000";
      }
      if (colorInput) colorInput.value = "#000000";
      if (sizeSelect) sizeSelect.value = "text-lg";
    });
  }
}

function setupEditorCSS(editor) {
  const head = editor.Canvas.getFrameEl().contentDocument.head;
  const cssLinks = [
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css",
  ];

  cssLinks.forEach((href) => {
    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;
    head.appendChild(link);
  });
}

function setupUndoRedo(editor) {
  const undo = document.getElementById("undo-btn");
  const redo = document.getElementById("redo-btn");

  editor.on("undo redo", () => {
    undo.disabled = !editor.UndoManager.hasUndo();
    redo.disabled = !editor.UndoManager.hasRedo();
  });

  undo.addEventListener("click", () => editor.UndoManager.undo());
  redo.addEventListener("click", () => editor.UndoManager.redo());

  // Prevent default keyboard shortcuts
  editor.on("keydown", (e) => {
    if ((e.ctrlKey || e.metaKey) && ["z", "y"].includes(e.key)) {
      e.preventDefault();
      alert("Koristite dugmad Poništi/Ponovi na alatnoj traci!");
    }
  });
}
