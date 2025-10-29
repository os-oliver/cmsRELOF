// Initialize GrapesJS editor
const editor = grapesjs.init({
  container: "#previewContent",
  height: "500px",
  storageManager: false,
  plugins: ["grapesjs-preset-webpage"],
  canvas: {
    styles: [
      "https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css",
    ],
  },
  panels: {
    defaults: [],
  },
});

// Helper function to generate CSS variables
function generateCSSVariables(scheme) {
  let css = ":root {\n";
  Object.entries(scheme).forEach(([key, value]) => {
    css += `    --color-${key}: ${value};\n`;
  });
  css += "}";
  return css;
}

// Function to update the preview with current color scheme
function updateLivePreview() {
  const styleSheet = generateCSSVariables(currentScheme);
  editor.setStyle(styleSheet);

  // Create a sample component to preview colors
  const previewHTML = `
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 rounded" style="background-color: var(--color-clay)">
                    <h3 class="text-white">Clay</h3>
                </div>
                <div class="p-4 rounded" style="background-color: var(--color-ochre)">
                    <h3 class="text-white">Ochre</h3>
                </div>
                <!-- Add more color preview elements -->
            </div>
        </div>
    `;

  editor.setComponents(previewHTML);
}

// Event listeners for color changes
Object.keys(currentScheme).forEach((colorKey) => {
  const picker = Pickr.create({
    el: `#${colorKey}Picker`,
    default: currentScheme[colorKey],
    theme: "classic",
    components: {
      preview: true,
      opacity: true,
      hue: true,
      interaction: {
        hex: true,
        rgba: true,
        hsla: true,
        input: true,
        save: true,
      },
    },
  });

  picker.on("save", (color) => {
    currentScheme[colorKey] = color.toHEXA().toString();
    updateLivePreview();
  });
});

// Save color scheme to server
async function saveColorScheme() {
  try {
    const response = await fetch("/api/save-color-scheme", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(currentScheme),
    });

    if (!response.ok) {
      throw new Error("Failed to save color scheme");
    }

    alert("Color scheme saved successfully!");
  } catch (error) {
    console.error("Error saving color scheme:", error);
    alert("Failed to save color scheme");
  }
}

// Load color scheme from server
async function loadColorScheme() {
  try {
    const response = await fetch("/api/load-color-scheme");
    if (!response.ok) {
      throw new Error("Failed to load color scheme");
    }

    const scheme = await response.json();
    currentScheme = scheme;
    updateLivePreview();

    // Update all color pickers
    Object.entries(scheme).forEach(([key, color]) => {
      const picker = document.querySelector(`#${key}Picker`);
      if (picker) {
        picker.setColor(color);
      }
    });
  } catch (error) {
    console.error("Error loading color scheme:", error);
    alert("Failed to load color scheme");
  }
}

// Initialize preview
updateLivePreview();
