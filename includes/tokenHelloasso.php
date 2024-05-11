<?php

// URL de l'endpoint pour récupérer le jeton
$urlToken = 'https://api.helloasso.com/oauth2/token';

// Paramètres de la requête
$params = array(
    'grant_type' => 'client_credentials',
    'client_id' => APICLIENTID,
    'client_secret' => APICLIENTSECRET
);

// Initialisation de la requête
$curl = curl_init();
require('sslVerifypeer.php');
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
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
    $bearer_token = $data['access_token'];
    // Affichage du jeton Bearer JWT
    // echo 'Bearer JWT : ' . $bearer_token;
} else {
    echo 'Erreur lors de la récupération du jeton Bearer JWT';
}

// Fermeture de la connexion
curl_close($curl);

    $url = "https://api.helloasso.com/v5/organizations/". SLUGASSO;
        $authorization = "Bearer " . $bearer_token;

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