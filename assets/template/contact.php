<?php
$INBOX = 'hello@example.com';

$status = null;        // 'success' | 'error'
$message = '';
$old = ['name' => '', 'email' => '', 'notes' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $v) {
        $old[$k] = isset($_POST[$k]) ? trim($_POST[$k]) : '';
    }

    $errors = [];
    if ($old['name'] === '')                                $errors[] = 'a name';
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL))  $errors[] = 'a valid email';
    if ($old['notes'] === '')                               $errors[] = 'a message';

    if ($errors) {
        $status = 'error';
        $message = 'Please include ' . implode(', ', $errors) . '.';
    } else {
        // Header-injection guard: strip CR/LF from anything used in a header.
        $safe_name  = preg_replace('/[\r\n]+/', ' ', $old['name']);
        $safe_email = preg_replace('/[\r\n]+/', '', $old['email']);

        $headers  = "From: Website <no-reply@example.com>\r\n";
        $headers .= "Reply-To: {$safe_name} <{$safe_email}>\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $body = "Name: {$old['name']}\nEmail: {$old['email']}\n\n{$old['notes']}\n";

        if (@mail($INBOX, 'New message from the website', $body, $headers)) {
            $status = 'success';
            $message = 'Thanks! We\'ll be in touch shortly.';
            $old = ['name' => '', 'email' => '', 'notes' => ''];
        } else {
            $status = 'error';
            $message = 'Mail server unavailable. Please call us instead.';
        }
    }
}

function e($v) { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
?>
<?php require_once('includes/head.php') ?>
<?php require_once('includes/header.php') ?>
<main>
    <div class="text-center page-banner p-5 m-md-3">
        <h1 class="display-4 fw-bold page-title">Contact</h1>
        <p class="lead page-lead">Send us a note.</p>
    </div>

    <div class="container my-5">
        <div class="col-lg-7 mx-auto">
            <?php if ($status === 'success'): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php elseif ($status === 'error'): ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
            <?php endif; ?>

            <form action="contact.php" method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo e($old['name']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e($old['email']); ?>" required>
                </div>
                <div class="col-12">
                    <label for="notes" class="form-label">Message</label>
                    <textarea class="form-control" id="notes" name="notes" rows="4" required><?php echo e($old['notes']); ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-brand btn-lg">Send</button>
                </div>
            </form>
            <p class="mt-3"><small>Note: <code>mail()</code> needs SMTP configured on the host to actually deliver. For guaranteed delivery use a form service (Formspree, Web3Forms).</small></p>
        </div>
    </div>
</main>
<?php require_once('includes/footer.php') ?>
