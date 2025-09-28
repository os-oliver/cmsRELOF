console.log('documents.js loaded');

document.addEventListener("DOMContentLoaded", () => {
  console.error("Documents JS loaded");
  const els = (id) => document.getElementById(id);

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

  const showModal = () => {
    modalEls.modal.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
  };

  const hideModal = () => {
    modalEls.modal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    modalEls.fileFrame.src = "";
  };

  els("btnNewDocument").addEventListener("click", showForm);

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

  const filterForm = document.getElementById('docFilterForm');
  
  if (filterForm) {
    const resetAndSubmit = () => {
      const off = filterForm.querySelector('input[name="offset"]');
      if (off) off.value = 0;            // reset pagination
      if (filterForm.requestSubmit) filterForm.requestSubmit();
      else filterForm.submit();
    };

    const search = filterForm.querySelector('input[name="search"]');
    if (search) {
      let timer = null;
      search.addEventListener('input', () => {
        clearTimeout(timer);
        timer = setTimeout(resetAndSubmit, 500); // adjust delay if needed
      });
    }

    const sort = filterForm.querySelector('select[name="sort"]');
    if (sort) {
      sort.addEventListener('change', resetAndSubmit);
    }

    filterForm.querySelectorAll('input[name="categories[]"]').forEach(cb => {
      cb.addEventListener('change', resetAndSubmit);
    });

  }
});
