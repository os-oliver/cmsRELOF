// Pomocna funkcija za cekanje da se element pojavi u DOM-u
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
        reject(new Error("Element nije pronadjen: " + selector));
      }
    }, interval);
  });

// Glavna logika koja se pokrece kada se ucita cela stranica
document.addEventListener("DOMContentLoaded", async () => {
  try {
    // Inicijalizacija GrapesJS editora
    const editor = grapesjs.init({
      container: "#gjs",
      fromElement: false,
      height: "100%",
      width: "auto",
      parser: { optionsHtml: { allowScripts: true } },
      storageManager: false,
      panels: { defaults: [] },
      canvas: { scripts: ["https://cdn.tailwindcss.com"] },
    });

    // Cekamo da se editor u potpunosti ucita
    await new Promise((res) => {
      if (editor && editor.on) {
        editor.on("load", res);
      } else {
        setTimeout(res, 100);
      }
    });

    // Pronalazimo i postavljamo osluskivac dogadjaja na dugme za izvoz
    let exportBtn;
    try {
      exportBtn = await waitForEl("#export", 2000, 100);
    } catch (err) {
      console.warn(err.message);
      exportBtn = document.getElementById("export");
    }

    if (!exportBtn) {
      console.warn(
        "Dugme za izvoz (#export) nije pronadjeno — izvoz je iskljucen."
      );
    } else {
      exportBtn.addEventListener("click", async () => {
        try {
          const wrapper = editor.DomComponents.getWrapper();
          const combinedHTML = wrapper.toHTML();

          const formData = new FormData();
          formData.append(
            "cmp",
            "/exportedPages/landingPageComponents/landingPage/promocija.php"
          );
          formData.append("html", combinedHTML);

          const res = await fetch("/saveLandigPageComponent", {
            method: "POST",
            body: formData,
          });

          // Citanje celog teksta odgovora, bez obzira na status
          const responseText = await res.text();
          console.log("Ceo tekst odgovora servera:", responseText); // <-- Ovde se ispisuje ceo tekst

          if (!res.ok) {
            // Ako status nije OK, baci gresku sa tekstom odgovora
            throw new Error(
              `Greska na serveru (${res.status}): ${responseText}`
            );
          }

          try {
            // Pokusaj parsiranja odgovora kao JSON
            const json = JSON.parse(responseText);
            console.log("Uspesno sacuvano:", json);
            alert(
              "Komponenta je sacuvana! Broj zapisanih bajtova: " +
                (json.bytes_written ?? "nepoznato")
            );
          } catch (jsonError) {
            // Ako parsiranje JSON-a ne uspe, znaci da server nije poslao JSON
            console.error(
              "Odgovor nije validan JSON. Greska u parsiranju:",
              jsonError
            );
            throw new Error("Server je vratio nevalidan JSON format.");
          }
        } catch (err) {
          console.error("Greska prilikom cuvanja:", err.message);
          alert("Greska prilikom cuvanja komponente: " + err.message);
        }
      });
    }

    // Ucitavanje postojecih komponenti u editor
    try {
      const res = await fetch(
        "/exportedPages/landingPageComponents/landingPage/promocija.php"
      );
      if (!res.ok)
        throw new Error(`Neuspelo ucitavanje komponente (${res.status})`);
      const html = await res.text();
      editor.setComponents(html);
    } catch (err) {
      console.error("Nije moguce ucitati komponentu.html:", err);
    }
  } catch (err) {
    console.error("Greska pri inicijalizaciji:", err);
  }
});
