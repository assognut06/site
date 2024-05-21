<?php
if (isset($_GET['payment'])) {
    $url = "https://api.helloasso.com/v5/payments/{$_GET['payment']}/";
    $authorization = "Bearer " . $_SESSION['bearer_token'];
    $data_payment = curlApiGet($url, $authorization);
    // $curl = curl_init();

    // require('sslVerifypeer.php');
    // curl_setopt_array($curl, [

    //     CURLOPT_URL => $url,
    //     CURLOPT_RETURNTRANSFER => true,
    //     // CURLOPT_SSL_VERIFYPEER => 0,
    //     // CURLOPT_SSL_VERIFYHOST => 0,
    //     CURLOPT_HTTPGET => true,
    //     CURLOPT_HTTPHEADER => [
    //         // 'Accept: application/json',
    //         // 'Authorization: JWT_TOKEN', // Seems to be a placeholder, replace with actual token if necessary
    //         "Authorization: $authorization"
    //     ],
    // ]);

    // $response = curl_exec($curl);
    // $err = curl_error($curl);

    // curl_close($curl);
    // $data_payment = json_decode($response);
    // if ($err) {
    //     echo "cURL Error #:" . $err;
    // }
} else {
    if(!isset($_GET['formType'])) {
        $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/payments/search?pageSize=50&sortOrder=Desc&sortField=Date";
    } else {
        $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/payments/search?pageSize=50&formType={$_GET['formType']}&sortOrder=Desc&sortField=Date";
    }
    
    $authorization = "Bearer " . $_SESSION['bearer_token'];
    $data_forms = curlApiGet($url, $authorization);

}