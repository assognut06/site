<?php require_once '_partials/_header.php'; ?>

<body>
    <header>
        <?php require_once '_partials/admin/_nav.php' ?>
    </header>
    <main class='mt-5 pt-5'>
        <?= $contenu;  ?>
    </main>

    <?php require_once '_partials/admin/_footer.php'; ?>
    <?php require_once '_partials/_scripts.php'; ?>
</body>

</html>