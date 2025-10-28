import { generateNavTree } from "./navigationHandler.js";
import { setupElement } from "./dynamicCodeHandler.js";

let ids = [];

// Utility functions for UI feedback
const showLoader = () => {
  const loader = document.createElement("div");
  loader.id = "export-loader";
  loader.innerHTML = `
    <div class="fixed inset-0 flex items-center justify-center z-[9999] backdrop-blur-md bg-white/30">
      <div class="bg-white/95 backdrop-blur-xl rounded-3xl p-10 shadow-2xl max-w-sm w-full mx-4 border border-gray-200/50">
        <div class="flex flex-col items-center space-y-6">
          <div class="relative w-20 h-20">
            <div class="absolute inset-0 border-[5px] border-blue-100 rounded-full"></div>
            <div class="absolute inset-0 border-[5px] border-blue-600 rounded-full border-t-transparent animate-spin"></div>
          </div>
          <div class="text-center space-y-2">
            <h3 class="text-2xl font-bold text-gray-900">Čuvanje u toku</h3>
            <p class="text-base text-gray-600">Molimo sačekajte...</p>
            <div class="flex justify-center space-x-1 pt-2">
              <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0s"></div>
              <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
              <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;
  document.body.appendChild(loader);
};

const hideLoader = () => {
  const loader = document.getElementById("export-loader");
  if (loader) loader.remove();
};

const showMessage = (type, title, message, options = {}) => {
  // options: { duration: number(ms) | null, actions: [{ label, onClick }], dismissible: boolean }
  const {
    duration = type === "success" ? 5000 : null,
    actions = [],
    dismissible = true,
  } = options;

  // If an existing message exists, remove it first (avoid duplicates)
  const existing = document.getElementById("export-message");
  if (existing) existing.remove();

  // SVG icons
  const icons = {
    success: `<svg class="w-14 h-14 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
    error: `<svg class="w-14 h-14 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
    warning: `<svg class="w-14 h-14 text-yellow-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`,
  };

  const bgColors = {
    success: "from-green-50 to-emerald-50",
    error: "from-red-50 to-rose-50",
    warning: "from-yellow-50 to-amber-50",
  };

  const borderColors = {
    success: "border-green-200",
    error: "border-red-200",
    warning: "border-yellow-200",
  };

  // Create modal wrapper
  const modal = document.createElement("div");
  modal.id = "export-message";
  modal.innerHTML = `
    <div id="export-overlay" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-sm">
      <div role="dialog" aria-modal="true" aria-labelledby="export-title" aria-describedby="export-desc"
           class="relative max-w-lg w-full mx-4 transform transition-all duration-400 scale-95 opacity-0 rounded-3xl shadow-2xl border ${
             borderColors[type]
           } overflow-hidden bg-white/95">
        <!-- Close icon (top-right) -->
        <button id="export-close-x" aria-label="Zatvori" class="absolute top-4 right-4 z-20 p-2 rounded-lg hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-offset-2">
          <svg class="w-6 h-6 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <div class="p-8 bg-gradient-to-br ${bgColors[type]} border-b ${
    borderColors[type]
  }">
          <div class="flex items-center justify-center mb-4">
            <div class="flex items-center justify-center w-20 h-20 rounded-full bg-white/60 shadow-inner">
              ${icons[type]}
            </div>
          </div>

          <h3 id="export-title" class="text-2xl md:text-3xl font-extrabold text-slate-900 text-center mb-2">${title}</h3>
          <p id="export-desc" class="text-sm md:text-base text-slate-700 text-center leading-relaxed">${message}</p>
        </div>

        <div class="p-6 bg-white flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
          <div class="flex-1 flex flex-col gap-2 md:flex-row md:items-center">
            ${
              actions.length
                ? actions
                    .map(
                      (a, i) =>
                        `<button data-action-index="${i}" class="action-btn px-4 py-2 rounded-lg text-sm font-semibold border">${a.label}</button>`
                    )
                    .join("")
                : ""
            }
          </div>

          <div class="mt-2 md:mt-0 w-full md:w-auto">
            <button id="export-ok" class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-base font-bold rounded-2xl shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-transform focus:outline-none focus:ring-4 focus:ring-blue-200">
              U redu
            </button>
          </div>
        </div>
      </div>
    </div>
  `;

  // Append style (only once)
  if (!document.getElementById("export-message-styles")) {
    const style = document.createElement("style");
    style.id = "export-message-styles";
    style.textContent = `
      @keyframes modalIn {
        0% { transform: translateY(18px) scale(0.98); opacity: 0 }
        60% { transform: translateY(-6px) scale(1.002); opacity: 1 }
        100% { transform: translateY(0) scale(1); opacity: 1 }
      }
      @keyframes overlayFade {
        from { opacity: 0 } to { opacity: 1 }
      }
      #export-overlay > div { animation: modalIn 420ms cubic-bezier(.16,1,.3,1) forwards; }
      #export-overlay { animation: overlayFade 280ms ease-out forwards; }
    `;
    document.head.appendChild(style);
  }

  document.body.appendChild(modal);

  // Accessibility + behavior
  const overlay = modal.querySelector("#export-overlay");
  const dialog = overlay.querySelector('[role="dialog"]');
  const btnOk = modal.querySelector("#export-ok");
  const btnCloseX = modal.querySelector("#export-close-x");
  const actionButtons = Array.from(modal.querySelectorAll(".action-btn"));

  // Save previously focused element and trap focus
  const previouslyFocused = document.activeElement;
  const focusableSelector =
    'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
  let focusable = Array.from(dialog.querySelectorAll(focusableSelector));
  focusable = focusable.filter((el) => !el.hasAttribute("disabled"));
  const firstFocusable = focusable[0] || btnOk;
  const lastFocusable = focusable[focusable.length - 1] || btnOk;
  firstFocusable.focus();

  // Prevent body scroll
  const prevOverflow = document.body.style.overflow;
  document.body.style.overflow = "hidden";

  // Close handler
  const cleanUp = () => {
    // remove listeners
    document.removeEventListener("keydown", onKeyDown);
    overlay.removeEventListener("click", onOverlayClick);
    btnOk.removeEventListener("click", onOk);
    btnCloseX.removeEventListener("click", onCloseX);
    actionButtons.forEach((b, i) =>
      b.removeEventListener("click", onActionClick)
    );

    // remove element & restore scroll/focus
    const el = document.getElementById("export-message");
    if (el) el.remove();
    document.body.style.overflow = prevOverflow;
    if (previouslyFocused && typeof previouslyFocused.focus === "function")
      previouslyFocused.focus();
  };

  // Event handlers
  const onOk = () => cleanUp();
  const onCloseX = () => cleanUp();
  const onOverlayClick = (e) => {
    if (!dismissible) return;
    if (e.target === overlay) cleanUp();
  };
  const onActionClick = (e) => {
    const idx = Number(e.currentTarget.dataset.actionIndex);
    const act = actions[idx];
    if (act && typeof act.onClick === "function") {
      try {
        act.onClick();
      } catch (err) {
        console.error(err);
      }
    }
  };
  const onKeyDown = (e) => {
    if (e.key === "Escape" && dismissible) {
      e.preventDefault();
      cleanUp();
      return;
    }
    if (e.key === "Tab") {
      // simple focus trap
      if (focusable.length === 0) return;
      if (e.shiftKey) {
        // shift + tab
        if (document.activeElement === firstFocusable) {
          e.preventDefault();
          lastFocusable.focus();
        }
      } else {
        if (document.activeElement === lastFocusable) {
          e.preventDefault();
          firstFocusable.focus();
        }
      }
    }
  };

  // Attach listeners
  document.addEventListener("keydown", onKeyDown);
  overlay.addEventListener("click", onOverlayClick);
  btnOk.addEventListener("click", onOk);
  btnCloseX.addEventListener("click", onCloseX);
  actionButtons.forEach((b, i) => b.addEventListener("click", onActionClick));

  // Auto-close timer
  let timerId = null;
  if (typeof duration === "number" && duration > 0) {
    timerId = setTimeout(() => {
      cleanUp();
    }, duration);
  }

  // Return an object so caller can programmatically close if needed
  return {
    close: () => {
      if (timerId) clearTimeout(timerId);
      cleanUp();
    },
  };
};

