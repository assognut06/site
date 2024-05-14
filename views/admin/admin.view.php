<?php
// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    ob_start();
    include 'views/admin/adminBarre.php';
    if (isset($_GET['item']) && $_GET['item'] === 'orders') {
        include_once 'views/admin/includes/orders/orders.php';
    }
    if (isset($_GET['item']) && $_GET['item'] === 'payments') {     
        include_once 'views/admin/includes/payments/payments.php';
    }
    echo "<p class='text-center'>Bienvenue sur la page admin !</p>";
    $contenu = ob_get_clean();
    require_once 'views/admin/gabarit.php';
    exit;
}

// Traitement des données du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'], $_POST['password'])) {
    if ($_POST['username'] === USERNAME && password_verify($_POST['password'], PASSWORD_HASH)) {
        // Authentification réussie
        $_SESSION['loggedin'] = true;
        header("Location: ?" . $_SERVER['QUERY_STRING']);
        exit;
    } else {
        $error = "Identifiant ou mot de passe incorrect.";
    }
}

// Formulaire de connexion
?>
<?php ob_start() ?>
<!--Contenu-->
<div class="container text-center">
    <h2 class="text-success">Login Admin</h2>
    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="adminUsername" class="form-label">Identifiant</label>
            <input type="text" class="form-control" name="username" required id="adminUsername" aria-describedby="identifiantHelp">
        </div>
        <div class="mb-3">
            <label for="adminInputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required id="adminInputPassword">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/admin/gabarit.php'; ?>