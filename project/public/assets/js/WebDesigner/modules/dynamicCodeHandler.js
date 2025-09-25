function clearElements(element) {
  const newChildren = element
    .components()
    .filter((child) => child.get("tagName") === "i");

  element.components([]);
  newChildren.forEach((child) => element.append(child));
  element.components([newChildren]);
}

export function htmlToDynamicCode(target, type) {
  const components = target
    .components()
    .filter((child) => child.get("tagName") === "div");
  const nStartingCards = components.length;

  if (!nStartingCards) return;

  const modelDiv = components[0];
  const inputElements = modelDiv.find('[id^="g-"]');

  inputElements.forEach((element) => {
    const key = element.getId().slice(2);
    const tag = element.get("tagName").toLowerCase();

    if (tag === "img") {
      clearElements(element);
      element.addAttributes({
        imageSourceGen: `<?php echo $${type}_item['${key}'] ; ?>`,
      });
    } else {
      clearElements(element);
      element.append([
        {
          type: "textnode",
          content: `<?php echo htmlspecialchars($${type}_item['${key}'] ?? '', ENT_QUOTES); ?>`,
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

export function setupElement(child, landingPageFiles) {
  const id = child.getId();
  switch (id) {
    case "gallery": {
      const target = child
        .find("*")
        .find((model) => model.getId() === "galleryCards");
      htmlToDynamicCode(target, "images");
      const onceDecoded = child.toHTML().replace(/&amp;/g, "&");
      const fullyDecoded = onceDecoded
        .replace(/&lt;/g, "<")
        .replace(/&gt;/g, ">");
      landingPageFiles.push({
        [`landingPage/${id}.php`]: fullyDecoded,
      });
      break;
    }
    case "events": {
      const target = child
        .find("*")
        .find((model) => model.getId() === "eventsCards");
      htmlToDynamicCode(target, "events");
      const onceDecoded = child.toHTML().replace(/&amp;/g, "&");
      const fullyDecoded = onceDecoded
        .replace(/&lt;/g, "<")
        .replace(/&gt;/g, ">");
      landingPageFiles.push({
        [`landingPage/${id}.php`]: fullyDecoded,
      });
      break;
    }
    default:
      landingPageFiles.push({
        [`landingPage/${id}.php`]: child.toHTML(),
      });
  }
}
