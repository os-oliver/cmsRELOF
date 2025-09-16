let pagesData = [];
// Sample data (in a real app, this would come from a server)
async function loadPages() {
  const loadingIndicator = document.getElementById("loading-indicator");
  const container = document.getElementById("pages-list-container");
  const errorMessage = document.getElementById("error-message");

  try {
    loadingIndicator.classList.remove("hidden");
    container.classList.add("hidden");
    errorMessage.classList.add("hidden");

    // Try to load from pages.json
    const response = await fetch("/assets/data/pages.json");
    console.log(response);
    if (!response.ok) {
      throw new Error("Failed to load pages data");
    }

    const data = await response.json();

    // Transform data to include status and other properties
    pagesData = data.map((page) => ({
      ...page,
    }));

    loadingIndicator.classList.add("hidden");
    container.classList.remove("hidden");
    renderPages(pagesData);
  } catch (error) {
    console.log("Error loading pages:", error);

    // Fallback to sample data if JSON loading fails

    loadingIndicator.classList.add("hidden");
    container.classList.remove("hidden");
    renderPages(pagesData);
  }
} // Global variables
let currentFilter = "all";
let selectedPageId = null;

// DOM Elements
const modalOverlay = document.getElementById("modalOverlay");
const closeModalBtn = document.getElementById("closeModalBtn");
const cancelBtn = document.getElementById("cancelBtn");
const pageForm = document.getElementById("pageForm");
const newPageBtn = document.getElementById("newPageBtn");
const editPageBtn = document.getElementById("editPageBtn");
const deletePageBtn = document.getElementById("deletePageBtn");
const statusButtons = document.querySelectorAll(".status-btn");
const statusOptions = document.querySelectorAll(".status-option");
const pageStatusInput = document.getElementById("pageStatus");
const modalTitle = document.getElementById("modalTitle");

// Mobile menu functionality
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const sidebar = document.getElementById("sidebar");
const mobileOverlay = document.getElementById("mobileOverlay");
const closeSidebarBtn = document.getElementById("closeSidebarBtn");

if (mobileMenuBtn) {
  mobileMenuBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
    mobileOverlay.classList.toggle("active");
  });

  if (closeSidebarBtn) {
    closeSidebarBtn.addEventListener("click", () => {
      sidebar.classList.remove("active");
      mobileOverlay.classList.remove("active");
    });
  }

  mobileOverlay.addEventListener("click", () => {
    sidebar.classList.remove("active");
    mobileOverlay.classList.remove("active");
  });
}

// Modal functionality
function openModal(mode = "create", pageData = null) {
  if (mode === "create") {
    const modalTitleText = "<?= __('style.new_page') ?>";
    modalTitle.textContent = modalTitleText;
    pageForm.reset();
    document.getElementById("pageId").value = "";
    pageStatusInput.value = "active";
    resetStatusOptions("active");
  } else if (mode === "edit" && pageData) {
    const modalTitleText = "<?= __('style.edit_page') ?>";
    modalTitle.textContent = modalTitleText;
    document.getElementById("pageId").value = pageData.id;
    document.getElementById("pageName").value = pageData.name;
    document.getElementById("pagePath").value = pageData.path;
    document.getElementById("pageHref").value = pageData.href;
    pageStatusInput.value = pageData.status;
    resetStatusOptions(pageData.status);
  }

  modalOverlay.classList.add("active");
}

function closeModal() {
  modalOverlay.classList.remove("active");
}

closeModalBtn.addEventListener("click", closeModal);
cancelBtn.addEventListener("click", closeModal);
modalOverlay.addEventListener("click", (e) => {
  if (e.target === modalOverlay) {
    closeModal();
  }
});

