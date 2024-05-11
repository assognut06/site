<?php ob_start() ?>
<?php
if (isset($_GET['order'])) {
    include_once('includes/orders/order.php');
} else {
    include_once('includes/orders/orders.php');
} ?>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>