// Custom toHTML that fixes < > and injects PHP placeholders
export function toHTMLWithPHP(comp) {
  let html = comp.toHTML();
  html = html.replace(/&lt;/g, "<").replace(/&gt;/g, ">");
  console.log(html);

  const compId = comp.getId();
  if (compId && compId.startsWith("centarzakulturu")) {
    html = `<?php echo htmlspecialchars($dynamicText['${compId}']['text'] ?? 'KULTURNI NEXUS', ENT_QUOTES); ?>`;
  }

  return html;
}

export function handleExport(editor, tipUstanove, komponenta) {
  console.log("Starting export process...");
  console.log("tipUstanove:", tipUstanove);
  console.log("komponenta:", komponenta);

  if (komponenta) {
    return exportComponent(editor, komponenta);
  } else if (tipUstanove) {
    return exportFullPage(editor, tipUstanove);
  }
}

async function exportComponent(editor, komponenta) {
  showLoader();

  const wrapper = editor.DomComponents.getWrapper();
  const combinedHTML = wrapper.toHTML();

  const payload = {
    singlePage: true,
    saveComponents: true,
    components: [komponenta],
    cmp: komponenta,
    html: combinedHTML,
    css: editor.getCss(),
  };

  try {
    const res = await fetch("savePage", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload),
    });

    hideLoader();

    if (!res.ok) {
      const text = await res.text();
      console.log("Error response:", text);
      showMessage(
        "error",
        "Greška pri čuvanju",
        `Server je vratio grešku: ${res.status}`
      );
      return;
    }

    const text = await res.text();
    showMessage(
      "success",
      "Uspešno sačuvano!",
      "Komponenta je uspešno sačuvana."
    );
    console.log("Component saved:", text);
  } catch (err) {
    hideLoader();
    console.error("Error saving component:", err.message);
    showMessage("error", "Greška", `Došlo je do greške: ${err.message}`);
  }
}

