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
  if (document.getElementById('document-loader-styles')) return;

  const style = document.createElement('style');
  style.id = 'document-loader-styles';
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

  const els = (id) => document.getElementById(id);
  const form = document.querySelector("form");

  document
    .querySelectorAll('input[name="categories[]"]')
    .forEach((checkbox) => {
      const label = checkbox.nextElementSibling;

      checkbox.addEventListener("change", (e) => {
        e.preventDefault();
        if (checkbox.checked) {
          label.classList.remove(
            "bg-white",
            "border-gray-200",
            "text-gray-700"
          );
          label.classList.add("bg-blue-50", "border-blue-200", "text-blue-700");
        } else {
          label.classList.remove(
            "bg-blue-50",
            "border-blue-200",
            "text-blue-700"
          );
          label.classList.add("bg-white", "border-gray-200", "text-gray-700");
        }
      });
    });

  const updateQueryString = (page) => {
    const url = new URL(window.location.href);
    const formData = new FormData(form);
    for (const [key, value] of formData.entries()) {
      url.searchParams.set(key, value);
    }
    if (page) {
      url.searchParams.set("page", page);
    } else {
      url.searchParams.delete("page");
    }
    return url.toString();
  };

  document.querySelectorAll("nav button").forEach((button) => {
    const page = button.textContent.trim();
    if (page && !isNaN(page)) {
      button.onclick = (e) => {
        e.preventDefault();
        window.location.href = updateQueryString(page);
      };
    }
  });

  const prevButton = document
    .querySelector("button[disabled] .fa-chevron-left")
    ?.closest("button");
  const nextButton = document
    .querySelector("button[disabled] .fa-chevron-right")
    ?.closest("button");

  if (prevButton) {
    prevButton.onclick = (e) => {
      e.preventDefault();
      if (!prevButton.disabled) {
        const currentPage =
          new URLSearchParams(window.location.search).get("page") || 1;
        window.location.href =
          "?" + updateQueryString(parseInt(currentPage) - 1);
      }
    };
  }

  if (nextButton) {
    nextButton.onclick = (e) => {
      e.preventDefault();
      if (!nextButton.disabled) {
        const currentPage =
          new URLSearchParams(window.location.search).get("page") || 1;
        window.location.href =
          "?" + updateQueryString(parseInt(currentPage) + 1);
      }
    };
  }

  const formEls = {
    eventForm: els("newDocument"),
    form: els("documentForm"),
    cancelBtn: els("cancelButton"),
    nameInput: els("name"),
    extInput: els("extension"),
    sizeInput: els("fileSize"),
    titleForm: els("titleForm"),
    desc: els("descriptionForm"),
    endpoint: els("endpoint"),
    method: els("method"),
    fileInput: els("fUpload"),
    ctg: els("category"),
    titleOfForm: els("typeForm"),
  };

  const modalEls = {
    modal: els("documentModal"),
    close: els("closeModal"),
    title: els("modalTitle"),
    description: els("docDescription"),
    category: els("docCategory"),
    status: els("docStatus"),
    date: els("docDate"),
    size: els("docSize"),
    fileFrame: els("fileFrame"),
    downloadBtn: els("downloadButton"),
  };

  const showForm = () => {
    formEls.eventForm.classList.add("visible");
    formEls.eventForm.classList.remove("invisible");
  };

  const closeForm = () => {
    formEls.eventForm.classList.add("invisible");
    formEls.eventForm.classList.remove("visible");
    document.body.classList.remove("overflow-hidden");
  };

  const showModal = () => {
    modalEls.modal.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
  };

  const hideModal = () => {
    modalEls.modal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    modalEls.fileFrame.src = "";
  };

  els("btnNewDocument")?.addEventListener("click", () => {
    showForm();
    formEls.method.value = "POST";
    formEls.endpoint.value = "/document";
    formEls.nameInput.value = "";
    formEls.extInput.value = "";
    formEls.sizeInput.value = "";
    formEls.titleForm.value = "";
    formEls.desc.value = "";
    formEls.ctg.value = "";
    formEls.titleOfForm.innerHTML = "Novi dokument";
    formEls.fileInput.classList.remove("hidden");
  });

  const fileInput = document.getElementById("documetFile");
  const MAX_FILE_SIZE_MB = 50;

  if (fileInput) {
    fileInput.addEventListener("change", () => {
      const file = fileInput.files[0];
      if (!file) return;

      const fileSizeMB = file.size / 1024 / 1024;

      if (fileSizeMB > MAX_FILE_SIZE_MB) {
        alert(
          `Greška! Fajl je prevelik.\n\nMaksimalna dozvoljena veličina: ${MAX_FILE_SIZE_MB}MB\nVaš fajl: ${fileSizeMB.toFixed(
            2
          )}MB\n\nMolimo izaberite manji fajl.`
        );
        fileInput.value = "";
        formEls.nameInput.value = "";
        formEls.extInput.value = "";
        formEls.sizeInput.value = "";
        return;
      }

      formEls.nameInput.value = file.name;
      const parts = file.name.split(".");
      formEls.extInput.value = parts.length > 1 ? parts.pop() : "";
      formEls.sizeInput.value = fileSizeMB.toFixed(2);
    });
  }

  formEls.form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const submitBtn = formEls.form.querySelector("button[type=submit]");
    if (submitBtn?.disabled) return;

    if (fileInput.value == "" && formEls.method.value === "POST") {
      alert("Greška!\n\n niste dodali dokument.");
      formEls.titleForm.focus();
      return;
    }

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.classList.add("opacity-70");
    }

    const loaderOverlay = createLoaderOverlay();
    document.body.appendChild(loaderOverlay);

    const formData = new FormData(formEls.form);

    try {
      let res = null;
      if (formEls.method.value === "PUT") {
        const payload = {
          name: formEls.nameInput.value,
          extension: formEls.extInput.value,
          fileSize: formEls.sizeInput.value,
          category: formEls.ctg.value,
          title: formEls.titleForm.value,
          description: formEls.desc.value,
        };

        const fetchOptions = {
          method: formEls.method.value,
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify(payload),
        };
        res = await fetch(formEls.endpoint.value, fetchOptions);
      } else {
        const fetchOptions = {
          method: formEls.method.value,
          body: formData,
        };

        res = await fetch(formEls.endpoint.value, fetchOptions);
      }

      if (!res.ok) {
        let errorMsg = "Greška pri čuvanju dokumenta";
        try {
          const errorData = await res.json();
          if (errorData.error) {
            errorMsg = errorData.error;
          }
        } catch (e) {
          const errorText = await res.text();
          if (errorText) {
            errorMsg = errorText;
          }
        }
        throw new Error(errorMsg);
      }

      showSuccessCheck(loaderOverlay);

      setTimeout(() => {
        formEls.form.reset();
        closeForm();
        location.reload();
      }, 200);
    } catch (err) {
      console.error("Greška:", err);
      loaderOverlay.remove();
      alert(" " + err.message);

      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.classList.remove("opacity-70");
      }
    }
  });

  const cancelBtn = document.getElementById("cancelButton");
  if (cancelBtn) {
    cancelBtn.addEventListener("click", () => {
      formEls.form.reset();
      closeForm();
    });
  }

  document.addEventListener("keydown", (e) => {
    if (
      e.key === "Escape" &&
      !formEls.eventForm.classList.contains("invisible")
    ) {
      formEls.form.reset();
      closeForm();
    }
  });

  formEls.eventForm.addEventListener("click", (e) => {
    if (e.target === formEls.eventForm) {
      formEls.form.reset();
      closeForm();
    }
  });

  document.querySelectorAll(".document-card").forEach((card) => {
    const data = card.dataset;

    card.querySelector(".edit").addEventListener("click", () => {
      showForm();
      formEls.method.value = "PUT";
      formEls.endpoint.value = `/document/${data.id}`;
      formEls.nameInput.value = data.title;
      formEls.extInput.value = data.fileType;
      formEls.sizeInput.value = data.fileSize;
      formEls.titleForm.value = data.title;
      formEls.desc.value = data.description;
      formEls.ctg.value = data.category;
      formEls.titleOfForm.innerHTML = "Izmena dokumenta";
      formEls.fileInput.classList.add("hidden");
    });

    card.querySelector(".delete").addEventListener("click", async (e) => {
      e.preventDefault();
      if (!confirm("Da li ste sigurni da želite da obrišete dokument?")) return;
      try {
        const res = await fetch(`/document/${data.id}`, { method: "DELETE" });
        if (!res.ok) throw new Error(`Greška: ${res.status}`);
        alert("Dokument uspešno obrisan.");
        location.reload();
      } catch {
        alert("Greška prilikom brisanja dokumenta.");
      }
    });

    card.querySelector(".viewDocument").addEventListener("click", () => {
      modalEls.title.textContent = data.title;
      modalEls.description.textContent = data.description;
      modalEls.category.textContent = data.name;
      modalEls.date.textContent = data.date;
      modalEls.size.textContent = data.fileSize;
      modalEls.status.textContent = data.status;
      modalEls.status.className =
        "ml-2 text-xs font-medium px-2.5 py-1 rounded-full";
      modalEls.fileFrame.src = `/uploads/documents/${data.fileUrl}`;
      modalEls.downloadBtn.onclick = () =>
        (window.location.href = data.fileUrl);
      showModal();
    });
  });

  modalEls.close.addEventListener("click", hideModal);
  modalEls.modal.addEventListener("click", (e) => {
    if (e.target === modalEls.modal) hideModal();
  });
});