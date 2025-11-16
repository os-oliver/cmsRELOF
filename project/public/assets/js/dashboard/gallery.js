const $ = (sel) => document.querySelector(sel);
const $$ = (sel) => document.querySelectorAll(sel);

const deletePicture = (id) => {
  if (!confirm("Da li ste sigurni da želite da obrišete ovu sliku?")) return;
  fetch(`/gallery/${id}`, {
    method: "DELETE",
    headers: { "Content-Type": "application/json" },
  })
    .then((res) => {
      if (!res.ok) throw new Error("Greška prilikom brisanja slike.");
      window.location.reload();
    })
    .catch((err) => alert(err.message));
};

document.addEventListener("DOMContentLoaded", () => {
  const form = $("#galleryForm"),
    galleryModal = $("#galleryModal"),
    cancelBtn = $("#galleryCancelButton"),
    newImageBtn = $("#newPicture"),
    fullImageModal = $("#fullImageModal"),
    closeFullImageModalBtn = $("#closeFullImageModal"),
    imageInput = $("#galleryImage"),
    imagePreview = $("#imagePreview"),
    uploadPlaceholder = $("#uploadPlaceholder");

  const openModal = (m) => {
    m.classList.remove("invisible", "hidden");
    m.classList.add("visible");
    document.body.classList.add("overflow-hidden");
  };

  const closeModal = (m) => {
    m.classList.add("invisible");
    m.classList.remove("visible");
    document.body.classList.remove("overflow-hidden");
  };

  const resetPreview = () => {
    imagePreview.classList.add("hidden");
    uploadPlaceholder.classList.remove("hidden");
  };

  // Image preview
  imageInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
      imagePreview.src = ev.target.result;
      imagePreview.classList.remove("hidden");
      uploadPlaceholder.classList.add("hidden");
    };
    reader.readAsDataURL(file);
  });

  // Form submit
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const method = $("#galleryMethod").value;
    const endpoint = $("#galleryEndpoint").value;
    const fileInput = form.querySelector("input[type=file]");
    const hasFile = fileInput?.files?.length;

    const options = { method };
    if (hasFile || method === "POST") {
      options.body = new FormData(form);
    } else {
      const json = {};
      new FormData(form).forEach((v, k) => (json[k] = v));
      options.headers = { "Content-Type": "application/json" };
      options.body = JSON.stringify(json);
    }

    try {
      const res = await fetch(endpoint, options);
      if (!res.ok) throw new Error(res.statusText);
      alert(
        method === "POST"
          ? "Galerija uspešno sačuvana!"
          : "Galerija uspešno izmenjena!"
      );
      form.reset();
      closeModal(galleryModal);
      location.reload();
    } catch {
      alert("Došlo je do greške. Pokušajte ponovo.");
    }
  });

  // Gallery items
  $$(".gallery-item").forEach((item) => {
    const { id, title, description } = item.dataset;

    item.querySelector(".gallery-edit")?.addEventListener("click", () => {
      $("#galleryTitle").value = title;
      $("#galleryDescription").value = description;
      // Use POST for edit so multipart/form-data uploads are sent and handled by the server
      $("#galleryMethod").value = "POST";
      $("#galleryEndpoint").value = `/gallery/${id}`;
      if (!form.querySelector('[name="id"]'))
        form.insertAdjacentHTML(
          "beforeend",
          `<input type="hidden" name="id" value="${id}"/>`
        );
      else form.querySelector('[name="id"]').value = id;
      resetPreview();
      openModal(galleryModal);
    });

    item.querySelector(".view-image")?.addEventListener("click", () => {
      $("#modalFullImage").src = item.dataset.imageUrl;
      openModal(fullImageModal);
    });

    item
      .querySelector(".gallery-delete")
      ?.addEventListener("click", () => deletePicture(id));
  });

  // New image
  newImageBtn.addEventListener("click", () => {
    form.reset();
    $("#galleryMethod").value = "POST";
    $("#galleryEndpoint").value = "/gallery";
    form.querySelector('[name="id"]')?.remove();
    resetPreview();
    openModal(galleryModal);
  });

  // Cancel & close handlers
  cancelBtn.addEventListener("click", () => {
    form.reset();
    closeModal(galleryModal);
  });
  closeFullImageModalBtn.addEventListener("click", () =>
    closeModal(fullImageModal)
  );

  [galleryModal, fullImageModal].forEach((modal) =>
    modal.addEventListener(
      "click",
      (e) => e.target === modal && closeModal(modal)
    )
  );

  // Close on ESC: reset form for galleryModal (same as Cancel), close fullImageModal
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      if (!galleryModal.classList.contains("invisible")) {
        form.reset();
        closeModal(galleryModal);
      }
      if (!fullImageModal.classList.contains("invisible")) {
        closeModal(fullImageModal);
      }
    }
  });
});
