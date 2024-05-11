<?php
require_once 'includes/functions.php';
require_once("config/constants.php");
if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_GET['page']) && is_file('controllers/' . $_GET['page'] . '.controller.php')) {
    // controllers/accueil.php
    require_once 'controllers/' . $_GET['page'] . '.controller.php';
} else {

    require_once 'controllers/index.controller.php';
}
