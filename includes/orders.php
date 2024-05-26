<?php
require_once 'HelloAssoConnector.php';

if (isset($_SESSION['bearer_token'])) {
    $connector = new HelloAssoConnector($_SESSION['bearer_token'], $organizationSlug);
    $data_forms = $connector->fetchData();
    // Vous pouvez maintenant utiliser $data_forms pour traiter les données récupérées
    // var_dump($data_forms);
    // die();
} else {
    die("Erreur: Jeton d'authentification manquant.");
}
?>
