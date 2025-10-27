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

  // Kad se fajl izabere, popuni name, extension i fileSize
  fileInput.addEventListener("change", () => {
    const file = fileInput.files[0];
    if (!file) return;
    nameInput.value = file.name;
    const parts = file.name.split(".");
    extInput.value = parts.length > 1 ? parts.pop() : "";
    const kb = file.size / 1024 / 1024;
    sizeInput.value = kb.toFixed(2);
  });

  // Cancel
  cancelBtn.addEventListener("click", () => {
    form.reset();
    closeModal();
  });

  // Submit
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    console.log("caocaoaco");
    // Provera da su polja popunjena

    let dataTosend = null;

    const formData = new FormData(form);
    for (let [k, v] of formData.entries()) console.log(k, v);

    let headers = {};

    if (method.value == "POST") {
      dataTosend = formData;
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
      const res = await fetch(endpoint.value, {
        method: method.value,
        headers: headers,
        body: dataTosend,
      });
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
