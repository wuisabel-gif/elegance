<?php require_once('includes/head.php') ?>
<?php require_once('includes/header.php') ?>
<main>
    <div class="text-center page-banner p-5 m-md-3">
        <span class="eyebrow">The List</span>
        <h1 class="display-4 fw-bold page-title">Menu</h1>
        <p class="lead page-lead">Everything we offer, in one place.</p>
    </div>

    <div class="container my-5">
        <?php
        require('includes/menu-data.php');
        foreach ($items as $section => $rows): ?>
            <div class="mb-5">
                <h2 class="section-title section-divider"><?php echo $section; ?></h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                    <?php foreach ($rows as $r): ?>
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
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php require_once('includes/footer.php') ?>
