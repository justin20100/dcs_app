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
                <!-- Replace with your content -->
                <div class="px-4 py-6 sm:px-0">
                    <div class="h-96 rounded-lg border-4 border-dashed border-gray-200">
                        <h1>Modifier ma note</h1>
                        <form action="/note/put" method="POST">
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="id" value="<?= $note->id ?>">
                            <input type="text" name="description" value="<?= htmlspecialchars($note->description) ?>">
                            <button type="submit">Enregister les modifications</button>
                        </form>
                    </div>
                    <div>
                        <a href="/notes">Retourner à l'index des notes</a>
                    </div>
                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>

</body>

</html>
