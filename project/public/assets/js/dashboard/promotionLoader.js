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
    console.log("Učitavam komponentu:", componentPath);
    const res = await fetch(componentPath);

    if (!res.ok) {
      throw new Error(`Neuspešno učitavanje komponente (${res.status})`);
    }

    const html = await res.text();
    console.log("HTML učitan, dužina:", html.length);

    // Postavljamo komponentu u editor
    grapesjsEditor.setComponents(html);

    // Dodatno - refresh canvas
    const wrapper = grapesjsEditor.DomComponents.getWrapper();
    wrapper.view.render();

    console.log(`Komponenta uspešno učitana: ${componentPath}`);
  } catch (err) {
    console.error("Greška pri učitavanju komponente:", err);
    alert(`Greška pri učitavanju: ${err.message}`);
  }
}

// Glavna logika koja se pokreće kada se učita cela stranica
document.addEventListener("DOMContentLoaded", async () => {
  try {
    console.log("Pokrećem inicijalizaciju GrapesJS...");

    // Proveravamo da li postoji #gjs element
    const gjsContainer = document.getElementById("gjs");
    if (!gjsContainer) {
      console.error("Element #gjs nije pronađen!");
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

    console.log("GrapesJS inicijalizovan, čekam 'load' event...");

    // Čekamo da se editor u potpunosti učita
    await new Promise((resolve) => {
      grapesjsEditor.on("load", () => {
        console.log("GrapesJS editor učitan!");
        resolve();
      });
    });

    // Učitavanje trenutne aktivne komponente u editor
    const currentComponentName = document.querySelector(
      "[data-current-component]"
    );
    if (currentComponentName) {
      const componentFile = currentComponentName.dataset.currentComponent;
      const componentPath = `/exportedPages/landingPageComponents/landingPage/${componentFile}`;

      console.log("Učitavam aktivnu komponentu:", componentFile);
      await loadComponentIntoEditor(componentPath);
    } else {
      console.warn("Nema aktivne komponente za učitavanje.");
      // Postavi default sadržaj
      grapesjsEditor.setComponents(`
        <div style="padding: 40px; text-align: center; font-family: Arial, sans-serif;">
          <h1 style="color: #3B82F6; font-size: 2em; margin-bottom: 20px;">
            <i class="fas fa-cube"></i> Dobrodošli u Editor
          </h1>
          <p style="color: #64748B; font-size: 1.2em;">
            Izaberite komponentu za uređivanje koristeći dugmiće ispod.
          </p>
        </div>
      `);
    }

    // Pronalazimo i postavljamo osluškivač događaja na dugme za izvoz
    let exportBtn = document.getElementById("export");

    if (!exportBtn) {
      console.warn(
        "Dugme za izvoz (#export) nije pronađeno — izvoz je isključen."
      );
    } else {
      exportBtn.addEventListener("click", async () => {
        try {
          const wrapper = grapesjsEditor.DomComponents.getWrapper();
          const combinedHTML = wrapper.toHTML();

          console.log("Izvozim HTML, dužina:", combinedHTML.length);

          const formData = new FormData();
          formData.append("cmp", "true");
          formData.append("html", combinedHTML);

          const res = await fetch("/saveLandigPageComponent", {
            method: "POST",
            body: formData,
          });

          const responseText = await res.text();
          console.log("Odgovor servera:", responseText);

          if (!res.ok) {
            throw new Error(
              `Greška na serveru (${res.status}): ${responseText}`
            );
          }

          try {
            const json = JSON.parse(responseText);
            console.log("Uspešno sačuvano:", json);
            alert(
              "Komponenta je sačuvana! Broj zapisanih bajtova: " +
                (json.bytes_written ?? "nepoznato")
            );
          } catch (jsonError) {
            console.error("Odgovor nije validan JSON:", jsonError);
            // Možda je server vratio običan tekst umesto JSON
            if (
              responseText.includes("success") ||
              responseText.includes("saved")
            ) {
              alert("Komponenta je sačuvana!");
            } else {
              throw new Error("Server je vratio nevalidan format.");
            }
          }
        } catch (err) {
          console.error("Greška prilikom čuvanja:", err.message);
          alert("Greška prilikom čuvanja komponente: " + err.message);
        }
      });
    }

    // Opciono: Dodavanje event listener-a za direktno učitavanje komponenti
    document.querySelectorAll("[data-load-component]").forEach((btn) => {
      btn.addEventListener("click", async (e) => {
        e.preventDefault();
        const componentPath = btn.dataset.loadComponent;
        await loadComponentIntoEditor(componentPath);
      });
    });

    console.log("Inicijalizacija završena!");
  } catch (err) {
    console.error("Greška pri inicijalizaciji:", err);
    alert("Greška pri inicijalizaciji editora: " + err.message);
  }
});

// Eksportujemo funkciju za upotrebu iz drugih skripti
window.loadComponentIntoEditor = loadComponentIntoEditor;
