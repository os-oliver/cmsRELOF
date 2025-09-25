export function generateNavTree(target, tree, navID, dropDownclass) {
  const nav = target.find("*").find((child) => child.getId() === navID);
  if (!nav) return;

  nav.components().forEach((comp) => {
    // helper: determine if a component is marked static (supports `static` or `data-static`)
    const isComponentStatic = (c) => {
      try {
        const attrs = c.getAttributes ? c.getAttributes() : c.attributes || {};
        const s = attrs.static || attrs["data-static"];
        return (
          s === true || s === "true" || s === "1" || s === 1 || s === "yes"
        );
      } catch (e) {
        return false;
      }
    };
    const isMovable = (c) => {
      try {
        const attrs = c.getAttributes ? c.getAttributes() : c.attributes || {};
        const s = attrs.movable;
        return (
          s === true || s === "true" || s === "1" || s === 1 || s === "yes"
        );
      } catch (e) {
        return false;
      }
    };

    if (comp.get("tagName") == "a") {
      // Normal links
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
      tree.push({
        root: text,
        static: isComponentStatic(comp),
        movable: isMovable(comp),
      });
    } else if (
      comp.getClasses().includes(dropDownclass) &&
      !comp.getClasses().includes("nonPage")
    ) {
      // Normal dropdown handling
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
              current.elements.push({
                root: text,
                static: isComponentStatic(link),
                movable: isMovable(link),
              });
            }
          });
        }
      });
    } else if (comp.getClasses().includes("megaMenu")) {
      // 🟢 Special mega menu case: replace structure with dynamic PHP code
      const originalText = comp.view.el.textContent.trim() || "Menu";
      const mainTitle = originalText.split("[")[0].trim();
      const staticMenu = {
        type: "div",
        classes: ["dropdown", "relative", "group"],
        components: [
          {
            type: "button",
            classes: [
              "nav-link",
              "text-slate",
              "font-semibold",
              "hover:text-terracotta",
              "transition-colors",
              "flex",
              "items-center",
              "whitespace-nowrap",
            ],
            components: [
              {
                type: "i",
                classes: [
                  "fas",
                  "fa-info-circle",
                  "mr-2",
                  "text-ochre",
                  "group-hover:text-sage",
                  "transition-colors",
                ],
              },
              {
                type: "span",
                classes: ["hidden", "xl:inline"],
                content: `<p>${mainTitle}</p>`,
              },
              {
                type: "i",
                classes: ["fas", "fa-chevron-down", "ml-1", "text-xs"],
              },
            ],
          },
          {
            type: "div",
            classes: [
              "dropdown-menu",
              "absolute",
              "top-full",
              "left-0",
              "w-auto",
              "min-w-96",
              "max-w-5xl",
              "bg-paper",
              "rounded-md",
              "shadow-lg",
              "opacity-0",
              "invisible",
              "group-hover:opacity-100",
              "group-hover:visible",
              "transition-all",
              "duration-200",
              "z-50",
              "p-4",
              "grid",
              "grid-cols-1",
              "sm:grid-cols-2",
              "lg:grid-cols-3",
              "gap-6",
            ],
            components: [
              {
                type: "textnode",
                content:
                  "<?php foreach ($groupedPages as $column => $pages): ?>",
              },
              {
                type: "div",
                classes: ["w-full", "min-w-0"],
                components: [
                  {
                    type: "h3",
                    classes: [
                      "font-bold",
                      "text-slate",
                      "mb-3",
                      "text-sm",
                      "uppercase",
                      "tracking-wide",
                      "border-b",
                      "border-gray-200",
                      "pb-1",
                    ],
                    components: [
                      {
                        type: "textnode",
                        content: "<?= htmlspecialchars($column) ?>",
                      },
                    ],
                  },
                  {
                    type: "ul",
                    classes: ["space-y-1"],
                    components: [
                      {
                        type: "textnode",
                        content: "<?php foreach ($pages as $page): ?>",
                      },
                      {
                        type: "li",
                        components: [
                          {
                            type: "link",
                            classes: [
                              "flex",
                              "items-center",
                              "text-sm",
                              "py-1",
                              "px-2",
                              "rounded",
                              "hover:text-terracotta",
                              "hover:bg-gray-50",
                              "transition-all",
                              "duration-150",
                              "group/item",
                            ],
                            attributes: {
                              href: '<?= htmlspecialchars($page["href"]) ?>',
                            },
                            components: [
                              {
                                type: "span",
                                classes: [
                                  "w-1.5",
                                  "h-1.5",
                                  "bg-ochre",
                                  "rounded-full",
                                  "mr-2",
                                  "flex-shrink-0",
                                  "group-hover/item:bg-terracotta",
                                  "transition-colors",
                                ],
                              },
                              {
                                type: "textnode",
                                content:
                                  '<?= htmlspecialchars($page["name"]) ?>',
                              },
                            ],
                          },
                        ],
                      },
                      {
                        type: "textnode",
                        content: "<?php endforeach; ?>",
                      },
                    ],
                  },
                ],
              },
              {
                type: "textnode",
                content: "<?php endforeach; ?>",
              },
            ],
          },
        ],
      };

      comp.replaceWith(staticMenu);
    }
  });

  return tree;
}
