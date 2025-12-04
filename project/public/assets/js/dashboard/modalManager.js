export default class ModalManager {
  constructor({ slug = null, baseUrl = "/editor" } = {}) {
    this.slug = slug;
    this.baseUrl = baseUrl;
  }

  _createElementFromHTML(html) {
    const wrapper = document.createElement("div");
    wrapper.innerHTML = html.trim();
    return wrapper.firstElementChild;
  }

  async fetchModal(id = null) {
    const s = this.slug || window.SLUG || document.body.dataset.slug || "";
    const url = `${this.baseUrl}/getModal?slug=${encodeURIComponent(s)}${
      id ? `&id=${encodeURIComponent(id)}` : ""
    }`;
    const res = await fetch(url, { credentials: "same-origin" });
    if (!res.ok) throw new Error("Neuspešno učitavanje modala: " + res.statusText);
    const html = await res.text();
    if (!html || html.trim().length === 0)
      throw new Error("Prazan sadržaj modala je vraćen");
    return html;
  }

  show(html) {
    const modalEl = this._createElementFromHTML(html);
    if (!modalEl) throw new Error("Nevalidna struktura modala");

    document.body.appendChild(modalEl);
    this.attachListeners(modalEl);
    return modalEl;
  }

  close(container) {
    if (!container) return;
    if (container.remove) container.remove();
  }

  showMessage(form, text, type = "error") {
    form.querySelector(".p-3.rounded-lg.mb-4")?.remove();

    let classes = "";
    if (type === "error") {
      classes = "bg-red-100 text-red-800 border border-red-300";
    } else if (type === "success") {
      classes = "bg-green-100 text-green-800 border border-green-300";
    } else {
      return;
    }

    const msg = document.createElement("div");
    msg.className = `p-3 rounded-lg mb-4 ${classes}`;
    msg.textContent = text;
    form.prepend(msg);
  }

  _attachFileInput(inp, container) {
    if (inp.__previewAttached) return;
    inp.__previewAttached = true;

    const nameSanitized = inp.name.replace(/\[\]$/, "");
    if (!inp.__dt) inp.__dt = new DataTransfer();

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

    renderFiles();
  }

  attachListeners(container) {
    if (!container || container.__modalInitialized) return;
    container.__modalInitialized = true;

    this._injectLoaderStyles();

    container.querySelectorAll(".cancel-modal").forEach((el) => {
      el.addEventListener("click", (e) => {
        e.preventDefault();
        this.close(container);
      });
    });

    container.addEventListener("click", (e) => {
      if (e.target === container) this.close(container);
    });

    const form = container.querySelector("form");
    if (!form) return;

    form
      .querySelectorAll("input[type=file]")
      .forEach((inp) => this._attachFileInput(inp, container));

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

    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      const submitBtn = form.querySelector("button[type=submit]");
      if (submitBtn?.disabled) return;

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.classList.add("opacity-70");
      }

      const loaderOverlay = createLoaderOverlay();
      document.body.appendChild(loaderOverlay);

      const fd = new FormData(form);
      const s = this.slug || window.SLUG || document.body.dataset.slug || "";
      if (s && !fd.has("type")) fd.append("type", s);

      let res, json;
      try {
        res = await fetch(`${this.baseUrl}/insert`, {
          method: "POST",
          body: fd,
          credentials: "same-origin",
        });
        json = await res.json();

        if (res.ok && json.success) {
          form.querySelector(".p-3.rounded-lg.mb-4")?.remove();
          
          showSuccessCheck(loaderOverlay);

          setTimeout(() => {
                      loaderOverlay.remove();

            window.location.reload();

            this.close(container);
          }, 500); 
        } else {
          loaderOverlay.remove();
          this.showMessage(form, json?.error || "Neuspelo čuvanje", "error");
          
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove("opacity-70");
          }
        }
      } catch (err) {
        console.error(err);
        loaderOverlay.remove();
        this.showMessage(form, "Greška u mreži", "error");
        
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.classList.remove("opacity-70");
        }
      }
    });

    function createLoaderOverlay() {
      const overlay = document.createElement("div");
      overlay.className = "modal-manager-loader-overlay";
      overlay.id = "loader-overlay";

      const spinnerContainer = document.createElement("div");
      spinnerContainer.id = "spinner-container";
      spinnerContainer.className = "modal-manager-spinner";

      overlay.appendChild(spinnerContainer);
      return overlay;
    }

    function showSuccessCheck(overlay) {
        const spinner = overlay.querySelector('#spinner-container');
        if (!spinner) return;
        
        spinner.classList.remove("modal-manager-spinner");
        spinner.classList.add("modal-manager-success-circle");

        const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svg.setAttribute("class", "modal-manager-checkmark");
        svg.setAttribute("viewBox", "0 0 52 52");
        
        const circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        circle.setAttribute("class", "modal-manager-checkmark-circle");
        circle.setAttribute("cx", "26");
        circle.setAttribute("cy", "26");
        circle.setAttribute("r", "25");
        circle.setAttribute("fill", "none");
        
        const check = document.createElementNS("http://www.w3.org/2000/svg", "path");
        check.setAttribute("class", "modal-manager-checkmark-check");
        check.setAttribute("fill", "none");
        check.setAttribute("d", "M14.1 27.2l7.1 7.2 16.7-16.8");
        
        svg.appendChild(circle);
        svg.appendChild(check);
        spinner.appendChild(svg);
    }
  }

  _injectLoaderStyles() {
    if (document.getElementById('modal-manager-styles')) return;

    const style = document.createElement('style');
    style.id = 'modal-manager-styles';
    style.innerHTML = `
      @keyframes modalManagerSpin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      }
      
      @keyframes modalManagerScaleIn {
          0% { 
              transform: scale(0);
          }
          50% {
              transform: scale(1.1);
          }
          100% { 
              transform: scale(1);
          }
      }
      
      @keyframes modalManagerCheckmark {
          0% {
              stroke-dashoffset: 50;
          }
          100% {
              stroke-dashoffset: 0;
          }
      }
      
      @keyframes modalManagerCircleGrow {
          0% {
              stroke-dashoffset: 166;
          }
          100% {
              stroke-dashoffset: 0;
          }
      }

      .modal-manager-loader-overlay {
          position: fixed;
          inset: 0;
          background-color: rgba(0,0,0,0.7);
          z-index: 9999;
          display: flex;
          justify-content: center;
          align-items: center;
      }

      .modal-manager-spinner {
          border: 5px solid rgba(255, 255, 255, 0.15);
          border-top: 5px solid #fff;
          border-radius: 50%;
          width: 60px;
          height: 60px;
          animation: modalManagerSpin 0.8s linear infinite;
      }

      .modal-manager-success-circle {
          width: 80px;
          height: 80px;
          background-color: #10B981;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          animation: modalManagerScaleIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
          box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
      }

      .modal-manager-checkmark {
          width: 52px;
          height: 52px;
      }
      
      .modal-manager-checkmark-circle {
          stroke: #fff;
          stroke-width: 2;
          stroke-dasharray: 166;
          stroke-dashoffset: 166;
          animation: modalManagerCircleGrow 0.3s ease-out forwards;
      }
      
      .modal-manager-checkmark-check {
          stroke: #fff;
          stroke-width: 3;
          stroke-linecap: round;
          stroke-linejoin: round;
          stroke-dasharray: 48;
          stroke-dashoffset: 48;
          animation: modalManagerCheckmark 0.1s 0.1s ease-out forwards;
      }
    `;
    document.head.appendChild(style);
  }
}