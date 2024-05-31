<?php
require_once 'HelloAssoConnector.php';

if (isset($_SESSION['bearer_token'])) {
    $connector = new HelloAssoConnector($_SESSION['bearer_token'], $organizationSlug);
    if (isset($_GET['payment'])) {
        $url = "https://api.helloasso.com/v5/payments/{$_GET['payment']}/";
    $authorization = "Bearer " . $_SESSION['bearer_token'];
    $data_payment = curlApiGet($url, $authorization);
    // $data_payment = $connector->fetchData();
    //          var_dump($data_payment);
    // die();
    } else {
        $data_forms = $connector->fetchData();
    //     var_dump($data_forms);
    // die();
    }    

} else {
    die("Erreur: Jeton d'authentification manquant.");
}

// include 'orders.php';
// if (isset($_GET['payment'])) {
//     $url = "https://api.helloasso.com/v5/payments/{$_GET['payment']}/";
//     $authorization = "Bearer " . $_SESSION['bearer_token'];
//     $data_payment = curlApiGet($url, $authorization);
// } else {
//     if(!isset($_GET['formType'])) {
//         $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/payments/search?pageSize=50&sortOrder=Desc&sortField=Date";
//     } else {
//         $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/payments/search?pageSize=50&formType={$_GET['formType']}&sortOrder=Desc&sortField=Date";
//     }
    
//     $authorization = "Bearer " . $_SESSION['bearer_token'];
//     $data_forms = curlApiGet($url, $authorization);

// }