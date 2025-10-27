console.log("zdravo");

let selectedCard = null;
const continueBtn = document.getElementById("continueBtn");
const selectedTypeDisplay = document.getElementById("selectedType");
const selectedTypeName = document.getElementById("selectedTypeName");
const tipUstanoveInput = document.getElementById("tipUstanove");

document.querySelectorAll("[data-type]").forEach((card) => {
  card.addEventListener("click", function () {
    if (selectedCard) {
      selectedCard.classList.remove("selected-card");
    }

    this.classList.add("selected-card");
    selectedCard = this;

    const typeName = this.id;
    selectedTypeName.textContent = typeName;
    tipUstanoveInput.value = typeName;
    selectedTypeDisplay.classList.replace("opacity-0", "opacity-100");

    continueBtn.disabled = false;
    continueBtn.classList.remove(
      "disabled:opacity-50",
      "disabled:cursor-not-allowed"
    );
  });
});
