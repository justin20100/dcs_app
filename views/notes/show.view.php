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
                        <h1>Ma note</h1>
                        <p><?= htmlspecialchars($note->description) ?></p>
                    </div>
                    <form action="note/delete" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="<?= $note->id ?>">
                        <button type="submit">suprimer la note</button>
                    </form>
                    <div>
                        <a href="/note/update?id=<?= $note->id; ?>">modifier la note</a>
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
