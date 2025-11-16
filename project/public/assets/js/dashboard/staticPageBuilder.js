// Pages data structure
const pages = [];
let columns = [];
let pageAssignments = {};

// Function to generate unique ID
function generateUniqueId() {
  return Date.now().toString(16) + Math.random().toString(16).substr(2);
}

// Function to add a new page
function handleAddPage() {
  const name = document.getElementById("page-name-input").value.trim();
  if (!name) {
    alert("Molimo unesite naziv stranice");
    return;
  }

  const fileName = name.toLowerCase().replace(/\s+/g, "-") + ".php";
  const newPage = {
    id: generateUniqueId(),
    static: true,
    movable: true, // Default to movable
    name: name,
    href: "/" + name.toLowerCase().replace(/\s+/g, "-"),
    path: "pages/" + fileName,
    file: fileName,
    status: 1,
    created_at: new Date().toISOString().slice(0, 19).replace("T", " "),
  };

  pages.push(newPage);
  hideAddPageModal();
  renderPageColumnsBoard();
  // Auto-save after adding new page with 'add' action
  savePageColumnsState("add");
}

function getPageIcon(file) {
  // No icons needed anymore
  return "";
}

function createPageCard(page) {
  const editLink = `/style?komponenta=${encodeURIComponent(
    page.file.replace(".php", "")
  )}`;
  const displayName = page.name || "Početna stranica";
  console.log("Creating card for page:", page);
  // Check if page is movable (default to true if not specified)
  const isMovable = page.movable !== false;

  // Different styles for movable vs non-movable cards
  const cardClasses = isMovable
    ? "draggable-card rounded-lg p-3 mb-2 hover:shadow-hover transition-all duration-300 bg-white border-2 border-transparent hover:border-blue-200"
    : "non-movable-card rounded-lg p-3 mb-2 bg-gray-50 border-2 border-gray-200 opacity-90";

  const dragAttributes = isMovable ? 'draggable="true"' : "";
  const lockIcon = isMovable
    ? ""
    : '<i class="fas fa-lock text-gray-400 text-xs mr-1"></i>';

  return `
<div class="${cardClasses}" 
        ${dragAttributes} data-page-id="${page.id}" data-movable="${isMovable}">
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center flex-1 mr-3">
            ${lockIcon}
            <h3 class="font-medium ${
              isMovable ? "text-gray-900" : "text-gray-600"
            } text-sm truncate">${displayName}</h3>
        </div>
        <span class="status-badge px-2 py-1 rounded-full text-xs font-medium ${
          page.status == 1
            ? isMovable
              ? "bg-emerald-100 text-emerald-700"
              : "bg-gray-100 text-gray-500"
            : "bg-red-100 text-red-700"
        }">
            ${page.status == 1 ? "Aktivna" : "Neaktivna"}
        </span>
    </div>
    <p class="text-xs ${
      isMovable ? "text-gray-500" : "text-gray-400"
    } mb-2 truncate">${page.href}</p>
    ${
      !isMovable
        ? '<div class="text-xs text-amber-600 mb-2 flex items-center"><i class="fas fa-info-circle mr-1"></i>Fiksirana stranica</div>'
        : ""
    }
    <div class="flex space-x-2">
        <a href="${editLink}" 
            class="action-button flex-1 ${
              isMovable
                ? "bg-primary-600 hover:bg-primary-700"
                : "bg-gray-400 hover:bg-gray-500"
            } text-white py-1.5 px-3 rounded-md text-xs text-center font-medium">
            Uredi
        </a>
        <a href="${page.href}" target="_blank" 
            class="action-button flex-1 bg-gray-100 hover:bg-gray-200 ${
              isMovable ? "text-gray-700" : "text-gray-500"
            } py-1.5 px-3 rounded-md text-xs text-center font-medium">
            Pogledaj
        </a>
        <button onclick="deletePage('${page.id}')"
            class="${
              isMovable
                ? "bg-red-100 hover:bg-red-200 text-red-700"
                : "bg-gray-200 text-gray-400 cursor-not-allowed"
            } px-3 py-1.5 rounded-md text-xs font-medium"
            ${!isMovable ? "disabled" : ""}>
            Obriši
        </button>
    </div>
</div>
`;
}