function exportFullPage(editor, tipUstanove) {
  showLoader();

  editor.refresh();
  console.log("Exporting full page for type:", tipUstanove);

  const bodyComponent = editor.DomComponents.getWrapper();
  const landingPageFiles = [];
  const tree = [];
  const dynamicTexts = [];

  // Process components
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
        ids.push(setupElement(child, landingPageFiles));
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

  console.log("ids collected from sections:", ids);

  const css = editor.getCss();
  const fullHtml = editor.getHtml();
  const scripts = fullHtml.match(/<script[\s\S]*?<\/script>/gi) || [];
  const js = scripts.join("\n").replace(/&lt;/g, "<").replace(/&gt;/g, ">");

  let tailwindConfig = {};
  try {
    const regex = /tailwind\.config\s*=\s*({[\s\S]*?});/m;
    const match = js.match(regex);
    if (match) {
      tailwindConfig = new Function("return " + match[1])();
      console.log("Tailwind config:", tailwindConfig);
    }
  } catch (e) {
    console.warn("Error parsing Tailwind config:", e);
  }

  const exportData = {
    css: css,
    typeOfInstitution: tipUstanove,
    components: landingPageFiles,
    tree: tree,
    js: js,
    ids: ids,
    tailwind: tailwindConfig,
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
      hideLoader();
      if (!response.ok) {
        throw new Error(`HTTP greška! Status: ${response.status}`);
      }
      return response.text();
    })
    .then((msg) => {
      console.log("Export successful:", msg);
      showMessage(
        "success",
        "Stranica uspešno sačuvana!",
        "Svi fajlovi su uspešno eksportovani."
      );
    })
    .catch((err) => {
      hideLoader();
      console.error("Export error:", err);
      showMessage("error", "Greška pri eksportu", err.message);
    });
}
