function clearElements(element) {
  const newChildren = element.components().filter((child) => {
    const tag = child.get("tagName");
    return tag === "i" || tag === "span";
  });
  element.components([]);
  newChildren.forEach((child) => element.append(child));
}

export function htmlToDynamicCode(target, type) {
  const components = target.components().filter((child) => {
    const tag = child.get("tagName");
    return tag === "div" || tag === "li" || tag === "article";
  });

  const nStartingCards = components.length;
  if (!nStartingCards) return;

  const modelDiv = components[0];
  const inputElements = modelDiv.find('[id^="g-"]');

  inputElements.forEach((element) => {
    let key = element.getId().slice(2);
    const tag = element.get("tagName").toLowerCase();
    key = key.replace(/-?\d+/g, "").replace(/-$/g, "");

    if (tag === "a" && element.getId().startsWith("g-ovise")) {
      element.addAttributes({
        href: `<?php echo "/sadrzaj?id=" . htmlspecialchars($${type}_item->id, ENT_QUOTES) . "&tip=${type}"; ?>`,
      });
    } else if (tag === "img") {
      const phpContent =
        key === "slika"
          ? `<?php echo htmlspecialchars(isset($${type}_item->slika) ? $${type}_item->slika : ($${type}_item->image ?? ''), ENT_QUOTES); ?>`
          : `<?php echo htmlspecialchars($${type}_item->${key} ?? '', ENT_QUOTES); ?>`;
      clearElements(element);
      element.addAttributes({ imageSourceGen: phpContent });
    } else {
      clearElements(element);
      element.append([
        {
          type: "textnode",
          content: `<?php echo htmlspecialchars($${type}_item->${key} ?? '', ENT_QUOTES); ?>`,
        },
      ]);
    }
  });

  let templateHTML = modelDiv
    .toHTML()
    .replace(/\ssrc="[^"]*"/g, "")
    .replace(/imageSourceGen=/g, "src=");
  const phpLoop = `<?php $__i = 0; foreach ($${type} as $${type}_item): if ($__i++ >= ${nStartingCards}) break; ?>${templateHTML}<?php endforeach; ?>`;

  target.components([]);
  target.append([{ type: "textnode", content: phpLoop }]);
}

export function setupElement(child, landingPageFiles, sectionId) {
  const id = child.getId();
  const element = child.getAttributes()?.["data-elements"]?.trim() || "";
  let combinedId = id;

  const target = child
    .find("*")
    .find((model) => model.getId() === `${id}Cards`);

  if (target) {
    const dynamicType = id === "gallery" ? "images" : id;
    htmlToDynamicCode(target, dynamicType, sectionId);
    const fullyDecoded = child
      .toHTML()
      .replace(/&amp;/g, "&")
      .replace(/&lt;/g, "<")
      .replace(/&gt;/g, ">");
    landingPageFiles.push({
      [`landingPage/${combinedId}.php`]: fullyDecoded,
    });
  } else {
    landingPageFiles.push({
      [`landingPage/${combinedId}.php`]: child.toHTML(),
    });
  }
  combinedId = element ? `${id}-${element}` : id;
  console.log("combined:" + combinedId);
  return combinedId;
}
