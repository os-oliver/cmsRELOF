(() => {
  if (window.__imageZoomViewerInitialized) return;
  window.__imageZoomViewerInitialized = true;

  const style = document.createElement("style");
  style.textContent = `.image-zoom-viewer{position:fixed;inset:0;z-index:10000;display:grid;place-items:center;padding:72px 24px 64px;background:rgba(8,12,16,.96);opacity:0;visibility:hidden;pointer-events:none;transition:opacity 160ms ease,visibility 160ms ease}.image-zoom-viewer.is-open{opacity:1;visibility:visible;pointer-events:auto}.image-zoom-stage{width:100%;height:100%;display:grid;place-items:center;overflow:hidden}.image-zoom-image{max-width:100%;max-height:100%;width:auto;height:auto;object-fit:contain;transform-origin:center;user-select:none;-webkit-user-drag:none;touch-action:none;cursor:grab}.image-zoom-image.is-dragging{cursor:grabbing}.image-zoom-toolbar{position:absolute;top:max(16px,env(safe-area-inset-top));right:max(16px,env(safe-area-inset-right));display:flex;align-items:center;gap:8px;padding:8px;color:#fff;background:rgba(20,26,32,.88);border:1px solid rgba(255,255,255,.18);border-radius:10px;backdrop-filter:blur(12px)}.image-zoom-button{width:42px;height:42px;display:grid;place-items:center;border:0;border-radius:7px;color:#fff;background:transparent;font:600 24px/1 sans-serif;cursor:pointer}.image-zoom-button:hover{background:rgba(255,255,255,.14)}.image-zoom-button:focus-visible{outline:2px solid #fff;outline-offset:2px}.image-zoom-level{min-width:48px;text-align:center;font:500 13px/1 sans-serif;font-variant-numeric:tabular-nums}.image-zoom-caption{position:absolute;bottom:max(16px,env(safe-area-inset-bottom));left:20px;right:20px;color:rgba(255,255,255,.82);text-align:center;font:14px/1.4 sans-serif;pointer-events:none}@media(max-width:520px){.image-zoom-viewer{padding:76px 12px 64px}.image-zoom-toolbar{gap:4px;padding:6px}.image-zoom-button{width:40px;height:40px}}@media(prefers-reduced-motion:reduce){.image-zoom-viewer{transition:none}}`;
  document.head.appendChild(style);

  const viewer = document.createElement("div");
  viewer.className = "image-zoom-viewer";
  viewer.setAttribute("role", "dialog");
  viewer.setAttribute("aria-modal", "true");
  viewer.setAttribute("aria-label", "Uvećani prikaz slike");
  viewer.innerHTML = `<div class="image-zoom-toolbar" role="toolbar" aria-label="Kontrole zumiranja"><button class="image-zoom-button" type="button" data-zoom-out aria-label="Umanji sliku">-</button><span class="image-zoom-level" aria-live="polite">100%</span><button class="image-zoom-button" type="button" data-zoom-in aria-label="Uvećaj sliku">+</button><button class="image-zoom-button" type="button" data-zoom-reset aria-label="Vrati početnu veličinu">1:1</button><button class="image-zoom-button" type="button" data-zoom-close aria-label="Zatvori prikaz">X</button></div><div class="image-zoom-stage"><img class="image-zoom-image" alt=""></div><div class="image-zoom-caption"></div>`;
  document.body.appendChild(viewer);

  const zoomImage = viewer.querySelector(".image-zoom-image");
  const zoomLevel = viewer.querySelector(".image-zoom-level");
  const closeButton = viewer.querySelector("[data-zoom-close]");
  let sourceImage = null;
  let scale = 1;
  let offsetX = 0;
  let offsetY = 0;
  let dragStart = null;
  let previousOverflow = "";

  const update = () => {
    zoomImage.style.transform = `translate(${offsetX}px,${offsetY}px) scale(${scale})`;
    zoomLevel.textContent = `${Math.round(scale * 100)}%`;
  };
  const setScale = (value) => {
    scale = Math.min(5, Math.max(1, value));
    if (scale === 1) offsetX = offsetY = 0;
    update();
  };
  const open = (image) => {
    const src = image.currentSrc || image.src;
    if (!src) return;
    sourceImage = image;
    zoomImage.src = src;
    zoomImage.alt = image.alt || "";
    viewer.querySelector(".image-zoom-caption").textContent = image.alt || "";
    scale = 1; offsetX = offsetY = 0; update();
    previousOverflow = document.body.style.overflow;
    document.body.style.overflow = "hidden";
    viewer.classList.add("is-open");
    closeButton.focus();
  };
  const close = () => {
    if (!viewer.classList.contains("is-open")) return;
    viewer.classList.remove("is-open");
    document.body.style.overflow = previousOverflow;
    zoomImage.removeAttribute("src");
    sourceImage?.focus();
    sourceImage = null;
  };
  const imageFromClick = (event) => {
    const target = event.target instanceof Element ? event.target : event.target?.parentElement;
    if (!target || viewer.contains(target)) return null;
    const image = target.closest("img");
    const control = target.closest("a,button,input,select,textarea,[role='button']");
    if (control && (!image || !control.contains(image))) return null;
    if (image) return image;
    for (let parent = target; parent && parent !== document.body; parent = parent.parentElement) {
      for (const candidate of parent.querySelectorAll("img")) {
        const rect = candidate.getBoundingClientRect();
        if (event.clientX >= rect.left && event.clientX <= rect.right && event.clientY >= rect.top && event.clientY <= rect.bottom) return candidate;
      }
    }
    return null;
  };

  document.querySelectorAll("img").forEach((image) => {
    if (image.closest("[data-no-image-zoom]")) return;
    image.tabIndex = 0;
    image.setAttribute("role", "button");
    image.setAttribute("aria-haspopup", "dialog");
    if (!image.hasAttribute("aria-label")) image.setAttribute("aria-label", image.alt ? `Uvećaj sliku: ${image.alt}` : "Uvećaj sliku");
  });

  const attachedLightboxes = new WeakSet();
  const attachLightboxZoom = (modal) => {
    if (attachedLightboxes.has(modal)) return;
    const image = modal.querySelector("#modalImage, #lightboxImage");
    if (!image) return;
    attachedLightboxes.add(modal);

    const toolbar = document.createElement("div");
    toolbar.className = "image-zoom-toolbar";
    toolbar.style.left = "50%";
    toolbar.style.right = "auto";
    toolbar.style.transform = "translateX(-50%)";
    toolbar.style.zIndex = "1000001";
    toolbar.innerHTML = `
      <button class="image-zoom-button" type="button" data-modal-zoom-out aria-label="Umanji sliku">-</button>
      <span class="image-zoom-level" aria-live="polite">100%</span>
      <button class="image-zoom-button" type="button" data-modal-zoom-in aria-label="Uvećaj sliku">+</button>
      <button class="image-zoom-button" type="button" data-modal-zoom-reset aria-label="Vrati početnu veličinu">1:1</button>
    `;
    modal.appendChild(toolbar);

    const level = toolbar.querySelector(".image-zoom-level");
    let modalScale = 1;
    const setModalScale = (value) => {
      modalScale = Math.min(5, Math.max(1, value));
      image.style.transformOrigin = "center";
      image.style.transform = `scale(${modalScale})`;
      level.textContent = `${Math.round(modalScale * 100)}%`;
    };
    const resetModalScale = () => setModalScale(1);

    toolbar.querySelector("[data-modal-zoom-in]").addEventListener("click", (event) => {
      event.stopPropagation();
      setModalScale(modalScale + 0.25);
    });
    toolbar.querySelector("[data-modal-zoom-out]").addEventListener("click", (event) => {
      event.stopPropagation();
      setModalScale(modalScale - 0.25);
    });
    toolbar.querySelector("[data-modal-zoom-reset]").addEventListener("click", (event) => {
      event.stopPropagation();
      resetModalScale();
    });
    image.addEventListener("load", resetModalScale);
    new MutationObserver(resetModalScale).observe(modal, {
      attributes: true,
      attributeFilter: ["class"],
    });
    new MutationObserver(resetModalScale).observe(image, {
      attributes: true,
      attributeFilter: ["src"],
    });
  };

  const attachExistingLightboxes = () => {
    document.querySelectorAll("#galleryModal, #lightbox").forEach(attachLightboxZoom);
  };
  attachExistingLightboxes();
  new MutationObserver(attachExistingLightboxes).observe(document.body, {
    childList: true,
    subtree: true,
  });

  document.addEventListener("click", (event) => {
    const image = imageFromClick(event);
    if (!image || image.closest("[data-no-image-zoom], #galleryModal, #lightbox, .gallery-image-link")) return;
    event.preventDefault();
    event.stopImmediatePropagation();
    open(image);
  }, true);
  document.addEventListener("keydown", (event) => {
    if (viewer.classList.contains("is-open")) {
      if (event.key === "Escape") close();
      else if (event.key === "+" || event.key === "=") setScale(scale + .25);
      else if (event.key === "-") setScale(scale - .25);
      else if (event.key === "Home") setScale(1);
    } else if ((event.key === "Enter" || event.key === " ") && event.target.matches?.("img")) {
      event.preventDefault(); open(event.target);
    }
  });
  viewer.querySelector("[data-zoom-in]").addEventListener("click", () => setScale(scale + .25));
  viewer.querySelector("[data-zoom-out]").addEventListener("click", () => setScale(scale - .25));
  viewer.querySelector("[data-zoom-reset]").addEventListener("click", () => setScale(1));
  closeButton.addEventListener("click", close);
  viewer.addEventListener("click", (event) => {
    if (event.target === viewer || event.target.classList.contains("image-zoom-stage")) close();
  });
  viewer.addEventListener("wheel", (event) => {
    if (!viewer.classList.contains("is-open")) return;
    event.preventDefault(); setScale(scale + (event.deltaY < 0 ? .25 : -.25));
  }, { passive: false });
  zoomImage.addEventListener("pointerdown", (event) => {
    if (scale <= 1) return;
    dragStart = { x: event.clientX - offsetX, y: event.clientY - offsetY };
    zoomImage.setPointerCapture(event.pointerId);
    zoomImage.classList.add("is-dragging");
  });
  zoomImage.addEventListener("pointermove", (event) => {
    if (!dragStart) return;
    offsetX = event.clientX - dragStart.x; offsetY = event.clientY - dragStart.y; update();
  });
  const stopDragging = () => { dragStart = null; zoomImage.classList.remove("is-dragging"); };
  zoomImage.addEventListener("pointerup", stopDragging);
  zoomImage.addEventListener("pointercancel", stopDragging);
})();
