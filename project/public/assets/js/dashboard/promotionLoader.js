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
  } catch (err) {
    console.error("Greška pri učitavanju komponente:", err);
    alert(`Greška pri učitavanju: ${err.message}`);
  }
}

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
        styles: [],
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

    // Čekamo da se editor u potpunosti učita
    await new Promise((resolve) => {
      grapesjsEditor.on("load", () => {
        resolve();
      });
    });

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
  } catch (err) {
    console.error("Kritična greška pri inicijalizaciji:", err);
    alert("Kritična greška pri inicijalizaciji editora: " + err.message);
  }
});

// Eksportujemo funkciju za upotrebu iz drugih skripti
window.loadComponentIntoEditor = loadComponentIntoEditor;