function createAddTrackButton() {
  return `
        <div class="add-track-container" onclick="showAddColumnModal()">
            <div class="text-center text-gray-500">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                    <i class="fas fa-plus text-primary-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Dodaj kategoriju</h3>
                <p class="text-gray-500">Kreirajte novu kategoriju za organizovanje stranica</p>
                <p class="text-sm text-gray-400 mt-2">Maksimalno 8 kategorija</p>
            </div>
        </div>
    `;
}

function renderPageColumnsBoard() {
  const PageColumnsBoard = document.getElementById("PageColumns-board");
  const allPagesContainer = document.getElementById("all-pages-container");

  // Get all page IDs that are assigned to columns
  const assignedPageIds = new Set(Object.values(pageAssignments).flat());

  // Only show pages that aren't assigned to any column in the top section
  const unassignedPages = pages.filter((page) => !assignedPageIds.has(page.id));
  const unassignedPlaceholder = document.getElementById(
    "unassigned-placeholder"
  );

  if (unassignedPages.length === 0) {
    // If there are no unassigned pages, show the placeholder
    if (unassignedPlaceholder) unassignedPlaceholder.classList.remove("hidden");
  } else {
    // If there are unassigned pages, hide the placeholder
    if (unassignedPlaceholder) unassignedPlaceholder.classList.add("hidden");
  }

  allPagesContainer.innerHTML =
    unassignedPages.map(createPageCard).join("") +
    (document.getElementById("unassigned-placeholder")
      ? document.getElementById("unassigned-placeholder").outerHTML
      : "");

  // Render PageColumns tracks
  const tracksHtml = columns
    .map((column) => {
      const assignedPages = pageAssignments[column.id] || [];
      const pagesHtml = assignedPages
        .map((pageId) => {
          const page = pages.find((p) => p.id === pageId);
          return page ? createPageCard(page) : "";
        })
        .join("");

      return `
            <div class="PageColumns-track" data-column-id="${column.id}">
                <div class="track-header text-white p-4 ${column.color}">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold">${column.name}</h3>
                            <p class="text-sm opacity-90">${
                              assignedPages.length
                            } stranica</p>
                        </div>
                        <button class="delete-track-btn p-2 rounded-lg transition-all hover:scale-110" 
                                onclick="deleteColumn('${column.id}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="drop-zone p-6" data-column-id="${column.id}">
                    ${pagesHtml}
                    ${
                      pagesHtml === ""
                        ? '<div class="text-center text-gray-400 py-12"><i class="fas fa-inbox text-3xl mb-4"></i><p>Nema stranica u ovoj kategoriji</p><p class="text-sm">Prevucite stranice ovde</p></div>'
                        : ""
                    }
                </div>
            </div>
        `;
    })
    .join("");

  const addTrackHtml = columns.length < 8 ? createAddTrackButton() : "";
  PageColumnsBoard.innerHTML = tracksHtml + addTrackHtml;

  // Update total pages count and unassigned pages count
  document.getElementById("total-pages-count").textContent = pages.length;

  // Calculate unassigned pages count using already created assignedPageIds Set
  const unassignedPagesCount = pages.filter(
    (page) => !assignedPageIds.has(page.id)
  ).length;
  const unassignedCountElement = document.getElementById(
    "unassigned-pages-count"
  );
  if (unassignedCountElement) {
    unassignedCountElement.textContent = unassignedPagesCount;
  }

  setupDragAndDrop();
}

