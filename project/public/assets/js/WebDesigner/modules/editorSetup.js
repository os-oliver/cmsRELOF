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

  // Configure editor styles after load
  editor.on("load", () => {
    configureStyleManager(editor);
    setupEditorCSS(editor);
    setupUndoRedo(editor);
  });

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
