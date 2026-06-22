<?php
require('includes/menu-data.php');

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];
if ($q !== '') {
    $needle = mb_strtolower(html_entity_decode($q, ENT_QUOTES, 'UTF-8'));
    foreach ($items as $section => $rows) {
        foreach ($rows as $r) {
            $hay = mb_strtolower(html_entity_decode($r[0] . ' ' . $r[2] . ' ' . $section, ENT_QUOTES, 'UTF-8'));
            if (mb_strpos($hay, $needle) !== false) {
                $results[] = ['item' => $r, 'section' => $section];
            }
        }
    }
}
?>
<?php require_once('includes/head.php') ?>
<?php require_once('includes/header.php') ?>
<main>
    <div class="text-center page-banner p-5 m-md-3">
        <h1 class="display-4 fw-bold page-title">Search</h1>
        <form class="d-flex justify-content-center mt-4" role="search" action="search.php" method="get">
            <input class="form-control me-2" style="max-width:360px" type="search" name="q"
                   placeholder="Search&hellip;" aria-label="Search" autofocus
                   value="<?php echo htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>">
            <button class="btn btn-brand" type="submit">Search</button>
        </form>
    </div>

    <div class="container my-5">
        <?php if ($q === ''): ?>
            <p class="text-center">Type something to search the menu.</p>
        <?php elseif (count($results) === 0): ?>
            <p class="text-center">No results for &ldquo;<?php echo htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>&rdquo;.</p>
            <div class="text-center"><a class="btn btn-outline-brand" href="menu.php">Browse the full menu</a></div>
        <?php else: ?>
            <h2 class="section-title section-divider">
                <?php echo count($results); ?> result<?php echo count($results) === 1 ? '' : 's'; ?>
                for &ldquo;<?php echo htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>&rdquo;
            </h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                <?php foreach ($results as $res): $r = $res['item']; ?>
                    <div class="col">
                        <div class="card-x h-100">
                            <img class="card-photo" src="<?php echo $r[3]; ?>" alt="<?php echo strip_tags($r[0]); ?>" loading="lazy">
                            <div class="card-body-x">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h3 class="card-name"><?php echo $r[0]; ?></h3>
                                    <span class="card-price"><?php echo $r[1]; ?></span>
                                </div>
                                <p class="card-desc"><?php echo $r[2]; ?></p>
                                <p class="card-section"><?php echo $res['section']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php require_once('includes/footer.php') ?>
