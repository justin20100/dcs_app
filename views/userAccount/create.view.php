<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
    <div class="min-h-full">
        <?php require base_path( 'views/partials/nav.view.php') ?>
        <?php require base_path('views/partials/header.view.php') ?>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <form method="post" action="/register">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Create a new user</h2>
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="col-span-full">
                                    <div class="mt-2">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" name="firstname" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=  $_POST['firstname'] ?? '';?>" placeholder="Jhon"></input>
                                        <label for="lastname">Lastname</label>
                                        <input type="text" name="lastname" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=  $_POST['lastname'] ?? '';?>" placeholder="Doe"></input>
                                        <label for="email">Email</label>
                                        <?php if (isset($errors['email'])): ?>
                                            <p><?= $errors['email']; ?></p>
                                        <?php endif; ?>
                                        <input type="text" name="email" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=  $_POST['email'] ?? '';?>" placeholder="jhon.doe@gmail.com"></input>
                                        <label for="password">Password (Minimum 8 caracteres, 1 majuscule, 1minuscule, 1 symbole par exemple: <?= $suggested_password ?>)</label>
                                        <?php if (isset($errors['password'])): ?>
                                            <p><?= $errors['password']; ?></p>
                                        <?php endif; ?>
                                        <input type="password" name="password" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=  $_POST['password'] ?? '';?>"></input>
                                    </div>
                                </div>
                                <input type="hidden" name="currentUserId" value="<?= $currentUserId ?>">
                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="submit" class="rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register a new user</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>

</html>