console.log("test");
const mobileMenuBtn = document.getElementById("mobile-menu-btn");
const sidebar = document.getElementById("sidebar");
const sidebarClose = document.getElementById("sidebar-close");
const overlay = document.getElementById("overlay");
console.log(mobileMenuBtn);

function toggleSidebar() {
  sidebar.classList.toggle("active");
  overlay.classList.toggle("active");
}

mobileMenuBtn.addEventListener("click", toggleSidebar);
sidebarClose.addEventListener("click", toggleSidebar);
overlay.addEventListener("click", toggleSidebar);

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
