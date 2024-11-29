<?php require base_path('views/partials/header.view.php') ?>

<main>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="/">
                <img class="mx-auto h-10 w-auto" src="<?= asset('images/php.svg') ?>" alt="Your Company">
            </a>
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Login to your account</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/login" method="POST">
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email Address</label>
                    <div class="mt-2">
                        <input id="email" name="email" value="<?= $_POST['email'] ?? '' ?>" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>

                    <?php if(isset($errors['email'])) : ?>
                        <p class="mt-2 text-red-500">
                            <?= $errors['email'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>

                    <?php if(isset($errors['password'])) : ?>
                        <p class="mt-2 text-red-500">
                            <?= $errors['password'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log In</button>
                </div>
            </form>
            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Not a member?
                <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Create new account</a>
            </p>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.view.php') ?>
