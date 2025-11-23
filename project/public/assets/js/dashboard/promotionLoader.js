// Pomoćna funkcija za čekanje da se element pojavi u DOM-u
const waitForEl = (selector, timeout = 3000, interval = 100) =>
  new Promise((resolve, reject) => {
    const t0 = Date.now();
    const i = setInterval(() => {
      const el = document.querySelector(selector);
      if (el) {
        clearInterval(i);
        resolve(el);
      } else if (Date.now() - t0 > timeout) {
        clearInterval(i);
        reject(new Error("Element nije pronađen: " + selector));
      }
    }, interval);
  });

// Globalna promenljiva za editor
let grapesjsEditor = null;

// Funkcija za učitavanje komponente u GrapesJS editor
async function loadComponentIntoEditor(componentPath) {
  if (!grapesjsEditor) {
    console.error("GrapesJS editor nije inicijalizovan!");
    return;
  }

  try {
    const res = await fetch(componentPath);

    if (!res.ok) {
      throw new Error(`Neuspešno učitavanje komponente (${res.status})`);
    }

    const html = await res.text();

    grapesjsEditor.setComponents(html);

    const wrapper = grapesjsEditor.DomComponents.getWrapper();
    wrapper.view.render();
    // After rendering components, initialize sliders inside the canvas so next/prev/indicators work
    try {
      initializeCanvasSliders(grapesjsEditor);
    } catch (err) {
      console.warn("initializeCanvasSliders failed:", err);
    }
  } catch (err) {
    console.error("Greška pri učitavanju komponente:", err);
    alert(`Greška pri učitavanju: ${err.message}`);
  }
}

// Initialize sliders inside the editor canvas (per-slider, resilient)
function initializeCanvasSliders(editor) {
  try {
    const frame = editor.Canvas.getFrameEl();
    const win = frame.contentWindow;
    const doc = frame.contentDocument;
    if (!doc) return;

    const sliders = Array.from(
      doc.querySelectorAll(".slider, #slider, .carousel")
    );
    if (!sliders.length) return;

    sliders.forEach((slider) => {
      if (slider.dataset.gjsSliderInit === "1") return; // already initialized
      slider.dataset.gjsSliderInit = "1";

      const track =
        slider.querySelector(".slider-track") ||
        slider.querySelector("#slider") ||
        slider.querySelector(".slider-wrapper");
      const items = Array.from(slider.querySelectorAll(".slider-item"));
      const prevBtn =
        slider.querySelector(".slider-prev") ||
        slider.querySelector(".prevButton") ||
        slider.querySelector("#prevButton");
      const nextBtn =
        slider.querySelector(".slider-next") ||
        slider.querySelector(".nextButton") ||
        slider.querySelector("#nextButton");
      const dotsWrap =
        slider.querySelector(".slider-dots") ||
        slider.querySelector(".slider-indicators") ||
        slider.querySelector(".indicators");
      const indicators = dotsWrap
        ? Array.from(dotsWrap.children)
        : Array.from(slider.querySelectorAll(".slider-indicator"));

      let current = 0;
      const total = items.length;
      let intervalId = null;

      function apply() {
        if (!track) return;
        const w =
          slider.clientWidth ||
          (items[0] && items[0].clientWidth) ||
          slider.offsetWidth;
        items.forEach((it) => (it.style.width = w + "px"));
        track.style.width = w * total + "px";
        track.style.transform = `translateX(${-current * w}px)`;
        if (indicators && indicators.length) {
          indicators.forEach((ind, i) =>
            ind.classList.toggle("active", i === current)
          );
        }
      }

      function showIndex(i) {
        if (!total) return;
        current = (i + total) % total;
        apply();
      }

      function next() {
        showIndex(current + 1);
      }

      function prev() {
        showIndex(current - 1);
      }

      function startAuto() {
        if (intervalId) clearInterval(intervalId);
        if (total > 1) intervalId = setInterval(next, 5000);
        slider.dataset.gjsSlideInterval = intervalId || "";
      }

      function stopAuto() {
        if (intervalId) clearInterval(intervalId);
        intervalId = null;
        slider.dataset.gjsSlideInterval = "";
      }

      // Wire controls
      if (nextBtn)
        nextBtn.addEventListener("click", (e) => {
          e.preventDefault();
          next();
          stopAuto();
          startAuto();
        });
      if (prevBtn)
        prevBtn.addEventListener("click", (e) => {
          e.preventDefault();
          prev();
          stopAuto();
          startAuto();
        });

      if (indicators && indicators.length) {
        indicators.forEach((ind, idx) => {
          ind.addEventListener("click", (e) => {
            e.preventDefault();
            showIndex(idx);
            stopAuto();
            startAuto();
          });
        });
      }

      // Expose simple controls on the canvas window for compatibility with other scripts
      if (!win.prevSlide) win.prevSlide = prev;
      if (!win.nextSlide) win.nextSlide = next;
      if (!win.goToSlide) win.goToSlide = showIndex;

      // Also expose instance methods on the slider element itself so callers
      // from the parent document can target the specific slider that was
      // interacted with (avoids global functions clobbered by multiple sliders).
      try {
        slider._gjsNext = next;
        slider._gjsPrev = prev;
        slider._gjsGoTo = showIndex;
      } catch (err) {
        /* ignore */
      }

      // Initial layout
      apply();
      startAuto();

      // Resize handling
      const onResize = () => apply();
      win.addEventListener("resize", onResize);
      // store cleanup
      slider._gjsCleanup = () => win.removeEventListener("resize", onResize);
    });
  } catch (err) {
    console.warn("initializeCanvasSliders error:", err);
  }
}

