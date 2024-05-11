<?php ob_start() ?>
<?php
if (isset($_GET['slug']) && isset($_GET['formType'])) { ?>
    <?php include_once('includes/news/actu.php'); ?>
<?php } else { ?>
    <?php include_once('includes/news/listes.php'); ?>
<?php } ?>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>