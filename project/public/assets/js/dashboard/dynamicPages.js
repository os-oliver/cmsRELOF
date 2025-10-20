const root = document.getElementById("page-root");
const slug = root.dataset.slug;
const locale = root.dataset.locale;
import ModalManager from "/assets/js/dashboard/modalManager.js";

// Kreiramo default instancu koja se može koristiti i eksterno
const defaultManager = new ModalManager({
  slug: slug,
});

// Inicijalizacija UI veza
export function init({
  slug = null,
  newBtnSelector = "#newEventButton",
  baseUrl = "/editor",
} = {}) {
  if (slug) defaultManager.slug = slug;
  defaultManager.baseUrl = baseUrl;

  const newBtn = document.querySelector(newBtnSelector);
  newBtn?.addEventListener("click", async (e) => {
    e.preventDefault();
    const btn = e.currentTarget;
    btn.disabled = true;

    try {
      const html = await defaultManager.fetchModal();
      defaultManager.show(html);
    } catch (err) {
      console.error("Modal error:", err);
      alert("Greška pri učitavanju modalnog prozora: " + (err.message || err));
    } finally {
      btn.disabled = false;
    }
  });

  // Delegirani handler za edit/delete dugmad
  document.addEventListener("click", async (e) => {
    const editBtn = e.target.closest?.(".edit-item");
    const deleteBtn = e.target.closest?.(".delete-item");

    if (editBtn) {
      e.preventDefault();
      const id = editBtn.dataset.id;
      if (!id) return;

      try {
        const html = await defaultManager.fetchModal(id);
        defaultManager.show(html);
      } catch (err) {
        console.error(err);
        alert("Greška pri učitavanju: " + (err.message || err));
      }
    }

    if (deleteBtn) {
      e.preventDefault();
      const id = deleteBtn.dataset.id;
      if (!id) return;
      if (!confirm("Da li ste sigurni da želite da obrišete ovu stavku?"))
        return;

      try {
        const form = new FormData();
        form.append("id", id);
        const res = await fetch(`${defaultManager.baseUrl}/delete`, {
          method: "POST",
          body: form,
          credentials: "same-origin",
        });
        const json = await res.json();

        if (res.ok && json.success) {
          const card = deleteBtn.closest(".group");
          if (card) {
            card.style.cssText =
              "transition: all 0.3s; opacity: 0; transform: scale(0.9);";
            setTimeout(() => window.location.reload(), 300);
          } else {
            window.location.reload();
          }
        } else {
          alert(json.message || "Brisanje nije uspelo");
        }
      } catch (err) {
        console.error(err);
        alert("Greška u mreži prilikom brisanja");
      }
    }
  });
}
if (typeof window !== "undefined") {
  // Delay init until DOMContentLoaded da bi elementi bili prisutni
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => init());
  } else {
    init();
  }
}

export { defaultManager as modalManager };
export default { init, modalManager: defaultManager };
