<?php

// URL de l'endpoint pour récupérer le jeton
$urlToken = 'https://api.helloasso.com/oauth2/token';

if (!isset($_SESSION['bearer_token']) || !isset($_SESSION['expiration_token'])) {

    // Paramètres de la requête
    $params = array(
        'grant_type' => 'client_credentials',
        'client_id' => APICLIENTID,
        'client_secret' => APICLIENTSECRET
    );

    // Initialisation de la requête
    $curl = curl_init();
    require('sslVerifypeer.php');
    curl_setopt($curl, CURLOPT_URL, $urlToken);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

    // Exécution de la requête
    $responseToken = curl_exec($curl);

    // Analyse de la réponse
    $data = json_decode($responseToken, true);

    // Récupération du jeton d'accès
    if (isset($data['access_token'])) {
        $_SESSION['bearer_token'] = $data['access_token'];
        $now = new DateTime();
        // Cloner l'objet DateTime pour ne pas modifier l'original
        $expirationDate = clone $now;

        // Ajouter l'intervalle à la date actuelle
        $expirationDate->add(new DateInterval('PT' . $data['expires_in'] . 'S'));
        $expirationRefreshToken = clone $now;
        $_SESSION['expirationRefreshToken'] = $expirationRefreshToken->add(new DateInterval('P1M'));
        $_SESSION['expiration_token'] = $expirationDate->add(new DateInterval('PT' . $data['expires_in'] . 'S'));
        $_SESSION['refresh_token'] = $data['refresh_token'];
    } else {
        echo 'Erreur lors de la récupération du jeton Bearer JWT';
    }

    // Fermeture de la connexion
    curl_close($curl);
}

if (isset($_SESSION['expiration_token'])) {
    // Obtention de la date et de l'heure actuelles
    $now = new DateTime();
     // Vérifier si la date et l'heure actuelles sont supérieures à la date d'expiration
    if ($now > $_SESSION['expiration_token']) {
        // Ajouter votre logique ici, par exemple : rafraîchir le token, forcer la reconnexion, etc.

        // Paramètres de la requête
        $params = array(
            'grant_type' => 'refresh_token',
            'client_id' => APICLIENTID,
            'refresh_token' => $_SESSION['refresh_token']
        );

        // Initialisation de la requête
        $curl = curl_init();
        require('sslVerifypeer.php');
        curl_setopt($curl, CURLOPT_URL, $urlToken);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

        // Exécution de la requête
        $responseToken = curl_exec($curl);

        // Analyse de la réponse
        $data = json_decode($responseToken, true);

        // Récupération du jeton d'accès
        if (isset($data['access_token'])) {
            $_SESSION['bearer_token'] = $data['access_token'];
            $now = new DateTime();
            // Cloner l'objet DateTime pour ne pas modifier l'original
            $expirationDate = clone $now;
            // Ajouter l'intervalle à la date actuelle
            $expirationDate->add(new DateInterval('PT' . $data['expires_in'] . 'S'));
            $_SESSION['expiration_token'] = $expirationDate->add(new DateInterval('PT' . $data['expires_in'] . 'S'));
            $expirationRefreshToken = clone $now;
            $_SESSION['expirationRefreshToken'] = $expirationRefreshToken->add(new DateInterval('P1M'));
            $_SESSION['refresh_token'] = $data['refresh_token'];
        } else {
            echo 'Erreur lors de la récupération du jeton Bearer JWT';
        }

        // Fermeture de la connexion
        curl_close($curl);
        die('Le token a expiré.');
    } 
} else {
    die('Aucun token d\'expiration n\'a été défini.');
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