// --- Editor helper functions (adapted from editorSetup.js) ---
function setupEditorCSS(editor) {
  try {
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
  } catch (err) {
    console.warn("setupEditorCSS failed:", err);
  }
}

function setupUndoRedo(editor) {
  try {
    const undo = document.getElementById("undo-btn");
    const redo = document.getElementById("redo-btn");

    // If controls are not present, silently return
    if (!undo || !redo) return;

    editor.on("undo redo", () => {
      undo.disabled = !editor.UndoManager.hasUndo();
      redo.disabled = !editor.UndoManager.hasRedo();
    });

    undo.addEventListener("click", () => editor.UndoManager.undo());
    redo.addEventListener("click", () => editor.UndoManager.redo());

    // Prevent default keyboard shortcuts in the editor canvas
    editor.on("keydown", (e) => {
      if ((e.ctrlKey || e.metaKey) && ["z", "y"].includes(e.key)) {
        e.preventDefault();
        // Lightweight UX: notify user to use toolbar buttons
        alert("Koristite dugmad Poništi/Ponovi na alatnoj traci!");
      }
    });
  } catch (err) {
    console.warn("setupUndoRedo failed:", err);
  }
}

function setupLinkLogging(editor) {
  try {
    const frame = editor.Canvas.getFrameEl();
    const doc = frame.contentDocument || frame.contentWindow.document;
    if (!doc || doc._gjs_click_logger_attached) return;
    doc._gjs_click_logger_attached = true;

    const openNavEditor = (anchorEl, comp) => {
      try {
        // Get the modal elements
        const navBlock = parent.document.getElementById("navBlock");
        const hrefInput = parent.document.getElementById("linkHref");
        const linkTextInput = parent.document.getElementById("linkText");
        const applyBtn = parent.document.getElementById("applyLink");

        if (!navBlock || !hrefInput || !linkTextInput || !applyBtn) {
          console.error("Required modal elements not found");
          return;
        }

        // Store current elements for later use
        window.currentEditingAnchor = anchorEl;
        window.currentEditingComponent = comp;

        // Get current values
        const currentHref = anchorEl.getAttribute("href") || "";
        const currentText = anchorEl.textContent.trim() || "";

        // Update input fields
        hrefInput.value = currentHref;
        linkTextInput.value = currentText;

        // Show the modal
        navBlock.classList.remove("hidden");

        // Wire up apply button
        applyBtn.onclick = () => {
          const newHref = hrefInput.value || "";
          const newText = linkTextInput.value || "";

          // Update component if available
          if (comp && typeof comp.addAttributes === "function") {
            try {
              comp.addAttributes({ href: newHref });
              comp.components(newText);
            } catch (e) {
              console.warn("Failed to update component:", e);
            }
          }

          // Update DOM element
          try {
            anchorEl.setAttribute("href", newHref);
            anchorEl.textContent = newText;

            // Show success notification
            const notification = document.createElement("div");
            notification.className =
              "fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-[9999] flex items-center";
            notification.innerHTML = `
              <i class="fas fa-check-circle mr-2"></i>
              <span>Link je uspešno ažuriran!</span>
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
              notification.remove();
            }, 3000);
          } catch (e) {
            console.warn("Failed to update anchor element:", e);

            // Show error notification
            const notification = document.createElement("div");
            notification.className =
              "fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-[9999] flex items-center";
            notification.innerHTML = `
              <i class="fas fa-exclamation-circle mr-2"></i>
              <span>Greška pri ažuriranju linka!</span>
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
              notification.remove();
            }, 3000);
          }
        };
      } catch (err) {
        console.warn("openNavEditor error", err);
      }
    };
    let current = 0;

    doc.addEventListener(
      "click",
      (e) => {
        console.log("current:", current);
        try {
          const slides = doc?.querySelectorAll(".slider-item") || [];
          const indicators = doc?.querySelectorAll(".slider-indicator") || [];
          function showSlide(idx) {
            current = idx;

            slides.forEach((slide, i) => {
              slide.style.display = i === current ? "block" : "none";
            });

            indicators.forEach((ind, i) => {
              ind.classList.toggle("active", i === current);
            });
          }
          const wrapper = editor.DomComponents.getWrapper();
          let el = e.target;
          if (!el) return;
          if (el.nodeType === 3) el = el.parentElement;

          // Slider controls handling
          const sliderControl = el.closest(
            ".slider-control, .slider-indicator, .nextButton, .slider-next"
          );

          const prev = doc.getElementById("prevButton");
          const next = doc.getElementById("nextButton");
          console.log("current:", current);

          if (el === prev) {
            current = (current - 1 + slides.length) % slides.length;
            showSlide(current);
            console.log("prevSlide");
            return;
          }

          if (el === next) {
            console.log("current:", current);

            current = (current + 1) % slides.length;
            console.log("current:", current);

            showSlide(current);
            console.log(current);
            console.log("nextSlide");
            return;
          }
          // Slider item or image clicked
          const sliderItem = el.closest(".slider-item");
          console.log("evo me", el);
          window.goToSlide?.(1);
          const frame = editor.Canvas.getFrameEl();
          // Prefer the frame's window (more reliable) and fall back to
          // editor.Canvas.getWindow() only if available; finally fall back
          // to the current window. Call nextSlide safely.
          const win =
            (frame &&
              (frame.contentWindow ||
                (frame.contentDocument &&
                  frame.contentDocument.defaultView))) ||
            (editor?.Canvas && typeof editor.Canvas.getWindow === "function"
              ? editor.Canvas.getWindow()
              : null) ||
            window;

          // Prefer calling instance-specific methods on the slider element
          // (if present) so we advance the correct slider. Fall back to
          // canvas-global nextSlide/goToSlide when no instance method exists.
          const sliderEl =
            el.closest(".slider, #slider, .carousel") ||
            (sliderControl && sliderControl.closest
              ? sliderControl.closest(".slider, #slider, .carousel")
              : null) ||
            (sliderItem && sliderItem.closest
              ? sliderItem.closest(".slider, #slider, .carousel")
              : null);

          if (sliderEl && typeof sliderEl._gjsNext === "function") {
            try {
              sliderEl._gjsNext();
            } catch (err) {
              console.warn("sliderEl._gjsNext failed:", err);
            }
          } else if (sliderEl && typeof sliderEl._gjsGoTo === "function") {
            try {
              sliderEl._gjsGoTo(1);
            } catch (err) {
              console.warn("sliderEl._gjsGoTo failed:", err);
            }
          } else if (typeof win?.nextSlide === "function") {
            try {
              win.nextSlide();
            } catch (err) {
              console.warn("nextSlide invocation failed:", err);
            }
          }

          // Fallback: if the above didn't visibly change the slider, try
          // dispatching a native click on the slider's next control inside
          // the iframe — this triggers any handlers attached directly to
          // the DOM by component scripts.
          try {
            console.log("EVO ME");

            if (sliderEl) {
              const nextControl = sliderEl.querySelector(
                ".slider-next, .nextButton, #nextButton, .slider-control.right"
              );
              console.log("EVO ME");

              if (nextControl && typeof nextControl.click === "function") {
                console.log("EVO ME");
                // Use a small timeout to allow previous invocation to settle
                setTimeout(() => {
                  try {
                    nextControl.click();
                    console.log(
                      "Dispatched native click to slider next control"
                    );
                  } catch (err) {
                    console.warn(
                      "Failed to dispatch native click on next control:",
                      err
                    );
                  }
                }, 10);
              }
            }
          } catch (err) {
            console.warn("Fallback next control click failed:", err);
          }

          console.log(
            "editor.Canvas.getWindow",
            typeof editor?.Canvas?.getWindow === "function"
              ? "function"
              : editor?.Canvas?.getWindow
          );
          console.log("canvas window nextSlide", typeof win?.nextSlide);

          if (sliderItem) {
            // Ignore clicks on typical text/content
            if (
              el.matches &&
              el.matches(
                "h1, h2, h3, h4, h5, h6, p, span, button, div.hero-content > *, a, i"
              )
            )
              return;

            const targetImg = sliderItem.querySelector("img");
            if (!targetImg) return;

            e.preventDefault();
            e.stopPropagation();

            const imgSrc =
              targetImg.getAttribute("src") || targetImg.dataset?.src || "";
            const escaped = imgSrc.replace(/"/g, '\\"');
            let imgCmp = null;

            if (imgSrc) {
              imgCmp =
                wrapper.find(`[src="${escaped}"]`)[0] ||
                wrapper.find(`[attributes.data-src="${escaped}"]`)[0] ||
                wrapper.find(`[src*="${escaped}"]`)[0];
            }

            if (!imgCmp) {
              const allImgs = wrapper.find("img");
              for (let i = 0; i < allImgs.length; i++) {
                const c = allImgs[i];
                try {
                  const elFromComp =
                    typeof c.getEl === "function" ? c.getEl() : c.el;
                  if (elFromComp?.tagName?.toLowerCase() === "img") {
                    const compSrc =
                      elFromComp.getAttribute("src") ||
                      elFromComp.dataset?.src ||
                      "";
                    if (compSrc === imgSrc) {
                      imgCmp = c;
                      break;
                    }
                  }
                } catch (err) {
                  console.warn("Error checking image component:", err);
                }
              }
            }

            if (imgCmp) {
              editor.select(imgCmp);
              editor.runCommand("open-assets", { target: imgCmp });
              return;
            }
          }

          // Icon (i) clicks: expose to parent chooser if present
          if (el.tagName && el.tagName.toLowerCase() === "i") {
            const anchorForIcon = el.closest("a");
            const parentDoc = parent.document;
            if (parentDoc) {
              try {
                let comp = null;
                const id = anchorForIcon?.id;
                if (id) comp = wrapper.find("#" + id)[0] || null;
                if (!comp && anchorForIcon) {
                  const all = wrapper.find();
                  for (let i = 0; i < all.length; i++) {
                    const c = all[i];
                    const elFromComp =
                      typeof c.getEl === "function" ? c.getEl() : c.el;
                    if (elFromComp === anchorForIcon) {
                      comp = c;
                      break;
                    }
                  }
                }

                parentDoc._gjs_icon_click_target = {
                  anchor: anchorForIcon,
                  iconEl: el,
                  comp,
                  anchorId: anchorForIcon?.id,
                };

                const chooser = parentDoc.getElementById("iconChooser");
                if (chooser) {
                  chooser.classList.remove("hidden");
                  chooser.classList.add("flex");
                }
              } catch (err) {
                console.warn("Error handling icon click:", err);
              }
              return;
            }
          }

          // Link clicks
          const anchor = el.closest("a");
          if (!anchor) return;

          let comp = null;
          const id = anchor.id;
          try {
            if (id) comp = wrapper.find("#" + id)[0];
            if (!comp) {
              const all = wrapper.find();
              for (let i = 0; i < all.length; i++) {
                const c = all[i];
                const elFromComp =
                  typeof c.getEl === "function" ? c.getEl() : c.el;
                if (elFromComp === anchor) {
                  comp = c;
                  break;
                }
              }
            }
          } catch (err) {
            console.warn("Error finding link component:", err);
          }

          // Show nav block with animation
          const nb = document.getElementById("navBlock");
          if (nb) {
            nb.classList.remove("hidden");
            nb.classList.add("flex");
            // Focus the document select after showing
            setTimeout(() => {
              const select = document.getElementById("documentSelect");
              if (select) select.focus();
            }, 100);
          }
          openNavEditor(anchor, comp);
        } catch (err) {
          console.error("Click handler error:", err);
        }
      },
      true
    );
  } catch (err) {
    console.warn("setupLinkLogging failed:", err);
  }
}