// Status options in modal
function resetStatusOptions(activeStatus) {
  statusOptions.forEach((option) => {
    option.classList.remove(
      "bg-green-100",
      "bg-yellow-100",
      "bg-red-100",
      "text-green-700",
      "text-yellow-700",
      "text-red-700"
    );

    if (option.dataset.status === activeStatus) {
      if (activeStatus === "active") {
        option.classList.add("bg-green-100", "text-green-700");
      } else if (activeStatus === "draft") {
        option.classList.add("bg-yellow-100", "text-yellow-700");
      } else if (activeStatus === "inactive") {
        option.classList.add("bg-red-100", "text-red-700");
      }
    } else {
      option.classList.add("bg-gray-100", "text-gray-600");
    }
  });
}
document.querySelector("#saveState").addEventListener("click", () => {
  fetch("/savePagesjson", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      data: pagesData,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.text();
    })
    .then((data) => {
      console.log("Success:", data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});

statusOptions.forEach((option) => {
  option.addEventListener("click", () => {
    const status = option.dataset.status;
    pageStatusInput.value = status;
    resetStatusOptions(status);
  });
});

// Form submission
pageForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const id = document.getElementById("pageId").value;
  const name = document.getElementById("pageName").value;
  const path = document.getElementById("pagePath").value;
  const href = document.getElementById("pageHref").value;
  const status = pageStatusInput.value;

  if (id) {
    // Update existing page
    updatePage(id, name, path, href, status);
  } else {
    // Create new page
    createPage(name, path, href, status);
  }

  closeModal();
});

// CRUD Operations
function createPage(name, path, href, status) {
  const newPage = {
    id: Date.now(), // Generate unique ID
    name,
    path,
    href,
    file: path.split("/").pop(),
    status: parseInt(status),
    created_at: new Date().toLocaleString("sr-RS"),
  };

  pagesData.push(newPage);
  renderPages(pagesData);
  selectPage(newPage.id);
}

function updatePage(id, name, path, href, status) {
  const pageIndex = pagesData.findIndex((page) => page.id == id);

  if (pageIndex !== -1) {
    pagesData[pageIndex] = {
      ...pagesData[pageIndex],
      name,
      path,
      href,
      status,
    };

    renderPages(pagesData);
    selectPage(id);
  }
}

function deletePage(id) {
  const messagePhp = "<?= __('style.delete_page_confirm') ?>";
  let message = messagePhp;

  if (confirm(message)) {
    pagesData = pagesData.filter((page) => page.id != id);
    renderPages(pagesData);

    // Clear preview if the deleted page was selected
    if (selectedPageId == id) {
      clearPreview();
    }
  }
}

// Status change buttons
const statusConfig = {
  1: { border: "border-green-500", text: "text-green-700", bg: "bg-green-100" },
  0: {
    border: "border-yellow-500",
    text: "text-yellow-700",
    bg: "bg-yellow-100",
  },
  "-1": { border: "border-red-500", text: "text-red-700", bg: "bg-red-100" },
};
const gray = {
  border: "border-gray-300",
  text: "text-gray-600",
  bg: "bg-gray-100",
};

// Fix for applyClasses function
function applyClasses(btn, set) {
  if (!btn) return; // Guard clause to prevent null reference
  btn.classList.remove(
    "border-green-500",
    "border-yellow-500",
    "border-red-500",
    "border-gray-300",
    "text-green-700",
    "text-yellow-700",
    "text-red-700",
    "text-gray-600",
    "bg-green-100",
    "bg-yellow-100",
    "bg-red-100",
    "bg-gray-100"
  );
  btn.classList.add(set.border, set.text, set.bg);
}

// Apply status button classes only after DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
  statusButtons.forEach((btn) => applyClasses(btn, gray));
  const activeStatusBtn = document.querySelector('[data-status="active"]');
  if (activeStatusBtn) {
    applyClasses(activeStatusBtn, statusConfig.active);
  }
});

statusButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (!selectedPageId) {
      const messagePhp = "<?= __('style.select_page_before_status') ?>";
      let alertMessage = messagePhp;
      alert(alertMessage);
      return;
    }

    statusButtons.forEach((b) => applyClasses(b, gray));
    applyClasses(btn, statusConfig[btn.dataset.status]);

    // Update the page status
    const status = btn.dataset.status;
    const pageIndex = pagesData.findIndex((page) => page.id == selectedPageId);

    if (pageIndex !== -1) {
      pagesData[pageIndex].status = status;

      // Funkcija za dobijanje prevedenog statusa
      function getStatusText(status) {
        const key = "style.status_" + status;
        const messagePhp = "<?= __('" + key + "') ?>";
        return messagePhp;
      }

      const statusText = getStatusText(status);

      // Update preview
      document.getElementById("preview-status").textContent = statusText;

      // Update the page card status badge
      const statusBadge = document.querySelector(
        `.page-card[data-id="${selectedPageId}"] .status-badge`
      );
      if (statusBadge) {
        statusBadge.textContent = statusText;

        // Update badge color
        statusBadge.classList.remove(
          "from-green-400",
          "to-green-600",
          "from-yellow-400",
          "to-orange-500",
          "from-red-400",
          "to-red-600"
        );

        if (status === "active") {
          statusBadge.classList.add("from-green-400", "to-green-600");
        } else if (status === "draft") {
          statusBadge.classList.add("from-yellow-400", "to-orange-500");
        } else {
          statusBadge.classList.add("from-red-400", "to-red-600");
        }
      }
    }
  });
});

// Button event listeners
newPageBtn.addEventListener("click", () => {
  openModal("create");
});

editPageBtn.addEventListener("click", () => {
  if (!selectedPageId) {
    const messagePhp = "<?= __('style.select_page_to_edit') ?>";
    let alertMessage = messagePhp;
    alert(alertMessage);
    return;
  }

  const page = pagesData.find((p) => p.id == selectedPageId);
  if (page) {
    openModal("edit", page);
  }
});

deletePageBtn.addEventListener("click", () => {
  if (!selectedPageId) {
    const messagePhp = "<?= __('style.select_page_to_delete') ?>";
    let alertMessage = messagePhp;
    alert(alertMessage);
    return;
  }
  deletePage(selectedPageId);
});

// Function to render page cards
function renderPages(pages) {
  const container = document.getElementById("pages-list-container");
  container.innerHTML = "";

  if (!pages || pages.length === 0) {
    container.innerHTML = `
            <div class="text-center py-8">
                <i class="fas fa-search text-2xl text-gray-400"></i>
                <p class="text-gray-500 mt-2">Nema stranica za prikaz</p>
            </div>
        `;
    return;
  }

  // Remove duplicate IDs
  const uniquePages = pages.filter(
    (page, index, self) => index === self.findIndex((p) => p.id === page.id)
  );

  uniquePages.forEach((page, index) => {
    if (!page.name) return; // Skip empty name entries

    let statusClass = "";
    let statusText = "";
    switch (parseInt(page.status)) {
      case 1:
        statusClass = "from-green-400 to-green-600";
        statusText = "Aktivan";
        break;
      case 0:
        statusClass = "from-yellow-400 to-orange-500";
        statusText = "U pripremi";
        break;
      case -1:
        statusClass = "from-red-400 to-red-600";
        statusText = "Neaktivan";
        break;
      default:
        statusClass = "from-green-400 to-green-600";
        statusText = "Aktivan";
    }

    const card = document.createElement("div");
    card.className =
      "page-card rounded-xl p-4 lg:p-5 cursor-pointer border-2 border-transparent hover:border-primary/30 transition-all duration-300 animate-fade-in";
    card.dataset.id = page.id;
    card.style.animationDelay = `${index * 0.1}s`;
    card.innerHTML = `
            <div class="flex justify-between items-start mb-3">
                <h4 class="font-bold text-gray-800 truncate max-w-[60%] text-sm lg:text-base">${
                  page.name
                }</h4>
                <span class="bg-gradient-to-r ${statusClass} text-white text-xs px-2 py-1 rounded-full font-medium status-badge">${statusText}</span>
            </div>
            <p class="text-gray-500 text-xs lg:text-sm mb-3 font-medium truncate">${
              page.href
            }</p>
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-400">${
                  page.created_at || new Date().toLocaleString("sr-RS")
                }</span>
            </div>
        `;

    card.addEventListener("click", () => {
      document.getElementById("stylePage").href =
        "/style?komponenta=" + page.name.trim().replace(" ", "_").toLowerCase();
      selectPage(page.id);
    });

    container.appendChild(card);
  });

  // Hide loading indicator and show container
  document.getElementById("loading-indicator").classList.add("hidden");
  container.classList.remove("hidden");

  // Select the first card if none is selected
  if (container.firstChild && !selectedPageId) {
    selectPage(pages[0].id);
  }
}

