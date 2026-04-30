<!-- GALLERY SECTION: slide show galerie -->
<section id="gallery-section" class="section-panel gallery-section">
    <h2>Slide show galerie</h2>
    <p>Prezentace několika obrázků jako ukázka galerie s ovládacími prvky.</p>
    <!-- Galerie obsahuje snímky a šipky pro přepínání obrázků -->
    <div class="gallery-wrapper" aria-label="Galerie obrázků" role="region">
        <div class="gallery-slide active">
            <img src="https://picsum.photos/seed/hero1/900/500" alt="Ukázková fotografie 1" />
            <div class="gallery-caption">Krásná ukázka první fotografie pro slideshow.</div>
        </div>
        <div class="gallery-slide">
            <img src="https://picsum.photos/seed/hero2/900/500" alt="Ukázková fotografie 2" />
            <div class="gallery-caption">Druhá fotografie s moderním designem.</div>
        </div>
        <div class="gallery-slide">
            <img src="https://picsum.photos/seed/hero3/900/500" alt="Ukázková fotografie 3" />
            <div class="gallery-caption">Třetí snímek vhodný pro prezentaci tématu.</div>
        </div>
        <button id="galleryPrev" class="gallery-arrow prev" type="button" aria-label="Předchozí snímek">‹</button>
        <button id="galleryNext" class="gallery-arrow next" type="button" aria-label="Další snímek">›</button>
    </div>
    <div class="gallery-dots" aria-label="Výběr snímku" role="tablist"></div>
</section>
