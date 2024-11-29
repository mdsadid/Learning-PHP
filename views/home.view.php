<?php require base_path('views/partials/header.view.php') ?>
<?php require base_path('views/partials/nav.view.php') ?>
<?php require base_path('views/partials/banner.view.php') ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <p>Hi <?= $_SESSION['user']['email'] ?? 'guest' ?>, Welcome Back!</p>
    </div>
</main>

<?php require base_path('views/partials/footer.view.php') ?>
