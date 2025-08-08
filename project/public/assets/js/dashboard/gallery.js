document.addEventListener("DOMContentLoaded", function () {
  console.log("cao");
  const newImageBtn = document.getElementById("newPicture");

  const galleryModal = document.getElementById("galleryModal");

  newImageBtn.addEventListener("click", insertDocument);

  function insertDocument() {
    galleryModal.classList.add("visible");
    galleryModal.classList.remove("invisible");
  }
});

document.querySelectorAll(".view-image").forEach((button) => {
  button.addEventListener("click", function () {
    const imageContainer = this.closest(".gallery-item");
    const imageUrl = imageContainer.getAttribute("data-image-url");

    const modal = document.getElementById("fullImageModal");
    const modalImg = document.getElementById("modalFullImage");

    modalImg.src = imageUrl;
    modal.classList.remove("hidden");
  });
});

document
  .getElementById("closeFullImageModal")
  .addEventListener("click", function () {
    document.getElementById("fullImageModal").classList.add("hidden");
  });
function deletePicture(id) {
  if (!confirm("Da li ste sigurni da želite da obrišete ovu sliku?")) return;

  fetch("/gallery/" + id, {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Greška prilikom brisanja slike.");
      }
      document.querySelector(`.gallery-item[data-id="${id}"]`).remove();
    })
    .catch((error) => {
      alert(error.message);
    });
}
