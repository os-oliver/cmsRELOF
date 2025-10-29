document.addEventListener("DOMContentLoaded", () => {
  const els = (id) => document.getElementById(id);
  const form = document.querySelector("form");

  // Handle category selection with visual feedback
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

  // Handle pagination with filters
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

  // Update pagination links

  document.querySelectorAll("nav button").forEach((button) => {
    const page = button.textContent.trim();
    if (page && !isNaN(page)) {
      button.onclick = (e) => {
        e.preventDefault();
        window.location.href = updateQueryString(page);
      };
    }
  });

  // Handle previous/next buttons
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

  // Form elements
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

  // Modal elements
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
    // Reset form to initial state for new document
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

  // Handle document cards
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
