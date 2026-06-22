<?php require_once('includes/head.php') ?>
<?php require_once('includes/header.php') ?>
<main>
    <div class="text-center page-banner p-5 m-md-3">
        <span class="eyebrow">Our story</span>
        <h1 class="display-4 fw-bold page-title">About {{BRAND}}</h1>
        <p class="lead page-lead">One concrete sentence about who you are and why you exist.</p>
    </div>

    <div class="container my-5">
        <!-- Story + stats -->
        <div class="row gy-5 align-items-center">
            <div class="col-md-6">
                <h2 class="section-title">Why we started</h2>
                <p class="story-text">Open on a concrete image, not a mission statement. Say the real reason this place exists, in plain words.</p>
                <p class="story-text">A second short paragraph. Specific details earn trust: what you make, how you make it, who it&rsquo;s for.</p>
            </div>
            <div class="col-md-6">
                <div class="saga-stats">
                    <div class="stat"><span class="stat-num">12</span><span class="stat-label">Years open</span></div>
                    <div class="stat"><span class="stat-num">40+</span><span class="stat-label">On the menu</span></div>
                    <div class="stat"><span class="stat-num">1</span><span class="stat-label">Neighborhood</span></div>
                    <div class="stat"><span class="stat-num">0</span><span class="stat-label">Shortcuts</span></div>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="row text-center mt-5 gy-4">
            <div class="col-md-4">
                <div class="value-card">
                    <h3 class="value-title">Value one</h3>
                    <p class="value-text">One sentence. Show it, don&rsquo;t assert it.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <h3 class="value-title">Value two</h3>
                    <p class="value-text">Keep each card to a single clear idea.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <h3 class="value-title">Value three</h3>
                    <p class="value-text">Concrete beats grand. Every time.</p>
                </div>
            </div>
        </div>

        <!-- Find us (free Google embed, no API key) -->
        <div class="text-center mt-5 pt-4">
            <h2 class="section-title">Find us</h2>
            <p class="story-text">123 Example St, Your City</p>
            <div class="map-embed mt-3">
                <iframe src="https://maps.google.com/maps?q=Los%20Angeles%2C%20CA&t=&z=12&ie=UTF8&iwloc=&output=embed"
                        title="Map to {{BRAND}}" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</main>
<?php require_once('includes/footer.php') ?>
