<?php require_once('includes/head.php') ?>
<?php require_once('includes/header.php') ?>
<main>
    <!-- Hero -->
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center hero">
        <div class="col-md-7 p-lg-5 mx-auto my-5 position-relative hero-content">
            <span class="eyebrow">{{EYEBROW}}</span>
            <h1 class="display-2 fw-bold hero-title">{{BRAND}}</h1>
            <p class="lead hero-lead">{{TAGLINE}}. One or two concrete sentences that set the scene.</p>
            <a class="btn btn-brand btn-lg me-2" href="contact.php">Primary action</a>
            <a class="btn btn-outline-brand btn-lg" href="menu.php">Secondary action</a>
        </div>
    </div>

    <!-- Featured items -->
    <div class="container my-5">
        <h2 class="section-title text-center">Featured</h2>
        <?php
        require('includes/menu-data.php');
        $featured = array_slice(reset($items), 0, 3);
        ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            <?php foreach ($featured as $r): ?>
                <div class="col">
                    <div class="card-x h-100">
                        <img class="card-photo" src="<?php echo $r[3]; ?>" alt="<?php echo strip_tags($r[0]); ?>" loading="lazy">
                        <div class="card-body-x">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h3 class="card-name"><?php echo $r[0]; ?></h3>
                                <span class="card-price"><?php echo $r[1]; ?></span>
                            </div>
                            <p class="card-desc"><?php echo $r[2]; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center my-5">
            <a class="btn btn-outline-brand btn-lg" href="menu.php">See everything</a>
        </div>
    </div>
</main>
<?php require_once('includes/footer.php') ?>
