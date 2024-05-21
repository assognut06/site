<?php
session_start(); // Assurez-vous que la session est démarrée

// Vérifier si la variable de session 'loggedin' est définie
if (isset($_SESSION['loggedin'])) {
    unset($_SESSION['loggedin']); // Supprimer la variable de session 'loggedin'
}

// Pour vérifier si la suppression a été effective
if (!isset($_SESSION['loggedin'])) {
    ob_start();
    header("Location: ?page=admin");
    exit;
} else {
    echo "La session 'loggedin' est toujours présente.";
}

