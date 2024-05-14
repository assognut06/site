<?php
require_once 'includes/tokenHelloasso.php';
if (isset($_GET['item']) && $_GET['item'] === 'orders') {
    require_once 'includes/orders.php';
}
if (isset($_GET['item']) && $_GET['item'] === 'payments') {
    require_once 'includes/payments.php';
}

require_once 'views/admin/admin.view.php';