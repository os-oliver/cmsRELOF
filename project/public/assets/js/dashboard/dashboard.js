document.addEventListener("DOMContentLoaded", function () {
  const newDocument = document.getElementById("newDocumentBtn");
  const form = document.getElementById("newDocument");

  function showDocumentModal() {
    form.classList.remove("invisible");
    form.classList.add("visible");
  }

  newDocument.addEventListener("click", showDocumentModal);
});
