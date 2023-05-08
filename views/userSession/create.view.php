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
                <form method="post" action="/login">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Login to your account</h2>
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="col-span-full">
                                    <div class="mt-2">
                                        <label for="email">Email</label>
                                        <?php if (isset($_SESSION['errors']['email'])): ?>
                                            <p><?= $_SESSION['errors']['email']; ?></p>
                                        <?php endif; ?>
                                        <input type="text" name="email" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=  $_SESSION['olds']['email'] ?? '';?>" placeholder="jhon.doe@gmail.com" required></input>
                                        <label for="password">Password</label>
                                        <?php if (isset($_SESSION['errors']['password'])): ?>
                                            <p><?= $_SESSION['errors']['password']; ?></p>
                                        <?php endif; ?>
                                        <input type="password" name="password" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=  $_SESSION['olds']['password'] ?? '';?>" required></input>
                                    </div>
                                </div>
                                <input type="hidden" name="currentUserId" value="<?= $currentUserId ?>">
                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="submit" class="rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <?php if (isset($_SESSION['flash']['succes'])): ?>
        <script>
            alert('<?= $_SESSION['flash']['succes'] ?>')
        </script>
    <?php endif; ?>
</body>
</html>
