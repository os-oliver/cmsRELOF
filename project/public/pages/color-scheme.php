<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Scheme Management</title>
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4A90E2;
            --secondary-color: #2C3E50;
        }

        .color-scheme-container {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .color-group {
            margin-bottom: 20px;
        }

        .color-picker-wrapper {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .color-label {
            min-width: 120px;
            margin-right: 10px;
        }

        .preview-section {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .scheme-actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            background-color: var(--primary-color);
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        #schemePreview {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="color-scheme-container">
        <h1>Color Scheme Management</h1>

        <div class="color-group">
            <h2>Primary Colors</h2>
            <div class="color-picker-wrapper">
                <span class="color-label">Clay:</span>
                <div id="clayPicker" class="color-picker"></div>
            </div>
            <div class="color-picker-wrapper">
                <span class="color-label">Ochre:</span>
                <div id="ochrePicker" class="color-picker"></div>
            </div>
            <div class="color-picker-wrapper">
                <span class="color-label">Sage:</span>
                <div id="sagePicker" class="color-picker"></div>
            </div>
            <!-- Add more primary colors -->
        </div>

        <div class="color-group">
            <h2>Alternative Colors</h2>
            <div class="color-picker-wrapper">
                <span class="color-label">Clay Alt:</span>
                <div id="clayAltPicker" class="color-picker"></div>
            </div>
            <div class="color-picker-wrapper">
                <span class="color-label">Ochre Alt:</span>
                <div id="ochreAltPicker" class="color-picker"></div>
            </div>
            <!-- Add more alternative colors -->
        </div>

        <div class="scheme-actions">
            <button id="saveScheme" class="btn">Save Color Scheme</button>
            <button id="loadScheme" class="btn">Load Saved Scheme</button>
            <button id="previewScheme" class="btn">Preview Changes</button>
        </div>

        <div id="schemePreview" class="preview-section">
            <h3>Preview</h3>
            <div id="previewContent"></div>
        </div>
    </div>

    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

    <script>
        // Current color scheme object
        let currentScheme = {
            clay: '#c97c5d',
            ochre: '#CC8B3C',
            sage: '#81A594',
            slate: '#2C3E50',
            paper: '#FAF9F6',
            terracotta: '#C1666B',
            coral: '#E07A5F',
            'deep-teal': '#2A6F64',
            crimson: '#8B2635',
            'royal-blue': '#4A90E2',
            velvet: '#6B4E71',
            'ochre-alt': '#d4a373',
            'sage-alt': '#a3b18a',
            'slate-alt': '#344e41',
            'paper-alt': '#f5ebe0',
            'terracotta-alt': '#bc6c25',
            'coral-alt': '#e76f51',
            'deep-teal-alt': '#2a9d8f',
            'crimson-alt': '#8d1b3d',
            'royal-blue-alt': '#1a4480',
            'velvet-alt': '#4a154b'
        };

        // Initialize color pickers
        const pickrOptions = {
            theme: 'classic',
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: {
                    hex: true,
                    rgba: true,
                    hsla: true,
                    input: true,
                    save: true
                }
            }
        };

        // Create color pickers for each color
        Object.keys(currentScheme).forEach(colorKey => {
            const pickrElement = document.createElement('div');
            pickrElement.id = `${colorKey}Picker`;
            document.querySelector('.color-group').appendChild(pickrElement);

            const pickr = Pickr.create({
                el: `#${colorKey}Picker`,
                default: currentScheme[colorKey],
                ...pickrOptions
            });

            pickr.on('save', (color) => {
                currentScheme[colorKey] = color.toHEXA().toString();
                updatePreview();
            });
        });

        // Preview functionality
        function updatePreview() {
            const previewContent = document.getElementById('previewContent');
            // Create a preview of how the colors look together
            previewContent.innerHTML = `
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 10px;">
                    ${Object.entries(currentScheme).map(([name, color]) => `
                        <div style="padding: 20px; background: ${color}; color: ${isLightColor(color) ? '#000' : '#fff'}; text-align: center; border-radius: 4px;">
                            ${name}<br>${color}
                        </div>
                    `).join('')}
                </div>
            `;
        }

        // Helper function to determine if a color is light or dark
        function isLightColor(color) {
            const hex = color.replace('#', '');
            const r = parseInt(hex.substr(0, 2), 16);
            const g = parseInt(hex.substr(2, 2), 16);
            const b = parseInt(hex.substr(4, 2), 16);
            const brightness = ((r * 299) + (g * 587) + (b * 114)) / 1000;
            return brightness > 128;
        }

        // Save color scheme
        document.getElementById('saveScheme').addEventListener('click', () => {
            localStorage.setItem('colorScheme', JSON.stringify(currentScheme));
            alert('Color scheme saved!');
        });

        // Load saved scheme
        document.getElementById('loadScheme').addEventListener('click', () => {
            const savedScheme = localStorage.getItem('colorScheme');
            if (savedScheme) {
                currentScheme = JSON.parse(savedScheme);
                updatePreview();
                // Update all color pickers
                Object.entries(currentScheme).forEach(([key, color]) => {
                    const picker = document.querySelector(`#${key}Picker`);
                    if (picker) {
                        picker.value = color;
                    }
                });
            }
        });

        // Preview changes
        document.getElementById('previewScheme').addEventListener('click', updatePreview);

        // Initial preview
        updatePreview();
    </script>
</body>

</html>