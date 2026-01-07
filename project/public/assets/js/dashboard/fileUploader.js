document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("newDocument");
  const form = document.getElementById("documentForm");
  const cancelBtn = document.getElementById("cancelButton");
  const fileInput = document.getElementById("documetFile");
  const nameInput = document.getElementById("name");
  const extInput = document.getElementById("extension");
  const sizeInput = document.getElementById("fileSize");
  const endpoint = document.getElementById("endpoint");
  const method = document.getElementById("method");

  const maxSize = 200 * 1024 * 1024; // 200 MB

  // Kad se fajl izabere, popuni name, extension i fileSize
  fileInput.addEventListener("change", () => {
    const file = fileInput.files[0];
    if (!file) return;

    const kb = file.size / 1024 / 1024;
    sizeInput.value = kb.toFixed(2);
    if (file.size > maxSize) {
      alert("Fajl je prevelik! Maksimalna veličina je 200 MB.");
      fileInput.value = "";
      nameInput.value = "";
      extInput.value = "";
      sizeInput.value = "";
      return;
    }

    nameInput.value = file.name;
    const parts = file.name.split(".");
    extInput.value = parts.length > 1 ? parts.pop() : "";
  });

  // Cancel
  cancelBtn.addEventListener("click", () => {
    form.reset();
    closeModal();
  });

  // Submit
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    // Provera da su polja popunjena

    let dataTosend = null;
    let headers = {};

    const formData = new FormData(form);
    for (let [k, v] of formData.entries()) console.log(k, v);

    if (method.value == "POST") {
      dataTosend = formData;

      headers = {};
    } else {
      headers = {
        "Content-Type": "application/json",
      };
      const data = {};
      formData.forEach((value, key) => {
        data[key] = value;
      });

      dataTosend = JSON.stringify(data);
    }

    try {
      const fetchOptions = {
        method: method.value,
        body: dataTosend,
      };

      // Dodaj headers samo ako nisu prazni
      if (Object.keys(headers).length > 0) {
        fetchOptions.headers = headers;
      }

      const res = await fetch(endpoint.value, fetchOptions);
      if (!res.ok) throw new Error(`Status: ${res.status}`);
      console.log(res.text());
      alert("Dokument uspešno sačuvan!");
      form.reset();
      closeModal();
    } catch (err) {
      console.error(err);
      alert("Greška pri čuvanju dokumenta, pokušajte ponovo.");
    }
  });

  // Zatvori kad klikneš van
  modal.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });

  // Zatvori na ESC (isto kao Cancel)
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !modal.classList.contains("invisible")) {
      form.reset();
      closeModal();
    }
  });

  function closeModal() {
    modal.classList.add("invisible");
    document.body.classList.remove("overflow-hidden");
  }
});
