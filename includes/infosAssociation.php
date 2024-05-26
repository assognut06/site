<?php
require_once 'HelloAssoConnector.php';
if (isset($_SESSION['bearer_token'])) {
    $connector = new HelloAssoConnector($_SESSION['bearer_token'], $organizationSlug);
    $data = $connector->fetchData();
    // Vous pouvez maintenant utiliser $data_forms pour traiter les données récupérées
    // var_dump($data);
    // die();
} else {
    die("Erreur: Jeton d'authentification manquant.");
}
