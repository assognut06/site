<?php ob_start() ?>
<?php
if (isset($_GET['payment'])) {
    include_once('includes/payments/payment.php');
} else {
    include_once('includes/payments/payments.php');
} ?>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>