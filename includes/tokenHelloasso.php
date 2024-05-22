<?php
if (!isset($_SESSION['bearer_token']) || !isset($_SESSION['expiration_token']) || (new DateTime() > $_SESSION['expiration_token']) || (new DateTime() > $_SESSION['expirationRefreshToken'])) {
    if (new DateTime() > $_SESSION['expirationRefreshToken']) {
        unset($_SESSION['refresh_token']);
    }
    $params = array(
        'grant_type' => isset($_SESSION['refresh_token']) ? 'refresh_token' : 'client_credentials',
        'client_id' => APICLIENTID,
    );

    if (isset($_SESSION['refresh_token'])) {
        $params['refresh_token'] = $_SESSION['refresh_token'];
    } else {
        $params['client_secret'] = APICLIENTSECRET;
    }
    // URL de l'endpoint pour récupérer le jeton
    $urlToken = 'https://api.helloasso.com/oauth2/token';

    $data = fetchToken($urlToken, $params);
    updateTokens($data);

    if (new DateTime() > $_SESSION['expiration_token']) {
        die('Le token a expiré et la tentative de rafraîchissement a échoué.');
    }
}

$url = "https://api.helloasso.com/v5/organizations/" . SLUGASSO;
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
// Convertir le JSON en objet
$data_asso = json_decode($response);
if ($err) {
    echo $authorization;
    echo "cURL Error #:" . $err;
} else {
    $organizationSlug = $data_asso->organizationSlug;
    // var_dump($data_asso);
}
