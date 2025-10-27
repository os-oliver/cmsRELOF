// Panel and button configuration
const panels = {
  component: document.getElementById("blocks"),
  settings: document.getElementById("settingsBlock"),
  nav: document.getElementById("navBlock"),
};

const buttons = {
  component: document.getElementById("component"),
  settings: document.getElementById("settingsbtn"),
  nav: document.getElementById("navbtn"),
};

function resetAllPanels() {
  Object.values(buttons).forEach((b) => b.classList.remove("primary"));
  Object.values(panels).forEach((p) => {
    p.style.display = "none";
    p.classList.add("hidden");
  });
}

function createPanelHandler(key) {
  return () => {
    resetAllPanels();
    buttons[key].classList.add("primary");
    panels[key].classList.remove("hidden");
    panels[key].style.display = "block";
  };
}

export function initializePanels() {
  buttons.component.addEventListener("click", createPanelHandler("component"));
  buttons.settings.addEventListener("click", createPanelHandler("settings"));
  buttons.nav.addEventListener("click", createPanelHandler("nav"));

  // Setup device buttons
  document.querySelectorAll(".device-btn").forEach((btn) =>
    btn.addEventListener("click", () => {
      // emit custom event with desired device — the caller who has editor access should listen
      window.dispatchEvent(
        new CustomEvent("webdesigner:setDevice", {
          detail: { device: btn.dataset.device, button: btn },
        })
      );
      document
        .querySelectorAll(".device-btn")
        .forEach((b) => b.classList.toggle("active", b === btn));
    })
  );
}