// --------------------------------------------------------------

// Glavna logika koja se pokreće kada se učita cela stranica
document.addEventListener("DOMContentLoaded", async () => {
  try {
    const gjsContainer = document.getElementById("gjs");
    if (!gjsContainer) {
      console.error("Element #gjs nije pronađen! Inicijalizacija prekinuta.");
      return;
    }

    // Inicijalizacija GrapesJS editora
    grapesjsEditor = grapesjs.init({
      container: "#gjs",
      fromElement: false,
      height: "600px",
      width: "auto",
      storageManager: false,

      // Canvas settings
      canvas: {
        scripts: [
          "https://cdn.tailwindcss.com",
          "/exportedPages/commonScript.js",
        ],
        styles: ["/exportedPages/commonStyle.css"],
      },

      // Device Manager
      deviceManager: {
        devices: [
          {
            name: "Desktop",
            width: "",
          },
          {
            name: "Tablet",
            width: "768px",
          },
          {
            name: "Mobile",
            width: "320px",
          },
        ],
      },

      // Panels
      panels: {
        defaults: [
          {
            id: "basic-actions",
            el: ".panel__basic-actions",
            buttons: [
              {
                id: "visibility",
                active: true,
                className: "btn-toggle-borders",
                label: '<i class="fa fa-clone"></i>',
                command: "sw-visibility",
              },
              {
                id: "preview",
                className: "btn-preview",
                label: '<i class="fa fa-eye"></i>',
                command: "preview",
              },
              {
                id: "fullscreen",
                className: "btn-fullscreen",
                label: '<i class="fa fa-arrows-alt"></i>',
                command: "fullscreen",
              },
            ],
          },
          {
            id: "panel-devices",
            el: ".panel__devices",
            buttons: [
              {
                id: "device-desktop",
                label: '<i class="fa fa-desktop"></i>',
                command: "set-device-desktop",
                active: true,
              },
              {
                id: "device-tablet",
                label: '<i class="fa fa-tablet"></i>',
                command: "set-device-tablet",
              },
              {
                id: "device-mobile",
                label: '<i class="fa fa-mobile"></i>',
                command: "set-device-mobile",
              },
            ],
          },
        ],
      },

      // Commands
      commands: {
        defaults: [
          {
            id: "set-device-desktop",
            run(editor) {
              editor.setDevice("Desktop");
            },
          },
          {
            id: "set-device-tablet",
            run(editor) {
              editor.setDevice("Tablet");
            },
          },
          {
            id: "set-device-mobile",
            run(editor) {
              editor.setDevice("Mobile");
            },
          },
        ],
      },
    });

    // Register slider and container component types (adapted from editorSetup.js)
    try {
      const editor = grapesjsEditor;

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
              const track =
                el.querySelector(".slider-track") ||
                el.querySelector(".slider-wrapper");
              const items = el.querySelectorAll(".slider-item");
              const prev =
                el.querySelector(".slider-prev") ||
                el.querySelector(".slider-control.left");
              const next =
                el.querySelector(".slider-next") ||
                el.querySelector(".slider-control.right");
              const dotsWrap =
                el.querySelector(".slider-dots") ||
                el.querySelector(".slider-indicators");

              if (!track || items.length === 0) return;

              let idx = 0;
              const total = items.length;

              function resize() {
                const w = el.clientWidth;
                items.forEach((it) => (it.style.width = w + "px"));
                track.style.width = w * total + "px";
                track.style.transform = `translateX(${-idx * w}px)`;
              }
              resize();
              window.addEventListener("resize", resize);

              function buildDots() {
                if (!dotsWrap) return;
                dotsWrap.innerHTML = "";
                for (let i = 0; i < total; i++) {
                  const d = document.createElement("button");
                  d.type = "button";
                  d.className =
                    "slider-indicator w-3 h-3 rounded-full bg-white/30";
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
                  d.classList.toggle("active", i === idx);
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

              // expose functions to canvas window
              if (window) {
                window.prevSlide = () => goTo(idx - 1);
                window.nextSlide = () => goTo(idx + 1);
                window.goToSlide = goTo;
              }

              // handle clicking images inside slider
              el.addEventListener("click", (e) => {
                const overlay = e.target.closest(
                  ".slider-overlay, .slide-overlay"
                );
                const sliderItem = e.target.closest(".slider-item");
                if (overlay && sliderItem) {
                  const imgEl = sliderItem.querySelector("img");
                  if (imgEl && window.editor) {
                    const imgSrc =
                      imgEl.getAttribute("src") || imgEl.dataset?.src || "";
                    const escaped = imgSrc.replace(/"/g, '\\"');
                    const cmp =
                      window.editor
                        .getWrapper()
                        .find(`[src="${escaped}"]`)[0] ||
                      window.editor
                        .getWrapper()
                        .find(`[attributes.data-src="${escaped}"]`)[0];
                    if (cmp) {
                      console.log("Selecting image component in slider:", cmp);
                      window.editor.select(cmp);
                      window.editor.runCommand("open-assets", {
                        target: cmp,
                      });
                    }
                  }
                }
              });

              el._sliderCleanup = () =>
                window.removeEventListener("resize", resize);
            },
          },
        },

        view: {
          onRender({ el }) {},
          onRemove(el) {
            if (el._sliderCleanup) el._sliderCleanup();
          },
        },
      });

      // Prevent drop on body/header/footer and allow only <main>
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

      editor.DomComponents.addType("main", {
        isComponent: (el) => el.tagName === "MAIN",
        model: {
          defaults: {
            droppable: true,
            draggable: false,
            highlightable: true,
          },
        },
      });
    } catch (err) {
      console.warn("Registering slider/component types failed:", err);
    }

    // Wait for the editor to load and wire helper functions when it does (like editorSetup.js)
    grapesjsEditor.on("load", () => {
      try {
        // make available globally (parent) like in editorSetup
        window.editor = grapesjsEditor;

        setupEditorCSS(grapesjsEditor);
        setupUndoRedo(grapesjsEditor);
        setupLinkLogging(grapesjsEditor);

        // initialize sliders inside canvas for default content
        try {
          initializeCanvasSliders(grapesjsEditor);
        } catch (err) {
          console.warn("initializeCanvasSliders failed on load:", err);
        }
      } catch (err) {
        console.warn("Failed to initialize editor helpers:", err);
      }
    });

    // Also await load so subsequent code runs after editor is ready
    await new Promise((resolve) => grapesjsEditor.on("load", resolve));

    // Wire up link chooser behaviors
    const select = document.getElementById("documentSelect");
    const pageSelect = document.getElementById("pageSelect");
    const hrefInput = document.getElementById("linkHref");
    const linkTextInput = document.getElementById("linkText");
    const navBlock = document.getElementById("navBlock");

    if (select && pageSelect && hrefInput && linkTextInput) {
      // Handler for both selects to update href
      const onSelectChange = (e) => {
        const value = e.target.value;
        if (value) {
          // Clear the other select
          const otherSelect = e.target === select ? pageSelect : select;
          otherSelect.value = "";
          // Update href
          hrefInput.value = value;
        }
      };

      select.addEventListener("change", onSelectChange);
      pageSelect.addEventListener("change", onSelectChange);

      // Show/hide nav block
      const navClose = document.getElementById("navClose");
      if (navClose && navBlock) {
        navClose.addEventListener("click", () => {
          navBlock.classList.remove("flex");
          navBlock.classList.add("hidden");
        });
      }
    }

    // Učitavanje trenutne aktivne komponente u editor
    const currentComponentNameEl = document.querySelector(
      "[data-current-component]"
    );
    if (currentComponentNameEl) {
      const componentFile = currentComponentNameEl.dataset.currentComponent;
      const componentPath = `/exportedPages/landingPageComponents/landingPage/${componentFile}`;

      await loadComponentIntoEditor(componentPath);
    } else {
      grapesjsEditor.setComponents(`
        <div style="padding: 40px; text-align: center; font-family: Arial, sans-serif;">
          <h1 style="color: #3B82F6; font-size: 2em; margin-bottom: 20px;">
            <i class="fas fa-cube"></i> Dobrodošli u Editor
          </h1>
          <p style="color: #64748B; font-size: 1.2em;">
            Izaberite komponentu za uređivanje.
          </p>
        </div>
      `);
    }

    // --- LOGIKA ZA ČUVANJE KOMPONENTE ---
    let exportBtn = document.getElementById("export");

    if (!exportBtn) {
      console.warn(
        "Dugme za izvoz (#export) nije pronađeno — čuvanje je isključeno."
      );
    } else {
      exportBtn.addEventListener("click", async () => {
        const originalText = exportBtn.innerHTML;

        try {
          // Proveravamo da li postoji trenutna komponenta
          const currentComponentNameEl = document.querySelector(
            "[data-current-component]"
          );

          if (!currentComponentNameEl) {
            alert("Nema izabrane komponente za čuvanje!");
            return;
          }

          const componentFileName =
            currentComponentNameEl.dataset.currentComponent;

          // Menjamo dugme da prikaže da se čuva
          exportBtn.disabled = true;
          exportBtn.innerHTML =
            '<i class="fas fa-spinner fa-spin mr-2"></i>Čuvam...';

          // Uzimamo HTML iz editora
          const wrapper = grapesjsEditor.DomComponents.getWrapper();
          const htmlContent = wrapper.toHTML();

          // Kreiramo FormData za slanje
          const formData = new FormData();
          formData.append("componentFileName", componentFileName);
          formData.append("htmlContent", htmlContent);

          // Šaljemo POST zahtev na server
          const res = await fetch("/save-component", {
            method: "POST",
            body: formData,
          });

          const responseText = await res.text();

          if (!res.ok) {
            throw new Error(
              `Greška na serveru (${res.status}): ${responseText}`
            );
          }

          // Pokušavamo da parsiramo JSON odgovor
          let json;
          try {
            json = JSON.parse(responseText);
          } catch (e) {
            // Ako nije JSON, proveravamo da li je plain text success
            if (responseText.toLowerCase().includes("success")) {
              exportBtn.innerHTML =
                '<i class="fas fa-check mr-2"></i>Sačuvano!';
              setTimeout(() => {
                exportBtn.innerHTML = originalText;
                exportBtn.disabled = false;
              }, 2000);
              return;
            }
            console.log(responseText);
            throw new Error("Server je vratio nevalidan format odgovora");
          }

          if (json.success) {
            exportBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Sačuvano!';

            // Prikazujemo success poruku
            const feedback = document.createElement("div");
            feedback.className =
              "fixed top-4 right-4 bg-green-50 border border-green-200 rounded-lg px-4 py-3 text-green-700 shadow-lg z-50";
            feedback.innerHTML = `
              <div class="flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>Komponenta <strong>${componentFileName}</strong> uspešno sačuvana!</span>
              </div>
            `;
            document.body.appendChild(feedback);

            setTimeout(() => {
              feedback.remove();
              exportBtn.innerHTML = originalText;
              exportBtn.disabled = false;
            }, 3000);
          } else {
            throw new Error(
              json.error || json.message || "Nepoznata greška servera"
            );
          }
        } catch (err) {
          console.error("Greška prilikom čuvanja:", err);

          exportBtn.innerHTML = '<i class="fas fa-times mr-2"></i>Greška';

          // Prikazujemo error poruku
          const errorFeedback = document.createElement("div");
          errorFeedback.className =
            "fixed top-4 right-4 bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-red-700 shadow-lg z-50";
          errorFeedback.innerHTML = `
            <div class="flex items-center gap-2">
              <i class="fas fa-exclamation-circle"></i>
              <span>Greška: ${err.message}</span>
            </div>
          `;
          document.body.appendChild(errorFeedback);

          setTimeout(() => {
            errorFeedback.remove();
            exportBtn.innerHTML = originalText;
            exportBtn.disabled = false;
          }, 4000);
        }
      });
    }
    // --- KRAJ LOGIKE ZA ČUVANJE ---

    // Opciono: Dodavanje event listener-a za direktno učitavanje komponenti
    document.querySelectorAll("[data-load-component]").forEach((btn) => {
      btn.addEventListener("click", async (e) => {
        e.preventDefault();
        const componentPath = btn.dataset.loadComponent;
        await loadComponentIntoEditor(componentPath);
      });
    });

    // --- Client-side augmentation: populate #documentSelect with pages.json if available ---
    try {
      const select = document.getElementById("documentSelect");
      if (select) {
        const resp = await fetch("/assets/data/pages.json");
        if (resp.ok) {
          const pages = await resp.json();
          if (Array.isArray(pages)) {
            pages.forEach((p) => {
              const href = p.href || p.path || "";
              const label = p.name || p.file || href;
              if (!href) return;
              // Avoid duplicates (value match)
              const exists = Array.from(select.options).some(
                (o) =>
                  o.value === href || o.value === "/uploads/documents/" + href
              );
              if (exists) return;
              const opt = document.createElement("option");
              opt.value = href;
              opt.textContent = label;
              select.appendChild(opt);
            });
          }
        }
      }
    } catch (e) {
      console.warn("Failed to augment documentSelect with pages.json", e);
    }
  } catch (err) {
    console.error("Kritična greška pri inicijalizaciji:", err);
    alert("Kritična greška pri inicijalizaciji editora: " + err.message);
  }
});

// Eksportujemo funkciju za upotrebu iz drugih skripti
window.loadComponentIntoEditor = loadComponentIntoEditor;
