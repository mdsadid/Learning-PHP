<?php require base_path('views/partials/header.view.php') ?>
<?php require base_path('views/partials/nav.view.php') ?>
<?php require base_path('views/partials/banner.view.php') ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <p class="mb-4 text-xl">
            <a href="/notes" class="text-cyan-600 underline hover:text-cyan-500">Back</a>
        </p>
        <p class="text-5xl text-blue-600"><?= $note['body'] ?></p>
        <div class="mt-7 flex flex-row gap-x-4">
            <a href="<?= '/notes/edit?id=' . $note['id'] ?>" class="rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                Edit Note
            </a>
            <form method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                    Delete Note
                </button>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.view.php') ?>
