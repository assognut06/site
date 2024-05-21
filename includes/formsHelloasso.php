<?php
if (isset($_GET['slug']) && isset($_GET['formType'])) {
    $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/forms/{$_GET['formType']}/{$_GET['slug']}/public";
    $authorization = "Bearer " . $_SESSION['bearer_token'];

    $curl = curl_init();

    require('sslVerifypeer.php');
    curl_setopt_array($curl, [

        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_SSL_VERIFYPEER => 0,
        // CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTPGET => true,
        CURLOPT_HTTPHEADER => [
            // 'Accept: application/json',
            // 'Authorization: JWT_TOKEN', // Seems to be a placeholder, replace with actual token if necessary
            "Authorization: $authorization"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $data_actu = json_decode($response);
    if ($err) {
        echo "cURL Error #:" . $err;
    }
} else {
    $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/forms";
    $authorization = "Bearer " . $_SESSION['bearer_token'];

    $curl = curl_init();

    require('sslVerifypeer.php');
    curl_setopt_array($curl, [

        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_SSL_VERIFYPEER => 0,
        // CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTPGET => true,
        CURLOPT_HTTPHEADER => [
            // 'Accept: application/json',
            // 'Authorization: JWT_TOKEN', // Seems to be a placeholder, replace with actual token if necessary
            "Authorization: $authorization"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $data_forms = json_decode($response);
    if ($err) {
        echo "cURL Error #:" . $err;
    }
}
