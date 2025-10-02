/* Kanban module for handling dynamic interactions with static pages
   Handles drag-drop, adding/removing pages, and column management
*/
(function () {
  const Kanban = {
    init: function () {
      this.initDragAndDrop();
      this.initColumnButtons();
      this.initPageCounters();
      this.setupEventListeners();
    },

    initDragAndDrop: function () {
      const containers = document.querySelectorAll(".drop-zone");
      containers.forEach((container) => {
        container.addEventListener("dragover", this.handleDragOver);
        container.addEventListener("dragleave", this.handleDragLeave);
        container.addEventListener("drop", this.handleDrop);
      });

      const draggables = document.querySelectorAll('[draggable="true"]');
      draggables.forEach((draggable) => {
        draggable.addEventListener("dragstart", this.handleDragStart);
        draggable.addEventListener("dragend", this.handleDragEnd);
      });
    },

    initColumnButtons: function () {
      // Add column button
      const addColumnBtn = document.getElementById("add-column-btn");
      if (addColumnBtn) {
        addColumnBtn.addEventListener("click", () => {
          const modal = document.getElementById("add-column-modal");
          if (modal) modal.classList.remove("hidden");
        });
      }

      // Cancel column button
      const cancelColumnBtn = document.getElementById("cancel-column");
      if (cancelColumnBtn) {
        cancelColumnBtn.addEventListener("click", () => {
          const modal = document.getElementById("add-column-modal");
          if (modal) modal.classList.add("hidden");
        });
      }

      // Confirm add column button
      const confirmAddColumnBtn = document.getElementById("confirm-add-column");
      if (confirmAddColumnBtn) {
        confirmAddColumnBtn.addEventListener(
          "click",
          this.handleAddColumn.bind(this)
        );
      }
    },
  };

  function getPageIcon() {
    return "";
  }

  function createPageCard(page) {
    const editLink = `http://localhost:8000/style?komponenta=${encodeURIComponent(
      page.file.replace(".php", "")
    )}`;
    const displayName = page.name || "Početna stranica";
    const isMovable = page.movable !== false;

    // card base classes
    const cardClasses = isMovable
      ? "draggable-card rounded-xl p-6 mb-4 bg-white border shadow-md transition-all duration-300 hover:shadow-xl border-gray-200 hover:border-blue-300"
      : "non-movable-card rounded-xl p-6 mb-4 bg-gray-50 border shadow-md border-gray-300 opacity-90 relative";

    const dragAttributes = isMovable ? 'draggable="true"' : "";

    // status badge classes
    const statusClasses =
      page.status == 1
        ? isMovable
          ? "bg-emerald-500 text-white"
          : "bg-gray-400 text-white"
        : "bg-red-500 text-white";

    return `
<div class="${cardClasses}" ${dragAttributes} data-page-id="${
      page.id
    }" data-movable="${isMovable}" role="article" aria-labelledby="page-title-${
      page.id
    }">
  
  ${
    !isMovable
      ? '<div class="absolute top-4 right-4"><i class="fas fa-lock text-gray-400 text-base" aria-hidden="true"></i></div>'
      : ""
  }
  
  <!-- Header Section -->
  <div class="mb-6">
    <div class="flex items-center gap-3 mb-3">
      <h3 id="page-title-${page.id}" class="${
      isMovable ? "text-gray-900" : "text-gray-700"
    } font-bold text-xl">${displayName}</h3>
      <span class="status-badge px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap shadow-sm ${statusClasses}">
        <i class="fas fa-${
          page.status == 1 ? "check" : "times"
        } mr-1" aria-hidden="true"></i>
        ${page.status == 1 ? "Aktivna" : "Neaktivna"}
      </span>
    </div>
    <div class="flex items-center gap-2 text-sm ${
      isMovable ? "text-gray-600" : "text-gray-500"
    }">
      <i class="fas fa-link text-xs" aria-hidden="true"></i>
      <p class="truncate font-medium" title="${page.href}">${page.href}</p>
    </div>
    ${
      !isMovable
        ? '<div class="mt-3 inline-flex items-center text-xs font-medium text-amber-700 bg-amber-100 px-3 py-1.5 rounded-md border border-amber-200"><i class="fas fa-info-circle mr-1.5" aria-hidden="true"></i>Fiksirana stranica</div>'
        : ""
    }
  </div>

  <!-- Actions Section -->
  <div class="flex flex-wrap gap-2">
    <a href="${editLink}"
       class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-md"
       title="Uredi stranicu" aria-label="Uredi ${displayName}">
       <i class="fas fa-pencil-alt text-sm mr-2" aria-hidden="true"></i>
       <span>Uredi</span>
    </a>

    <a href="${page.href}" target="_blank" rel="noopener"
       class="inline-flex items-center justify-center bg-gray-700 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-md"
       title="Pogledaj stranicu" aria-label="Pogledaj ${displayName}">
       <i class="fas fa-external-link-alt text-sm mr-2" aria-hidden="true"></i>
       <span>Pogledaj</span>
    </a>

    <button onclick="editCard('${page.id}')"
      class="inline-flex items-center justify-center bg-yellow-100 hover:bg-yellow-200 text-yellow-900 border border-yellow-300 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200"
      title="Izmeni karticu" aria-label="Izmeni karticu ${displayName}">
      <i class="fas fa-edit text-sm mr-2" aria-hidden="true"></i>
      <span>Izmeni</span>
    </button>

    <button onclick="duplicatePage('${page.id}')"
      class="inline-flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-900 border border-blue-300 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200"
      title="Dupliraj stranicu" aria-label="Dupliraj ${displayName}">
      <i class="fas fa-clone text-sm mr-2" aria-hidden="true"></i>
      <span>Dupliraj</span>
    </button>

    <button onclick="deletePage('${page.id}')"
      class="inline-flex items-center justify-center ${
        isMovable
          ? "bg-red-100 hover:bg-red-200 text-red-900 border border-red-300"
          : "bg-gray-200 text-gray-400 border border-gray-300 cursor-not-allowed opacity-50"
      } px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200"
      ${!isMovable ? "disabled" : ""}
      ${
        !isMovable
          ? "aria-disabled='true'"
          : "title='Obriši stranicu' aria-label='Obriši " + displayName + "'"
      }>
      <i class="fas fa-trash-alt text-sm mr-2" aria-hidden="true"></i>
      <span>Obriši</span>
    </button>
  </div>
</div>
`;
  }

  // Duplicate a page object with a new id and (optionally) a new name/file
  function duplicatePage(pageId) {
    const page = Kanban.pages.find((p) => p.id === pageId);
    if (!page) return;
    if (page.movable === false) {
      alert("Ova stranica je fiksirana i ne može se duplirati!");
      return;
    }

    const newName = prompt(
      "Unesite naziv za kopiju stranice:",
      page.name + " copy"
    );
    if (!newName) return;

    const fileName = newName.toLowerCase().replace(/\s+/g, "-") + ".php";
    const newPage = {
      ...page,
      id: generateUniqueId(),
      name: newName,
      file: fileName,
      path: "pages/" + fileName,
      href: "/" + newName.toLowerCase().replace(/\s+/g, "-"),
      created_at: new Date().toISOString().slice(0, 19).replace("T", " "),
    };

    Kanban.pages.push(newPage);

    // Optionally place the duplicated page into the same column(s)
    Object.keys(Kanban.pageAssignments).forEach((colId) => {
      const ids = Kanban.pageAssignments[colId] || [];
      if (ids.includes(pageId)) Kanban.pageAssignments[colId].push(newPage.id);
    });

    renderPageColumnsBoard();
    savePageColumnsState("duplicate");
  }

  // Edit card properties inline using prompt dialogs (simple, low-risk)
  function editCard(pageId) {
    const page = Kanban.pages.find((p) => p.id === pageId);
    if (!page) return;
    if (page.movable === false) {
      alert("Ova stranica je fiksirana i ne može se menjati ovde!");
      return;
    }

    const newName = prompt("Unesite novi naziv stranice:", page.name || "");
    if (newName === null) return; // cancelled
    const newHref = prompt(
      "Unesite novi href/patht (bez početnog /):",
      (page.href || "").replace(/^\//, "")
    );
    if (newHref === null) return;
    // Prevent duplicate names (case-insensitive) for other pages
    const dup = Kanban.pages.some(
      (p) =>
        p.id !== pageId &&
        (p.name || "").toLowerCase() === newName.trim().toLowerCase()
    );
    if (dup) {
      alert("Stranica sa tim nazivom već postoji");
      return;
    }

    // Update fields
    page.name = newName.trim() || page.name;
    const cleanedHref = newHref.trim()
      ? "/" + newHref.trim().replace(/\s+/g, "-")
      : page.href;
    page.href = cleanedHref;
    // Update file and path if name changed
    const newFile = page.name.toLowerCase().replace(/\s+/g, "-") + ".php";
    page.file = newFile;
    page.path = "pages/" + newFile;

    renderPageColumnsBoard();
    savePageColumnsState("edit");
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
    if (!PageColumnsBoard || !allPagesContainer) return;

    const assignedPageIds = new Set(
      Object.values(Kanban.pageAssignments).flat()
    );
    const unassignedPages = Kanban.pages.filter(
      (page) => !assignedPageIds.has(page.id)
    );
    const unassignedPlaceholder = document.getElementById(
      "unassigned-placeholder"
    );

    if (unassignedPages.length === 0) {
      if (unassignedPlaceholder)
        unassignedPlaceholder.classList.remove("hidden");
    } else {
      if (unassignedPlaceholder) unassignedPlaceholder.classList.add("hidden");
    }

    allPagesContainer.innerHTML =
      unassignedPages.map(createPageCard).join("") +
      (document.getElementById("unassigned-placeholder")
        ? document.getElementById("unassigned-placeholder").outerHTML
        : "");

    const tracksHtml = Kanban.columns
      .map((column) => {
        const assignedPages = Kanban.pageAssignments[column.id] || [];
        const pagesHtml = assignedPages
          .map((pageId) => {
            const page = Kanban.pages.find((p) => p.id === pageId);
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

    const addTrackHtml =
      Kanban.columns.length < 8 ? createAddTrackButton() : "";
    PageColumnsBoard.innerHTML = tracksHtml + addTrackHtml;

    const totalEl = document.getElementById("total-pages-count");
    if (totalEl) totalEl.textContent = Kanban.pages.length;

    const unassignedPagesCount = Kanban.pages.filter(
      (page) => !assignedPageIds.has(page.id)
    ).length;
    const unassignedCountElement = document.getElementById(
      "unassigned-pages-count"
    );
    if (unassignedCountElement)
      unassignedCountElement.textContent = unassignedPagesCount;

    setupDragAndDrop();
  }

  // Add drag state
  let draggedElement = null;

  // ... no default column handling — pages are either assigned to a named column or unassigned

  // Re-implement setupDragAndDrop - attach handlers to cards and drop zones
  function setupDragAndDrop() {
    // Cards
    const cards = Array.from(document.querySelectorAll("[data-page-id]"));
    cards.forEach((card) => {
      // Ensure draggable attribute reflects movable
      const movable =
        card.dataset.movable === "1" || card.dataset.movable === "true";
      if (movable) card.setAttribute("draggable", "true");
      else card.removeAttribute("draggable");

      card.removeEventListener("dragstart", onCardDragStart);
      card.removeEventListener("dragend", onCardDragEnd);

      card.addEventListener("dragstart", onCardDragStart);
      card.addEventListener("dragend", onCardDragEnd);
    });

    // Drop zones
    const dropZones = Array.from(document.querySelectorAll(".drop-zone"));
    dropZones.forEach((zone) => {
      zone.removeEventListener("dragover", onZoneDragOver);
      zone.removeEventListener("dragenter", onZoneDragEnter);
      zone.removeEventListener("dragleave", onZoneDragLeave);
      zone.removeEventListener("drop", onZoneDrop);

      zone.addEventListener("dragover", onZoneDragOver);
      zone.addEventListener("dragenter", onZoneDragEnter);
      zone.addEventListener("dragleave", onZoneDragLeave);
      zone.addEventListener("drop", onZoneDrop);
    });

    // Also setup unassigned container as a drop zone
    const allPagesContainer = document.getElementById("all-pages-container");
    if (allPagesContainer) {
      allPagesContainer.removeEventListener("dragover", onZoneDragOver);
      allPagesContainer.removeEventListener("drop", onZoneDrop);
      allPagesContainer.addEventListener("dragover", onZoneDragOver);
      allPagesContainer.addEventListener("drop", onZoneDrop);
    }
  }

  function onCardDragStart(e) {
    draggedElement = e.currentTarget;
    e.dataTransfer.effectAllowed = "move";
    try {
      e.dataTransfer.setData("text/plain", draggedElement.dataset.pageId || "");
    } catch (err) {
      // some browsers may throw
    }
    // highlight potential drop targets
    Array.from(document.querySelectorAll(".drop-zone")).forEach((z) =>
      z.classList.add("drag-target")
    );
  }

  function onCardDragEnd(e) {
    draggedElement = null;
    Array.from(document.querySelectorAll(".drop-zone")).forEach((z) =>
      z.classList.remove("drag-target", "drag-over")
    );
  }

  function onZoneDragOver(e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = "move";
    return false;
  }

  function onZoneDragEnter(e) {
    e.currentTarget.classList.add("drag-over");
  }

  function onZoneDragLeave(e) {
    e.currentTarget.classList.remove("drag-over");
  }

  function onZoneDrop(e) {
    e.preventDefault();
    const zone = e.currentTarget;
    const pageId =
      (e.dataTransfer &&
        e.dataTransfer.getData &&
        e.dataTransfer.getData("text/plain")) ||
      (draggedElement &&
        draggedElement.dataset &&
        draggedElement.dataset.pageId) ||
      null;
    if (!pageId) return;

    // Determine target column id (or 'unassigned' if drop to allPagesContainer)
    const targetColumnId = zone.dataset.columnId || "unassigned";

    // call existing logic to handle drop
    // find corresponding target element for handleDrop
    try {
      // Create a limited context similar to 'this' used in handleDrop
      const fauxThis = zone;
      // Use handleDrop function bound to zone
      handleDrop.call(fauxThis, e);
    } catch (err) {
      console.error("Drop handling failed", err);
    }
  }

  function handleDrop(e) {
    e.preventDefault();
    const targetElement = this;
    const targetColumnId = targetElement.dataset.columnId;
    const pageId =
      draggedElement && draggedElement.dataset
        ? draggedElement.dataset.pageId
        : null;
    if (!pageId) return;

    const page = Kanban.pages.find((p) => p.id === pageId);
    if (!page || page.movable === false) {
      alert("Ova stranica je fiksirana i ne može se pomeriti!");
      targetElement.classList.remove("drag-over");
      return;
    }

    Object.keys(Kanban.pageAssignments).forEach((colId) => {
      Kanban.pageAssignments[colId] = Kanban.pageAssignments[colId].filter(
        (id) => id !== pageId
      );
    });

    if (targetColumnId && targetColumnId !== "unassigned") {
      if (!Kanban.pageAssignments[targetColumnId])
        Kanban.pageAssignments[targetColumnId] = [];
      Kanban.pageAssignments[targetColumnId].push(pageId);
      const column = Kanban.columns.find((col) => col.id === targetColumnId);
      if (column && page) {
        const originalName = page.href.split("/").pop();
        page.href = `/${column.name.toLowerCase()}/${originalName}`;
      }
    } else {
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
    if (Kanban.columns.length >= 8) {
      alert("Možete dodati maksimalno 8 kategorija");
      return;
    }
    const el = document.getElementById("add-column-modal");
    if (el) el.classList.remove("hidden");
    const input = document.getElementById("column-name-input");
    if (input) input.focus();
  }

  function hideAddColumnModal() {
    const el = document.getElementById("add-column-modal");
    if (el) el.classList.add("hidden");
    const input = document.getElementById("column-name-input");
    if (input) input.value = "";
  }

  function addColumn() {
    const nameEl = document.getElementById("column-name-input");
    if (!nameEl) return;
    const name = nameEl.value.trim();
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
      color: colors[Kanban.columns.length % colors.length],
    };
    Kanban.columns.push(newColumn);
    Kanban.pageAssignments[columnId] = [];
    hideAddColumnModal();
    renderPageColumnsBoard();
  }

  function deleteColumn(columnId) {
    const column = Kanban.columns.find((col) => col.id === columnId);
    if (!column) return;

    // Do not allow deleting the default container
    if (column.name === "default") {
      alert("Default container cannot be deleted");
      return;
    }

    if (
      confirm(
        `Da li ste sigurni da želite da obrišete kategoriju "${column.name}"?\nSve stranice iz ove kategorije će biti premestjene u listu statickih stranica (bez kategorije).`
      )
    ) {
      // Remove assignments for this column so pages become unassigned
      const pageIdsToMove = Kanban.pageAssignments[columnId] || [];
      // simply delete the assignment bucket for this column
      delete Kanban.pageAssignments[columnId];
      // remove column from list
      Kanban.columns = Kanban.columns.filter((col) => col.id !== columnId);
      renderPageColumnsBoard();
      savePageColumnsState();
    }
  }

  function deletePage(pageId) {
    const page = Kanban.pages.find((p) => p.id === pageId);
    if (!page) return;
    if (page.movable === false) {
      alert("Ova stranica je fiksirana i ne može se obrisati!");
      return;
    }
    if (
      !confirm(
        `Da li ste sigurni da želite da obrišete stranicu "${page.name}"?`
      )
    )
      return;

    fetch("/admin/deletePage.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ href: page.href, id: pageId }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data && data.success) {
          console.log("fds");
          const pageIndex = Kanban.pages.findIndex((p) => p.id === pageId);
          if (pageIndex !== -1) Kanban.pages.splice(pageIndex, 1);
          Object.keys(Kanban.pageAssignments).forEach((colId) => {
            Kanban.pageAssignments[colId] = Kanban.pageAssignments[
              colId
            ].filter((id) => id !== pageId);
          });
          renderPageColumnsBoard();
          savePageColumnsState();
        } else {
          throw new Error(
            (data && data.error) || "Greška prilikom brisanja stranice"
          );
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert(
          "Došlo je do greške prilikom brisanja stranice: " +
            (error.message || error)
        );
      });
  }

  function savePageColumnsState(action = "update") {
    if (!Array.isArray(Kanban.pages)) {
      console.error("Missing pages data");
      alert("Error: Missing pages data");
      return;
    }

    try {
      // Ensure default column exists so pages with no explicit column land there

      // Ensure columns array includes all named columns present in assignments
      // (this also converts assignment keys into column names if needed)
      // Build reverse map: colId -> colName
      const colIdToName = {};
      Kanban.columns.forEach((c) => (colIdToName[c.id] = c.name));

      const pagesToSave =
        Kanban.pages.length === 0
          ? []
          : Kanban.pages.map((page) => {
              let assignedColumn = null;
              for (const [colId, ids] of Object.entries(
                Kanban.pageAssignments
              )) {
                if (ids.includes(page.id)) {
                  const colName =
                    colIdToName[colId] ||
                    (Kanban.columns.find((c) => c.id === colId) || {}).name;
                  if (colName) assignedColumn = colName;
                }
              }

              // Do NOT force a default column. If assignedColumn is null, page remains unassigned.
              return {
                ...page,
                column: assignedColumn || null,
                movable: page.movable !== false,
              };
            });

      fetch("/admin/savePage.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          pages: pagesToSave,
          columns: Kanban.columns,
          type: "static",
          action: action,
          pageAssignments: Kanban.pageAssignments,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data && data.success) {
            alert("Stranice su uspešno sačuvane!");
          } else {
            throw new Error((data && data.error) || "Error saving pages");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          alert(
            "Došlo je do greške prilikom čuvanja stranica: " +
              (error.message || error)
          );
        });
    } catch (error) {
      console.error("Error saving PageColumns state:", error);
      alert("Error saving PageColumns state: " + (error.message || error));
    }
  }

  // Helper to get first path segment
  function getColumnFromHref(href) {
    if (!href || typeof href !== "string") return null;
    const parts = href.split("/").filter(Boolean);
    return parts.length > 0 ? parts[0] : null;
  }

  // Initialize: attach listeners and load pages.json
  Kanban.init = function () {
    try {
      // Event listeners from original file
      const confirmAddColumn = document.getElementById("confirm-add-column");
      if (confirmAddColumn)
        confirmAddColumn.addEventListener("click", addColumn);
      const cancelColumn = document.getElementById("cancel-column");
      if (cancelColumn)
        cancelColumn.addEventListener("click", hideAddColumnModal);
      const addColumnModal = document.getElementById("add-column-modal");
      if (addColumnModal)
        addColumnModal.addEventListener("click", function (e) {
          if (e.target === this) hideAddColumnModal();
        });
      const columnNameInput = document.getElementById("column-name-input");
      if (columnNameInput)
        columnNameInput.addEventListener("keypress", function (e) {
          if (e.key === "Enter") addColumn();
        });
      const addColumnBtn = document.getElementById("add-column-btn");
      if (addColumnBtn)
        addColumnBtn.addEventListener("click", showAddColumnModal);
      const saveBtn = document.getElementById("save-PageColumns-btn");
      if (saveBtn) saveBtn.addEventListener("click", savePageColumnsState);

      const addPageBtn = document.getElementById("add-page-btn");
      if (addPageBtn) addPageBtn.addEventListener("click", showAddPageModal);

      // Prefer server-rendered DOM cards if present
      try {
        const serverCards = Array.from(
          document.querySelectorAll("[data-page-id]")
        );
        if (serverCards.length > 0) {
          Kanban.pages.length = 0;
          // collect column mapping
          const columnNameToId = new Map();
          const columnsList = [];
          serverCards.forEach((el) => {
            const id = el.dataset.pageId;
            const movable =
              el.dataset.movable === "1" || el.dataset.movable === "true";
            const titleEl = el.querySelector("h3");
            const linkEl = el.querySelector("p[title]");
            const name = titleEl ? titleEl.textContent.trim() : "";
            const href = linkEl ? linkEl.getAttribute("title") : "";
            const fileMatch = el.querySelector('a[href*="/style?komponenta="]');
            const file = fileMatch
              ? new URL(
                  fileMatch.href,
                  window.location.origin
                ).searchParams.get("komponenta") + ".php"
              : "";
            // detect column: prefer explicit data-column attribute, else infer from href
            const dataColumn = el.dataset.column || null;
            const inferred = dataColumn || getColumnFromHref(href) || "default";

            Kanban.pages.push({
              id: id,
              static: true,
              movable: movable,
              name: name,
              href: href,
              path: "pages/" + (file || ""),
              file: file || "",
              status: 1,
              column: inferred,
              created_at: new Date()
                .toISOString()
                .slice(0, 19)
                .replace("T", " "),
            });

            // register column name -> id
            if (!columnNameToId.has(inferred)) {
              const colId = `col-${Date.now()}-${columnNameToId.size}`;
              columnNameToId.set(inferred, colId);
              columnsList.push({ id: colId, name: inferred });
            }
          });

          // Populate Kanban.columns and pageAssignments from detected columns
          if (columnsList.length > 0) {
            // pick colors for columns
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
            Kanban.columns = columnsList.map((c, idx) => ({
              id: c.id,
              name: c.name,
              color: colors[idx % colors.length],
            }));
            Kanban.pageAssignments = {};
            Kanban.columns.forEach(
              (col) => (Kanban.pageAssignments[col.id] = [])
            );

            // assign pages
            Kanban.pages.forEach((p) => {
              const colName =
                p.column || getColumnFromHref(p.href) || "default";
              const colId = columnNameToId.get(colName);
              if (colId) {
                if (!Kanban.pageAssignments[colId])
                  Kanban.pageAssignments[colId] = [];
                Kanban.pageAssignments[colId].push(p.id);
              }
            });
          } else {
            // If no columns present, start with empty columns — columns are created by user
            Kanban.columns = [];
            Kanban.pageAssignments = {};
          }

          renderPageColumnsBoard();
        } else {
          // Fallback to fetching pageModel.php (DB endpoint)
          fetch("/pageModel.php")
            .then((response) => {
              if (!response.ok) throw new Error("JSON file not found");
              return response.json();
            })
            .then((data) => {
              Kanban.pages.length = 0;
              const staticPages = Array.isArray(data)
                ? data
                    .map((p) => ({
                      ...p,
                      static: !!p.static,
                      movable: p.movable !== false,
                    }))
                    .filter((page) => page.static === true)
                : [];
              Kanban.pages.push(...staticPages);

              if (data.columns && data.pageAssignments) {
                Kanban.columns = data.columns;
                Kanban.pageAssignments = data.pageAssignments;
              } else {
                const columnSet = new Set();
                staticPages.forEach((page) => {
                  if (page.column && page.column !== "null")
                    columnSet.add(page.column);
                });
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
                Kanban.columns = Array.from(columnSet).map((name, index) => ({
                  id: `col-${Date.now()}-${index}`,
                  name: name,
                  color: `from-${colors[index % 8]}-500 to-${
                    colors[index % 8]
                  }-600`,
                }));
                Kanban.pageAssignments = {};
                Kanban.columns.forEach((column) => {
                  Kanban.pageAssignments[column.id] = [];
                });
                staticPages.forEach((page) => {
                  if (page.column && page.column !== "null") {
                    const column = Kanban.columns.find(
                      (col) => col.name === page.column
                    );
                    if (column) Kanban.pageAssignments[column.id].push(page.id);
                  }
                });
              }

              renderPageColumnsBoard();
            })
            .catch((error) => {
              console.error("Error loading pages:", error);
              // leave columns empty — pages will remain unassigned
              Kanban.columns = [];
              Kanban.pageAssignments = {};
              renderPageColumnsBoard();
            });
        }
      } catch (err) {
        console.error("Kanban init DOM fallback failed", err);
      }
    } catch (e) {
      console.error("Kanban init failed", e);
    }
  };

  // Modal functions used by templates
  function showAddPageModal() {
    const el = document.getElementById("add-page-modal");
    if (el) el.classList.remove("hidden");
    const input = document.getElementById("page-name-input");
    if (input) input.focus();
  }
  function hideAddPageModal() {
    const el = document.getElementById("add-page-modal");
    if (el) el.classList.add("hidden");
    const input = document.getElementById("page-name-input");
    if (input) input.value = "";
  }

  // Export to global scope for templates/onclick usages
  window.Kanban = Kanban;
  window.handleAddPage = handleAddPage;
  window.showAddPageModal = showAddPageModal;
  window.hideAddPageModal = hideAddPageModal;
  window.deletePage = deletePage;
  window.deleteColumn = deleteColumn;
  window.showAddColumnModal = showAddColumnModal;
  window.duplicatePage = duplicatePage;
  window.editCard = editCard;
  window.savePageColumnsState = savePageColumnsState;
  window.renderPageColumnsBoard = renderPageColumnsBoard;
})();
