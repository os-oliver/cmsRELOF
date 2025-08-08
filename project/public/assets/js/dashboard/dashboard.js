// Mobile sidebar toggle functionality
document.addEventListener("DOMContentLoaded", function () {
  const eventForm = document.getElementById("newEvent");
  const eventButton = document.getElementById("newEventButton");
  const eventCancelButton = document.getElementById("eventCancelButton");

  const newDocument = document.getElementById("newDocumentBtn");
  const form = document.getElementById("newDocument");
  const mobileMenuBtn = document.getElementById("mobile-menu");
  const sidebar = document.getElementById("sidebar");
  const sidebarClose = document.getElementById("sidebar-close");
  const overlay = document.getElementById("overlay");

  function toggleSidebar() {
    sidebar.classList.toggle("active");
    overlay.classList.toggle("active");
  }
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
  mobileMenuBtn.addEventListener("click", toggleSidebar);
  sidebarClose.addEventListener("click", toggleSidebar);
  overlay.addEventListener("click", toggleSidebar);

  // Close sidebar when clicking outside on desktop
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
});
