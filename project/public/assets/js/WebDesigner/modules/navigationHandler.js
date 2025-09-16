export function generateNavTree(target, tree, navID, dropDownclass) {
  const nav = target.find("*").find((child) => child.getId() === navID);
  if (!nav) return;

  nav.components().forEach((comp) => {
    if (comp.get("tagName") == "a") {
      const el = comp.view.el;
      let text = el.textContent
        .trim()
        .replace(" ", "-")
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/[^\x00-\x7F]/g, "")
        .toLowerCase();

      if (text == "pocetna") text = "";
      comp.addAttributes({ href: "/" + text });
      comp.view.render();
      tree.push({ root: text });
    } else if (
      comp.getClasses().includes(dropDownclass) &&
      !comp.getClasses().includes("nonPage")
    ) {
      let current;
      comp.components().forEach((ch) => {
        const tag = ch.get("tagName");

        if (tag === "button") {
          const text = ch.view.el.innerText.trim();
          current = { root: text, elements: [] };
          tree.push(current);
        }

        if (tag === "div" && current) {
          ch.components().forEach((link) => {
            if (link.get("tagName") == "a") {
              const el = link.view.el;
              const text = el.textContent
                .trim()
                .replace(" ", "-")
                .replace(/[^\x00-\x7F]/g, "");
              link.addAttributes({
                href: ("/" + current.root + "/" + text)
                  .toLowerCase()
                  .replace(" ", "-"),
              });
              link.view.render();
              current.elements.push({ root: text });
            }
          });
        }
      });
    }
  });
  return tree;
}
