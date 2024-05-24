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

$organizationSlug = SLUGASSO;
