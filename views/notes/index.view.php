<?php require base_path('views/partials/header.view.php') ?>
<?php require base_path('views/partials/nav.view.php') ?>
<?php require base_path('views/partials/banner.view.php') ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <ul>
            <?php if (count($notes)) : ?>
                <?php foreach ($notes as $note) : ?>
                    <li class="leading-7">
                        <a href="<?= '/note?id=' . $note['id'] ?>" class="text-blue-600 hover:text-blue-800">
                            <?= htmlspecialchars($note['body']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-cyan-600 text-2xl">No data found!</p>
            <?php endif; ?>
        </ul>
        <div class="mt-6">
            <a href="/notes/create" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Create Note
            </a>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.view.php') ?>
