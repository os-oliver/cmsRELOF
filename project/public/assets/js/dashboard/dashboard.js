document.addEventListener("DOMContentLoaded", function () {
  const eventForm = document.getElementById("newEvent");
  const eventButton = document.getElementById("newEventButton");
  const eventCancelButton = document.getElementById("eventCancelButton");

  const newDocument = document.getElementById("newDocumentBtn");
  const form = document.getElementById("newDocument");

  function showDocumentModal() {
    form.classList.remove("invisible");
    form.classList.add("visible");
  }

  eventButton.addEventListener("click", () => {
    eventForm.classList.add("visible");
    eventForm.classList.remove("invisible");
  });

  eventCancelButton.addEventListener("click", () => {
    eventForm.classList.remove("visible");
    eventForm.classList.add("invisible");
  });

  newDocument.addEventListener("click", showDocumentModal);
});
