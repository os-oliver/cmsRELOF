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

const createLoaderOverlay = () => {
  const overlay = document.createElement("div");
  overlay.className = "fixed inset-0 bg-black/70 z-[9999] flex items-center justify-center";
  overlay.id = "loader-overlay";

  const spinnerContainer = document.createElement("div");
  spinnerContainer.id = "spinner-container";
  spinnerContainer.className = "border-[5px] border-white/15 border-t-white rounded-full w-[60px] h-[60px] animate-spin";

  overlay.appendChild(spinnerContainer);
  return overlay;
};

const showSuccessCheck = (overlay) => {
  const spinner = overlay.querySelector('#spinner-container');
  if (!spinner) return;

  spinner.className = "w-20 h-20 bg-emerald-500 rounded-full flex items-center justify-center shadow-[0_8px_25px_rgba(16,185,129,0.4)] animate-[scaleIn_0.4s_cubic-bezier(0.175,0.885,0.32,1.275)]";

  const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  svg.setAttribute("class", "w-[52px] h-[52px]");
  svg.setAttribute("viewBox", "0 0 52 52");

  const circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
  circle.setAttribute("class", "stroke-white stroke-2 fill-none");
  circle.setAttribute("cx", "26");
  circle.setAttribute("cy", "26");
  circle.setAttribute("r", "25");
  circle.style.strokeDasharray = "166";
  circle.style.strokeDashoffset = "166";
  circle.style.animation = "circleGrow 0.3s ease-out forwards";

  const check = document.createElementNS("http://www.w3.org/2000/svg", "path");
  check.setAttribute("class", "stroke-white stroke-[3] fill-none");
  check.setAttribute("stroke-linecap", "round");
  check.setAttribute("stroke-linejoin", "round");
  check.setAttribute("d", "M14.1 27.2l7.1 7.2 16.7-16.8");
  check.style.strokeDasharray = "48";
  check.style.strokeDashoffset = "48";
  check.style.animation = "checkmark 0.3s 0.3s ease-out forwards";

  svg.appendChild(circle);
  svg.appendChild(check);
  spinner.appendChild(svg);
};

const injectStyles = () => {
  if (document.getElementById('gallery-loader-styles')) return;

  const style = document.createElement('style');
  style.id = 'gallery-loader-styles';
  style.innerHTML = `
    @keyframes scaleIn {
      0% { transform: scale(0); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }
    
    @keyframes checkmark {
      0% { stroke-dashoffset: 48; }
      100% { stroke-dashoffset: 0; }
    }
    
    @keyframes circleGrow {
      0% { stroke-dashoffset: 166; }
      100% { stroke-dashoffset: 0; }
    }
  `;
  document.head.appendChild(style);
};

document.addEventListener("DOMContentLoaded", () => {
  injectStyles();

  const form = $("#galleryForm"),
    galleryModal = $("#galleryModal"),
    cancelBtn = $("#galleryCancelButton"),
    newImageBtn = $("#newPicture"),
    fullImageModal = $("#fullImageModal"),
    closeFullImageModalBtn = $("#closeFullImageModal"),
    imageInput = $("#galleryImage"),
    dropzone = $('#imageUploadLabel'),
    imagePreview = $("#imagePreview"),
    uploadPlaceholder = $("#uploadPlaceholder");
  const maxBytesAttr = Number(form?.dataset?.maxBytes);
  const MAX_SIZE = Number.isFinite(maxBytesAttr) && maxBytesAttr > 0 ? maxBytesAttr : 10 * 1024 * 1024;
  const MAX_SIZE_MB = MAX_SIZE / 1024 / 1024;

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

  imageInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const sizeMB = file.size / 1024 / 1024;
    if (file.size > MAX_SIZE) {
      alert(
        `Slika je prevelika (${sizeMB.toFixed(
          2
        )} MB). Dozvoljeno je do ${MAX_SIZE_MB} MB.`
      );
      imageInput.value = "";
      resetPreview();
      return;
    }
    const reader = new FileReader();
    reader.onload = (ev) => {
      imagePreview.src = ev.target.result;
      imagePreview.classList.remove("hidden");
      uploadPlaceholder.classList.add("hidden");
    };
    reader.readAsDataURL(file);
  });

  dropzone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropzone.classList.add("border-blue-500", "bg-blue-50");
  });

  dropzone.addEventListener("dragleave", (e) => {
    e.preventDefault();
    dropzone.classList.remove("border-blue-500", "bg-blue-50");
  });

  dropzone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropzone.classList.remove("border-blue-500", "bg-blue-50");

    const files = e.dataTransfer.files;
    if (!files || !files.length) return;

    imageInput.files = files;
    imageInput.dispatchEvent(new Event("change"));
  });

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const submitBtn = form.querySelector("button[type=submit]");
    if (submitBtn?.disabled) return;

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.classList.add("opacity-70");
    }

    const loaderOverlay = createLoaderOverlay();
    document.body.appendChild(loaderOverlay);

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
      let payload = null;
      try {
        payload = await res.json();
      } catch (parseErr) {
        console.warn("Nije moguće parsirati odgovor:", parseErr);
      }

      if (!res.ok) {
        const serverMessage =
          payload?.error ||
          payload?.message ||
          `Došlo je do greške (status ${res.status}).`;
        throw new Error(serverMessage);
      }

      showSuccessCheck(loaderOverlay);

      setTimeout(() => {
        form.reset();
        closeModal(galleryModal);
        location.reload();
      }, 300);
      closeModal(galleryModal);

    } catch (error) {
      loaderOverlay.remove();
      alert(error?.message || "Došlo je do greške. Pokušajte ponovo.");

      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.classList.remove("opacity-70");
      }
    }
  });

  $$(".gallery-item").forEach((item) => {
    const { id, title, description } = item.dataset;

    item.querySelector(".gallery-edit")?.addEventListener("click", () => {
      $("#galleryTitle").value = title;
      $("#galleryDescription").value = description;
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

  newImageBtn.addEventListener("click", () => {
    form.reset();
    $("#galleryMethod").value = "POST";
    $("#galleryEndpoint").value = "/gallery";
    form.querySelector('[name="id"]')?.remove();
    resetPreview();
    openModal(galleryModal);
  });

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