function setupDragAndDrop() {
  // Setup draggable cards (only for movable cards)
  document.querySelectorAll(".draggable-card").forEach((card) => {
    const isMovable = card.dataset.movable === "true";
    if (isMovable) {
      card.addEventListener("dragstart", handleDragStart);
      card.addEventListener("dragend", handleDragEnd);
      // Add visual feedback for draggable cards
      card.style.cursor = "grab";
    }
  });

  // Setup non-movable cards with different cursor
  document.querySelectorAll(".non-movable-card").forEach((card) => {
    card.style.cursor = "default";
    // Add tooltip to explain why it's not movable
    card.title = "Ova stranica je fiksirana i ne može se pomeriti";
  });

  // Setup drop zones
  document
    .querySelectorAll(".drop-zone, #all-pages-container")
    .forEach((zone) => {
      zone.addEventListener("dragover", handleDragOver);
      zone.addEventListener("dragenter", handleDragEnter);
      zone.addEventListener("dragleave", handleDragLeave);
      zone.addEventListener("drop", handleDrop);
    });
}

let draggedElement = null;

function handleDragStart(e) {
  // Double-check that the element is movable
  const isMovable = this.dataset.movable === "true";
  if (!isMovable) {
    e.preventDefault();
    return false;
  }

  draggedElement = this;
  this.classList.add("dragging");
  this.style.cursor = "grabbing";
  e.dataTransfer.effectAllowed = "move";
}

function handleDragEnd(e) {
  this.classList.remove("dragging");
  this.style.cursor = "grab";
  document
    .querySelectorAll(".drop-zone, #all-pages-container")
    .forEach((zone) => {
      zone.classList.remove("drag-over");
    });
}

function handleDragOver(e) {
  if (e.preventDefault) e.preventDefault();
  e.dataTransfer.dropEffect = "move";
  return false;
}

function handleDragEnter(e) {
  this.classList.add("drag-over");
}

function handleDragLeave(e) {
  if (!this.contains(e.relatedTarget)) {
    this.classList.remove("drag-over");
  }
}

function handleDrop(e) {
  e.preventDefault();
  const targetElement = this;
  const targetColumnId = targetElement.dataset.columnId;
  const pageId = draggedElement.dataset.pageId;

  if (!pageId) return;

  // Check if the dragged page is movable
  const page = pages.find((p) => p.id === pageId);
  if (!page || page.movable === false) {
    alert("Ova stranica je fiksirana i ne može se pomeriti!");
    targetElement.classList.remove("drag-over");
    return;
  }

  // Remove from any existing columns
  Object.keys(pageAssignments).forEach((colId) => {
    pageAssignments[colId] = pageAssignments[colId].filter(
      (id) => id !== pageId
    );
  });

  // If dropping into a column (not the unassigned section)
  if (targetColumnId && targetColumnId !== "unassigned") {
    if (!pageAssignments[targetColumnId]) {
      pageAssignments[targetColumnId] = [];
    }
    pageAssignments[targetColumnId].push(pageId);

    // Update the page's href to include column name
    const column = columns.find((col) => col.id === targetColumnId);
    if (column) {
      if (page) {
        // Get the original page name without column prefix
        const originalName = page.href.split("/").pop();
        // Update href to include column name
        page.href = `/${column.name.toLowerCase()}/${originalName}`;
      }
    }
  } else {
    // If dropping into unassigned section, remove column prefix from href
    if (page) {
      const parts = page.href.split("/").filter(Boolean);
      const pageName = parts[parts.length - 1];
      page.href = `/${pageName}`;
    }
  }

  renderPageColumnsBoard();
  targetElement.classList.remove("drag-over");
}

function showAddColumnModal() {
  if (columns.length >= 8) {
    alert("Možete dodati maksimalno 8 kategorija");
    return;
  }
  document.getElementById("add-column-modal").classList.remove("hidden");
  document.getElementById("column-name-input").focus();
}

function hideAddColumnModal() {
  document.getElementById("add-column-modal").classList.add("hidden");
  document.getElementById("column-name-input").value = "";
}

