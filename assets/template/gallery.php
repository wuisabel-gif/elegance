<?php require_once('includes/head.php') ?>
<?php require_once('includes/header.php') ?>
<main>
    <div class="text-center page-banner p-5 m-md-3">
        <span class="eyebrow">A look around</span>
        <h1 class="display-4 fw-bold page-title">Gallery</h1>
        <p class="lead page-lead">A short line about what these photos show.</p>
    </div>

    <div class="container my-5">
        <?php
        // [image, caption]
        $photos = [
            ['assets/gallery-1.jpg', 'Caption one'],
            ['assets/gallery-2.jpg', 'Caption two'],
            ['assets/gallery-3.jpg', 'Caption three'],
            ['assets/gallery-4.jpg', 'Caption four'],
            ['assets/gallery-5.jpg', 'Caption five'],
            ['assets/gallery-6.jpg', 'Caption six'],
        ];
        ?>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            <?php foreach ($photos as $p): ?>
                <div class="col">
                    <figure class="tile">
                        <img src="<?php echo $p[0]; ?>" alt="<?php echo strip_tags($p[1]); ?>" loading="lazy">
                        <figcaption><?php echo $p[1]; ?></figcaption>
                    </figure>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Lightbox: click a tile to enlarge -->
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-hidden="true">
        <button class="lightbox-close" type="button" aria-label="Close">&times;</button>
        <img class="lightbox-img" id="lightbox-img" src="" alt="">
        <div class="lightbox-caption" id="lightbox-caption"></div>
    </div>
    <script>
    (function () {
        var lb = document.getElementById('lightbox'),
            img = document.getElementById('lightbox-img'),
            cap = document.getElementById('lightbox-caption');
        function close() { lb.classList.remove('open'); lb.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; }
        document.querySelectorAll('.tile').forEach(function (fig) {
            fig.addEventListener('click', function () {
                var i = fig.querySelector('img'), c = fig.querySelector('figcaption');
                img.src = i.src; img.alt = i.alt; cap.innerHTML = c ? c.innerHTML : '';
                lb.classList.add('open'); lb.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden';
            });
        });
        lb.addEventListener('click', function (e) { if (e.target === lb || e.target.classList.contains('lightbox-close')) close(); });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
    })();
    </script>
</main>
<?php require_once('includes/footer.php') ?>
