document.addEventListener("DOMContentLoaded", () => {
  const get = document.getElementById.bind(document);
  const elements = {
    imagePreview: get("imagePreview"),
    previewWrapper: get("previewWrapper"),
    uploadContent: get("uploadContent"),
    clearPreviewBtn: get("clearPreviewBtn"),
    dropZone: get("dropZone"),
    fileInput: get("file"),
    form: get("formEvent"),
    modal: get("newEvent"),
    cancelBtn: get("eventCancelButton"),
    methodInput: get("method"),
    endpointInput: get("endpoint"),
  };

  const formFields = [
    "title",
    "category",
    "description",
    "date",
    "time",
    "location",
  ];
  const requiredFields = ["title", "category", "date", "time"];
  const rows = document.querySelectorAll("tbody tr.dataCard");
  const MAX_BYTES = 100 * 1024 * 1024;
  let currentImageURL = null;

  const resetImagePreview = () => {
    if (currentImageURL)
      try {
        URL.revokeObjectURL(currentImageURL);
      } catch {}
    currentImageURL = null;
    if (elements.imagePreview) elements.imagePreview.src = "#";
    elements.previewWrapper?.classList.add("hidden");
    elements.uploadContent?.classList.remove("hidden");
    if (elements.fileInput) elements.fileInput.value = "";
  };

  const showPreview = (file) => {
    if (!file) return resetImagePreview();
    if (!file.type.startsWith("image/")) {
      alert("Molimo izaberite sliku (.jpg, .jpeg, .png).");
      return resetImagePreview();
    }
    if (file.size > MAX_BYTES) {
      alert("Slika je prevelika. Maksimalno 100 MB.");
      return resetImagePreview();
    }

    if (currentImageURL)
      try {
        URL.revokeObjectURL(currentImageURL);
      } catch {}
    currentImageURL = URL.createObjectURL(file);
    elements.imagePreview.src = currentImageURL;
    elements.previewWrapper.classList.remove("hidden");
    elements.uploadContent.classList.add("hidden");
  };

  elements.fileInput?.addEventListener("change", (e) =>
    showPreview(e.target.files?.[0])
  );

  elements.clearPreviewBtn?.addEventListener("click", (e) => {
    e.preventDefault();
    resetImagePreview();
  });

  if (elements.dropZone) {
    ["dragenter", "dragover"].forEach((evt) =>
      elements.dropZone.addEventListener(evt, (e) => {
        e.preventDefault();
        elements.dropZone.classList.add("border-blue-400", "bg-blue-50");
      })
    );
    ["dragleave", "drop"].forEach((evt) =>
      elements.dropZone.addEventListener(evt, (e) => {
        e.preventDefault();
        elements.dropZone.classList.remove("border-blue-400", "bg-blue-50");
      })
    );
    elements.dropZone.addEventListener("drop", (e) => {
      e.preventDefault();
      const file = e.dataTransfer?.files?.[0];
      if (file) {
        try {
          const dt = new DataTransfer();
          dt.items.add(file);
          elements.fileInput.files = dt.files;
        } catch {
          // fallback
        }
        showPreview(file);
      }
    });
  }

  elements.form?.addEventListener("submit", async (e) => {
    e.preventDefault();
    const method = elements.methodInput?.value || "POST";
    const endpoint = elements.endpointInput?.value || "/events";
    const fileEl = elements.form.querySelector("input[type=file]");
    const hasFile = fileEl?.files?.length > 0 && fileEl.files[0].name;
    const options = { method };

    if (hasFile || method === "POST") {
      options.body = new FormData(elements.form);
    } else {
      const json = {};
      new FormData(elements.form).forEach((v, k) => (json[k] = v));
      options.headers = { "Content-Type": "application/json" };
      options.body = JSON.stringify(json);
    }

    try {
      const res = await fetch(endpoint, options);
      if (!res.ok) throw new Error(res.statusText);
      alert(
        method === "POST"
          ? "Događaj uspešno sačuvan!"
          : "Događaj uspešno izmenjen!"
      );
      elements.form.reset();
      resetImagePreview();
      closeModal();
      location.reload();
    } catch {
      alert("Došlo je do greške. Pokušajte ponovo.");
    }
  });

  rows?.forEach((row) => {
    const data = row.dataset;
    const editBtn = row.querySelector(".edit");
    editBtn?.addEventListener("click", () => {
      if (!elements.form) return;
      formFields.forEach((f) => {
        const el = elements.form.querySelector(`#${f}`);
        if (el) el.value = data[f] || "";
      });
      if (elements.methodInput) elements.methodInput.value = "PUT";
      if (elements.endpointInput)
        elements.endpointInput.value = `/events/${data.id}`;
      elements.form.querySelector('input[name="id"]')?.remove();
      elements.form.insertAdjacentHTML(
        "beforeend",
        `<input type="hidden" name="id" value="${data.id}"/>`
      );
      elements.modal.classList.remove("invisible");
      document.body.classList.add("overflow-hidden");
    });
  });

  function closeModal() {
    elements.modal?.classList.add("invisible");
    document.body.classList.remove("overflow-hidden");
  }

  elements.cancelBtn?.addEventListener("click", () => {
    elements.form?.reset();
    resetImagePreview();
    closeModal();
  });

  elements.modal?.addEventListener("click", (e) => {
    if (e.target === elements.modal) {
      elements.form?.reset();
      resetImagePreview();
      closeModal();
    }
  });

  // Optional: validation helper
  const validateForm = () =>
    requiredFields.every((field) => {
      const el = document.getElementById(field);
      return el && el.value.trim() !== "";
    });
});