function addColumn() {
  const name = document.getElementById("column-name-input").value.trim();
  if (!name) return;

  const colors = [
    "from-purple-500 to-purple-600",
    "from-pink-500 to-pink-600",
    "from-indigo-500 to-indigo-600",
    "from-teal-500 to-teal-600",
    "from-cyan-500 to-cyan-600",
    "from-lime-500 to-lime-600",
    "from-amber-500 to-amber-600",
    "from-red-500 to-red-600",
  ];

  const columnId = "col-" + Date.now();
  const newColumn = {
    id: columnId,
    name: name,
    color: colors[columns.length % colors.length],
  };

  // Initialize the column in both data structures
  columns.push(newColumn);
  pageAssignments[columnId] = [];

  hideAddColumnModal();
  renderPageColumnsBoard();
}

function deleteColumn(columnId) {
  if (columns.length <= 1) {
    alert("Morate imati barem jednu kategoriju");
    return;
  }

  const column = columns.find((col) => col.id === columnId);
  if (
    confirm(
      `Da li ste sigurni da želite da obrišete kategoriju "${column.name}"?\nSve stranice iz ove kategorije će biti obrisane iz sistema.`
    )
  ) {
    // Remove all static pages from this column
    const pageIdsToDelete = pageAssignments[columnId] || [];
    for (const pageId of pageIdsToDelete) {
      const pageIndex = pages.findIndex((p) => p.id === pageId);
      if (pageIndex !== -1) {
        pages.splice(pageIndex, 1);
      }
    }
    // Remove column
    columns = columns.filter((col) => col.id !== columnId);
    delete pageAssignments[columnId];
    renderPageColumnsBoard();
    // Auto-save after column deletion
    savePageColumnsState();
  }
}

// Delete a single page
function deletePage(pageId) {
  const page = pages.find((p) => p.id === pageId);
  if (!page) return;

  // Check if page is movable (non-movable pages can't be deleted)
  if (page.movable === false) {
    alert("Ova stranica je fiksirana i ne može se obrisati!");
    return;
  }

  if (
    !confirm(`Da li ste sigurni da želite da obrišete stranicu "${page.name}"?`)
  ) {
    return;
  }

  fetch("/deletePage", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id: pageId }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Delete response:", data);
      if (data.success) {
        // Remove from local pages array
        const pageIndex = pages.findIndex((p) => p.id === pageId);
        if (pageIndex !== -1) {
          pages.splice(pageIndex, 1);
        }

        // Remove from any column assignments
        Object.keys(pageAssignments).forEach((colId) => {
          pageAssignments[colId] = pageAssignments[colId].filter(
            (id) => id !== pageId
          );
        });

        // Update UI
        renderPageColumnsBoard();
        // Auto-save after deletion
        savePageColumnsState();
      } else {
        throw new Error(data.error || "Greška prilikom brisanja stranice");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Došlo je do greške prilikom brisanja stranice: " + error.message);
    });
}

function savePageColumnsState(action = "update") {
  if (!Array.isArray(pages)) {
    console.error("Missing pages data");
    alert("Error: Missing pages data");
    return;
  }

  try {
    // If there are no pages at all, send an empty array to clear everything
    const assignedPageIds = new Set(Object.values(pageAssignments).flat());
    const pagesToSave =
      pages.length === 0
        ? []
        : pages.map((page) => {
            // Find which column this page is assigned to
            let assignedColumn = null;
            for (const [colId, ids] of Object.entries(pageAssignments)) {
              if (ids.includes(page.id)) {
                const col = columns.find((c) => c.id === colId);
                if (col) assignedColumn = col.name;
              }
            }
            return {
              ...page,
              column: assignedColumn, // null if not assigned
              movable: page.movable !== false, // Ensure movable property is preserved
            };
          });

    fetch("/savePage", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        pages: pagesToSave,
        columns: columns,
        type: "static",
        action: action,
        pageAssignments: pageAssignments,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Save response:", data);
        if (data.success) {
          alert("Stranice su uspešno sačuvane!");
          // Force hard reload with cache-busting to prevent serving stale content
          window.location.href =
            window.location.href +
            (window.location.href.includes("?") ? "&" : "?") +
            "t=" +
            Date.now();
        } else {
          throw new Error(data.error || "Error saving pages");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Došlo je do greške prilikom čuvanja stranica: " + error.message);
      });
  } catch (error) {
    console.error("Error saving PageColumns state:", error);
    alert("Error saving PageColumns state: " + error.message);
  }
}

