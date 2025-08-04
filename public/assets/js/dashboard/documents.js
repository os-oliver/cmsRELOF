document.addEventListener("DOMContentLoaded", function () {
  //Dashboard elements
  const eventForm = document.getElementById("newDocument");

  const newDocument = document.getElementById("NewDocument");

  newDocument.addEventListener("click", insertDocument);

  function insertDocument() {
    eventForm.classList.add("visible");
    eventForm.classList.remove("invisible");
  }

  document.addEventListener("click", function (event) {
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickOnMobileMenu = mobileMenuBtn.contains(event.target);

    if (
      !isClickInsideSidebar &&
      !isClickOnMobileMenu &&
      window.innerWidth < 768 &&
      sidebar.classList.contains("active")
    ) {
      toggleSidebar();
    }
  });

  // Document preview modal functionality
  const documentModal = document.getElementById("documentModal");
  const closeModal = document.getElementById("closeModal");
  const modalTitle = document.getElementById("modalTitle");
  const docDescription = document.getElementById("docDescription");
  const docCategory = document.getElementById("docCategory");
  const docStatus = document.getElementById("docStatus");
  const docDate = document.getElementById("docDate");
  const docSize = document.getElementById("docSize");
  const fileFrame = document.getElementById("fileFrame");
  const downloadButton = document.getElementById("downloadButton");

  // Add click events to document cards
  const documentCards = document.querySelectorAll(".document-card");
  documentCards.forEach((card) => {
    const title = card.getAttribute("data-title");
    const description = card.getAttribute("data-description");
    const category = card.getAttribute("data-category");
    const status = card.getAttribute("data-status");
    const date = card.getAttribute("data-date");
    const fileUrl = card.getAttribute("data-file-url");
    const fileType = card.getAttribute("data-file-type");
    const fileSize = card.getAttribute("data-file-size");
    const documentID = card.getAttribute("data-id");
    const cname = card.getAttribute("data-name");
    const viewButton = card.querySelector(".viewDocument");
    const editButton = card.querySelector(".edit");
    console.log("date", date);
    const deleteButton = card.querySelector(".delete");
    editButton.addEventListener("click", function (e) {
      const form = document.getElementById("documentForm");
      const cancelBtn = document.getElementById("cancelButton");
      const nameInput = document.getElementById("name");
      const extInput = document.getElementById("extension");
      const sizeInput = document.getElementById("fileSize");
      const titleForm = document.getElementById("title");
      const desc = document.getElementById("description");
      const endpoint = document.getElementById("endpoint");
      const method = document.getElementById("method");
      const fileInput = document.getElementById("fUpload");

      const ctg = document.getElementById("category");
      const titleOfForm = document.getElementById("typeForm");

      insertDocument();
      method.value = "PUT";
      endpoint.value = "/document/" + documentID;
      nameInput.value = fileUrl;
      extInput.value = fileType;
      nameInput.value = title;
      sizeInput.value = fileSize;
      titleForm.value = title;
      titleOfForm.innerHTML = "Izmena dokumenta";
      desc.value = description;
      ctg.value = category;
      fileInput.classList.add("hidden");
    });
    deleteButton.addEventListener("click", async function (e) {
      e.preventDefault();

      const confirmed = confirm(
        "Da li ste sigurni da želite da obrišete dokument?"
      );
      if (!confirmed) return;

      try {
        const res = await fetch(`/document/${documentID}`, {
          method: "DELETE",
        });

        if (!res.ok) throw new Error(`Greška prilikom brisanja: ${res.status}`);
        window.location.reload();

        alert("Dokument uspešno obrisan.");
      } catch (err) {
        console.error(err);
        alert("Greška prilikom brisanja dokumenta.");
      }
    });

    viewButton.addEventListener("click", function (e) {
      modalTitle.textContent = title;
      docDescription.textContent = description;
      docCategory.textContent = cname;
      docDate.textContent = date;
      docSize.textContent = fileSize;

      // Update status with appropriate color
      docStatus.textContent = status;
      docStatus.className = "ml-2 text-xs font-medium px-2.5 py-1 rounded-full";

      fileFrame.src = "/uploads/documents/" + fileUrl;
      console.log("fileURL,", fileUrl);
      // Update file preview based on type

      // Set download button
      downloadButton.onclick = function () {
        window.location.href = fileUrl;
      };

      // Show modal
      documentModal.classList.remove("hidden");
      document.body.classList.add("overflow-hidden");
    });
  });

  // Close modal
  closeModal.addEventListener("click", function () {
    documentModal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    fileFrame.src = "";
  });

  // Close modal when clicking outside content
  documentModal.addEventListener("click", function (e) {
    if (e.target === documentModal) {
      documentModal.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
      fileFrame.src = "";
    }
  });
});
