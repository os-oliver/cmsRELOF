<section id="gallery" class="py-20 bg-white"><div class="container mx-auto px-4"><div class="text-center mb-16"><h2 class="text-4xl font-display font-bold text-slate mb-4">
                    Upoznajte Naš Prostor
                </h2><p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Moderni, inspirativni prostori dizajnirani za raznovrsne kulturne aktivnosti
                </p></div><div id="galleryCards" class="gallery-grid gap-6"><?php $__i = 0; foreach ($images as $images_item): if ($__i++ >= 6) break; ?>
<div class="gallery-item rounded-xl overflow-hidden relative"><img id="g-image_file_path" alt="Gallery Space" src="<?php echo $images_item['image_file_path'] ; ?>" class="w-full h-full object-cover"/><div class="overlay-content"><h3 id="g-description-2" class="font-bold text-lg"><?php echo htmlspecialchars($images_item['description-2'] ?? '', ENT_QUOTES); ?></h3><p id="g-title-2" class="text-sm"><?php echo htmlspecialchars($images_item['title-2'] ?? '', ENT_QUOTES); ?></p></div></div>
<?php endforeach; ?></div></div></section>