// Event listeners
document
  .getElementById("confirm-add-column")
  .addEventListener("click", addColumn);
document
  .getElementById("cancel-column")
  .addEventListener("click", hideAddColumnModal);
document
  .getElementById("add-column-modal")
  .addEventListener("click", function (e) {
    if (e.target === this) hideAddColumnModal();
  });

document
  .getElementById("column-name-input")
  .addEventListener("keypress", function (e) {
    if (e.key === "Enter") addColumn();
  });

// Add event listeners for the new buttons
document
  .getElementById("add-column-btn")
  .addEventListener("click", showAddColumnModal);
document
  .getElementById("save-PageColumns-btn")
  .addEventListener("click", savePageColumnsState);
// Extract first path segment after leading slash
function getColumnFromHref(href) {
  if (!href || typeof href !== "string") return null;
  const parts = href.split("/").filter(Boolean); // remove empty strings
  return parts.length > 0 ? parts[0] : null;
}

// Load pages from JSON file with cache-busting
fetch(`/assets/data/pages.json?t=${Date.now()}`)
  .then((response) => {
    if (!response.ok) {
      throw new Error("JSON file not found");
    }
    console.log("Pages JSON loaded successfully");
    return response.json();
  })
  .then((data) => {
    console.log("Pages data:", data);
    pages.length = 0;
    const staticPages = data.filter((page) => page.static === true);
    pages.push(...staticPages);

    // Initialize columns from JSON if available
    if (data.columns && data.pageAssignments) {
      columns = data.columns;
      pageAssignments = data.pageAssignments;
    } else {
      // Get unique column names from pages (excluding null columns)
      const columnSet = new Set();
      staticPages.forEach((page) => {
        if (page.column && page.column !== "null") {
          columnSet.add(page.column);
        }
      });

      // Create columns from unique names
      const colors = [
        "purple",
        "pink",
        "indigo",
        "teal",
        "cyan",
        "lime",
        "amber",
        "red",
      ];
      columns = Array.from(columnSet).map((name, index) => ({
        id: `col-${Date.now()}-${index}`,
        name: name,
        color: `from-${colors[index % 8]}-500 to-${colors[index % 8]}-600`,
      }));

      // Initialize page assignments
      pageAssignments = {};
      columns.forEach((column) => {
        pageAssignments[column.id] = [];
      });

      // Assign pages to columns (null column pages will stay in unassigned)
      staticPages.forEach((page) => {
        if (page.column && page.column !== "null") {
          const column = columns.find((col) => col.name === page.column);
          if (column) {
            pageAssignments[column.id].push(page.id);
          }
        }
      });
    }

    renderPageColumnsBoard();
  })
  .catch((error) => {
    console.error("Error loading pages:", error);
    // If pages.json doesn't exist, start with a blank board and one default column
    const defaultColumnId = "col-default-" + Date.now();
    columns = [
      {
        id: defaultColumnId,
        name: "default",
        color: "from-indigo-500 to-indigo-600",
      },
    ];
    pageAssignments[defaultColumnId] = [];
    renderPageColumnsBoard();
  });

// Modal Functions - Define these before they are used
function showAddPageModal() {
  document.getElementById("add-page-modal").classList.remove("hidden");
  document.getElementById("page-name-input").focus();
}

function hideAddPageModal() {
  document.getElementById("add-page-modal").classList.add("hidden");
  document.getElementById("page-name-input").value = "";
}

// Initialize the board
renderPageColumnsBoard();
