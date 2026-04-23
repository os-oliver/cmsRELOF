export default class ModalManager {
  constructor({ slug = null, baseUrl = "/editor" } = {}) {
    this.slug = slug;
    this.baseUrl = baseUrl;
  }

  // Helper: kreira DOM element iz HTML stringa
  _createElementFromHTML(html) {
    const wrapper = document.createElement("div");
    wrapper.innerHTML = html.trim();
    return wrapper.firstElementChild;
  }

  // Učitaj modal HTML sa servera
  async fetchModal(id = null) {
    const s = this.slug || window.SLUG || document.body.dataset.slug || "";
    const url = `${this.baseUrl}/getModal?slug=${encodeURIComponent(s)}${
      id ? `&id=${encodeURIComponent(id)}` : ""
    }`;
    const res = await fetch(url, { credentials: "same-origin" });
    if (!res.ok)
      throw new Error("Neuspešno učitavanje modala: " + res.statusText);
    const html = await res.text();
    if (!html || html.trim().length === 0)
      throw new Error("Prazan sadržaj modala je vraćen");
    return html;
  }

  // Prikaži modal u DOM-u i zakači listener-e
  show(html) {
    const modalEl = this._createElementFromHTML(html);
    if (!modalEl) throw new Error("Nevalidna struktura modala");

    // Dodaj modal i zakači event-ove
    document.body.appendChild(modalEl);
    this.attachListeners(modalEl);
    return modalEl;
  }

  // Zatvori modal
  close(container) {
    if (!container) return;
    if (container.remove) container.remove();
  }

  // Prikaži poruku u formi
  showMessage(form, text, type = "error") {
    const msg = document.createElement("div");
    msg.className = `p-3 rounded-lg mb-4 ${
      type === "success"
        ? "bg-green-100 text-green-800 border border-green-300"
        : "bg-red-100 text-red-800 border border-red-300"
    }`;
    msg.textContent = text;
    form.prepend(msg);
  }

  // ---- Interna logika za rad sa file input-ima ----
  _attachFileInput(inp, container) {
    if (inp.__previewAttached) return;
    inp.__previewAttached = true;

    const nameSanitized = inp.name.replace(/\[\]$/, "");
    if (!inp.__dt) inp.__dt = new DataTransfer();

    // Ako postoji inicijalni fajl state (npr. browser autofill), preseli ga u DataTransfer
    if (inp.files?.length && inp.__dt.files.length === 0) {
      for (const f of inp.files) inp.__dt.items.add(f);
      inp.files = inp.__dt.files;
    }

    const findPreview = () => {
      const selectors = [
        `#preview-${nameSanitized}`,
        `[id*="preview_${nameSanitized}"]`,
      ];
      for (const sel of selectors) {
        const el = container.querySelector(sel);
        if (el) return el;
      }
      const c = document.createElement("div");
      c.id = `preview-${nameSanitized}`;
      c.className = "mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4";
      inp.parentNode.appendChild(c);
      return c;
    };

    const renderFiles = () => {
      const preview = findPreview();
      preview.innerHTML = "";
      const files = Array.from(inp.__dt.files || []);

      files.forEach((file, idx) => {
        const isImage =
          /\.(jpe?g|png|gif|webp|bmp|svg)$/i.test(file.name) ||
          file.type?.startsWith("image/");
        const wrapper = document.createElement("div");
        wrapper.className =
          "relative group rounded-lg overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition";

        if (isImage) {
          const img = document.createElement("img");
          img.src = URL.createObjectURL(file);
          img.className = "w-full h-32 object-cover";
          wrapper.appendChild(img);
        } else {
          wrapper.innerHTML = `<div class="w-full h-32 p-3 bg-gray-50 flex flex-col items-center justify-center gap-2">
              <i class="fas fa-file text-3xl"></i>
              <div class="text-sm font-medium text-gray-700 truncate w-full text-center px-2">${
                file.name
              }</div>
              <div class="text-xs text-gray-500">${Math.round(
                file.size / 1024
              )} KB</div>
            </div>`;
        }

        const overlay = document.createElement("div");
        overlay.className =
          "absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-end p-2";
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className =
          "w-full text-white text-xs bg-red-600 px-3 py-1.5 rounded hover:bg-red-700 transition";
        btn.innerHTML = '<i class="fas fa-trash"></i> Remove';
        btn.addEventListener("click", () => {
          const dt = new DataTransfer();
          files.forEach((f, i) => {
            if (i !== idx) dt.items.add(f);
          });
          inp.__dt = dt;
          inp.files = inp.__dt.files;
          renderFiles();
        });

        overlay.appendChild(btn);
        wrapper.appendChild(overlay);
        preview.appendChild(wrapper);
      });
    };

    inp.addEventListener("change", (ev) => {
      const selected = Array.from(ev.target.files || []);
      if (!selected.length) {
        if (!inp.multiple) {
          inp.__dt = new DataTransfer();
          inp.files = inp.__dt.files;
        }
        renderFiles();
        return;
      }

      if (inp.multiple) {
        for (const f of selected) {
          const exists = Array.from(inp.__dt.files).some(
            (of) => of.name === f.name && of.size === f.size
          );
          if (!exists) inp.__dt.items.add(f);
        }
      } else {
        inp.__dt = new DataTransfer();
        inp.__dt.items.add(selected[0]);
      }
      inp.files = inp.__dt.files;
      renderFiles();
    });

    // inicijalni prikaz
    renderFiles();
  }

  // Zakacivanje svih potrebnih listener-a na modal container
  attachListeners(container) {
    if (!container || container.__modalInitialized) return;
    container.__modalInitialized = true;

    // zatvaranje preko .cancel-modal
    container.querySelectorAll(".cancel-modal").forEach((el) => {
      el.addEventListener("click", (e) => {
        e.preventDefault();
        this.close(container);
      });
    });

    // zatvaranje klikom van modalnog sadržaja
    container.addEventListener("click", (e) => {
      if (e.target === container) this.close(container);
    });

    const form = container.querySelector("form");
    if (!form) return;

    // file inputs
    form
      .querySelectorAll("input[type=file]")
      .forEach((inp) => this._attachFileInput(inp, container));

    // dugmad za označavanje postojecih fajlova za brisanje
    container.querySelectorAll(".existing-remove-btn").forEach((btn) => {
      if (btn.__removeHandlerAttached) return;
      btn.__removeHandlerAttached = true;

      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const checkbox = container.querySelector(
          `input[type="checkbox"][name="remove_${btn.dataset.field}[]"][value="${btn.dataset.value}"]`
        );
        if (checkbox) checkbox.checked = true;

        const wrapper = btn.closest(".existing-file-wrapper");
        if (wrapper) {
          wrapper.style.cssText =
            "opacity: 0.4; filter: grayscale(100%); position: relative;";
          const badge = document.createElement("div");
          badge.className =
            "absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded";
          badge.textContent = "Marked for removal";
          wrapper.appendChild(badge);
          btn.disabled = true;
        }
      });
    });

    // submit forme
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const submitBtn = form.querySelector("button[type=submit]");
      if (submitBtn?.disabled) return;

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.classList.add("opacity-70");
      }

      const fd = new FormData(form);
      const s = this.slug || window.SLUG || document.body.dataset.slug || "";
      if (s && !fd.has("type")) fd.append("type", s);

      try {
        const res = await fetch(`${this.baseUrl}/insert`, {
          method: "POST",
          body: fd,
          credentials: "same-origin",
        });
        const json = await res.json();

        if (res.ok && json.success) {
          this.showMessage(form, "Uspešno sačuvano!", "success");
          setTimeout(() => window.location.reload(), 800);
        } else {
          this.showMessage(form, json?.error || "Neuspelo čuvanje", "error");
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove("opacity-70");
          }
        }
      } catch (err) {
        console.error(err);
        this.showMessage(form, "Greška u mreži", "error");
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.classList.remove("opacity-70");
        }
      }
    });
  }
}
