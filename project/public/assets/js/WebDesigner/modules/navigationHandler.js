export function generateNavTree(target, tree, navID, dropDownclass) {
  const nav = target.find("*").find((child) => child.getId() === navID);
  if (!nav) return;

  const isComponentStatic = (c) => {
    try {
      const attrs = c.getAttributes ? c.getAttributes() : c.attributes || {};
      const s = attrs.static || attrs["data-static"];
      return s === true || s === "true" || s === "1" || s === 1 || s === "yes";
    } catch (e) {
      return false;
    }
  };

  const isMovable = (c) => {
    try {
      const attrs = c.getAttributes ? c.getAttributes() : c.attributes || {};
      const s = attrs.movable;
      return s === true || s === "true" || s === "1" || s === 1 || s === "yes";
    } catch (e) {
      return false;
    }
  };

  const normalizeText = (text) =>
    text
      .trim()
      .replace(/\s+/g, "-")
      // Handle special Serbian/Croatian characters FIRST
      .replace(/đ/g, "dj")
      .replace(/Đ/g, "Dj")
      .replace(/š/g, "s")
      .replace(/Š/g, "S")
      .replace(/ž/g, "z")
      .replace(/Ž/g, "Z")
      .replace(/č/g, "c")
      .replace(/Č/g, "C")
      .replace(/ć/g, "c")
      .replace(/Ć/g, "C")
      // Now normalize for other diacritics
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      // Remove any remaining non-ASCII characters
      .replace(/[^\x00-\x7F]/g, "")
      .toLowerCase();

  nav.components().forEach((comp) => {
    console.log("Processing component:", comp.toHTML());
    if (comp.getClasses().includes("locale")) {
      console.log("Replacing locale selector with PHP code...");
      console.log("locale");
      const phpLocaleCode = `<?php
                if (isset($_GET['locale'])) {
                    $_SESSION['locale'] = $_GET['locale'];
                }
                $locale = $_SESSION['locale'] ?? 'sr';

                $languages = [
                    'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                    'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                    'en' => ['label' => 'English', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>'],
                ];
                 function buildLocaleUrl($newLocale) {
                    $currentParams = $_GET;

                    $updatedParams = array_merge($currentParams, ['locale' => $newLocale]);

                    return '?' . http_build_query($updatedParams);
                }
                
                if (!isset($languages[$locale])) {
                    $locale = 'sr';
                }
                ?>
                <div class="locale dropdown nonPage relative group">
                    <button
                        class="nav-link text-primary_text font-semibold hover:text-secondary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background group">
                        <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-surface rounded-xl shadow-2xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="<?= buildLocaleUrl($key) ?>"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                <span class="font-medium"><?= $lang['label'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

`;
      comp.replaceWith({ type: "textnode", content: phpLocaleCode });
    } else if (comp.get("tagName") === "a") {
      const el = comp.view.el;
      let txt = normalizeText(el.textContent);
      let text = txt
        .trim()
        .replace(/ /g, "-")
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
      let current;
      comp.components().forEach((ch) => {
        const tag = ch.get("tagName");
        if (tag === "button") {
          let text = normalizeText(ch.view.el.innerText);
          current = { root: text, elements: [] };
          tree.push(current);
        }
        if (tag === "div" && current) {
          ch.components().forEach((link) => {
            if (link.get("tagName") === "a") {
              const el = link.view.el;
              let txt = normalizeText(el.textContent);
              let text = txt
                .trim()
                .replace(/ /g, "-")
                .replace(/[^\x00-\x7F]/g, "");
              text = normalizeText(text);
              console.log("text:" + text);
              link.addAttributes({
                href: ("/" + current.root + "/" + text)
                  .toLowerCase()
                  .replace(/ /g, "-"),
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
      // Find all section-mega-menu divs
      comp.find(".section-mega-menu").forEach((section) => {
        const phpMegaMenuCode = `<?php foreach ($groupedPages as $column => $pages): ?>
    <div class="section-mega-menu">
        <h3 class="font-semibold text-slate mb-2 text-xs uppercase tracking-wider border-b border-gray-200 pb-1.5">
            <?= htmlspecialchars($column) ?>
        </h3>
        <ul class="space-y-1">
            <?php foreach ($pages as $page): ?>
                <li>
                    <a href="<?= htmlspecialchars($page['href']) ?>" 
                       class="flex items-center text-sm py-1.5 px-2 rounded hover:text-terracotta hover:bg-gray-50 transition-colors group/item">
                        <span class="w-1 h-1 bg-gray-400 rounded-full mr-2.5 flex-shrink-0 group-hover/item:bg-terracotta transition-colors"></span>
                        <span class="whitespace-nowrap"><?= htmlspecialchars($page['name']) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>`;

        section.replaceWith({ type: "textnode", content: phpMegaMenuCode });
      });
    }
  });

  return tree;
}