// Fix for selectPage function
function selectPage(id) {
  selectedPageId = id;
  const page = pagesData.find((p) => p.id == id);

  if (!page) {
    console.error(`Page with ID ${id} not found.`);
    return; // Exit if page is not found
  }

  // Update preview section
  document.getElementById("preview-title").textContent = page.name || "N/A";
  document.getElementById("preview-url").textContent = page.href || "N/A";
  let statusText;
  switch (parseInt(page.status)) {
    case 1:
      statusText = "Aktivan";
      break;
    case 0:
      statusText = "U pripremi";
      break;
    case -1:
      statusText = "Neaktivan";
      break;
    default:
      statusText = "Nepoznat";
  }

  document.getElementById("preview-status").textContent = statusText;
  document.getElementById("preview-path").textContent = page.path || "N/A";
  document.getElementById("preview-date").textContent =
    page.created_at || "N/A";

  // Highlight selected card
  document.querySelectorAll(".page-card").forEach((c) => {
    c.classList.remove("border-primary", "bg-blue-50");
  });
  const selectedCard = document.querySelector(`.page-card[data-id="${id}"]`);
  if (selectedCard) {
    selectedCard.classList.add("border-primary", "bg-blue-50");
  }

  // Update status buttons
  statusButtons.forEach((btn) => applyClasses(btn, gray));
  const activeStatusBtn = document.querySelector(
    `[data-status="${page.status}"]`
  );
  if (activeStatusBtn) {
    applyClasses(activeStatusBtn, statusConfig[page.status]);
  }
}

// Clear preview
function clearPreview() {
  selectedPageId = null;
  document.getElementById("preview-title").textContent = "Odaberite stranicu";
  document.getElementById("preview-url").textContent =
    "Odaberite stranicu za pregled";
  document.getElementById("preview-status").textContent = "-";
  document.getElementById("preview-path").textContent = "-";
  document.getElementById("preview-date").textContent = "-";

  // Clear card highlights
  document.querySelectorAll(".page-card").forEach((c) => {
    c.classList.remove("border-primary", "bg-blue-50");
  });

  // Reset status buttons
  statusButtons.forEach((btn) => applyClasses(btn, gray));
  applyClasses(
    document.querySelector('[data-status="active"]'),
    statusConfig.active
  );
}

// Filter pages based on search input and status
function filterPages() {
  const searchTerm = document
    .querySelector(".search-input")
    .value.toLowerCase();
  let filtered = pagesData.filter(
    (page) =>
      page.name &&
      (page.name.toLowerCase().includes(searchTerm) ||
        page.href.toLowerCase().includes(searchTerm) ||
        page.path.toLowerCase().includes(searchTerm))
  );

  // Apply status filter
  if (currentFilter !== "all") {
    const statusMap = {
      active: 1,
      draft: 0,
      inactive: -1,
    };
    filtered = filtered.filter(
      (page) => parseInt(page.status) === statusMap[currentFilter]
    );
  }

  // Filter out duplicates by ID
  filtered = filtered.filter(
    (page, index, self) => index === self.findIndex((p) => p.id === page.id)
  );

  renderPages(filtered);
}

// Initialize the page
document.addEventListener("DOMContentLoaded", () => {
  loadPages();

  renderPages(pagesData);

  // Add event listeners
  document
    .querySelector(".search-input")
    .addEventListener("input", filterPages);

  // Filter buttons
  document.querySelectorAll(".filter-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      // Update active filter
      document.querySelectorAll(".filter-btn").forEach((b) => {
        b.classList.remove("active", "bg-primary", "text-white");
        b.classList.add("bg-gray-100", "text-gray-700");
      });
      btn.classList.add("active", "bg-primary", "text-white");
      btn.classList.remove("bg-gray-100", "text-gray-700");

      currentFilter = btn.dataset.filter;
      filterPages();
    });
  });

  // Refresh button
  document.querySelector(".action-btn").addEventListener("click", () => {
    renderPages(pagesData);
  });
});
