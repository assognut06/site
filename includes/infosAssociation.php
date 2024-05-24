<?php

$url = "https://api.helloasso.com/v5/organizations/" . SLUGASSO;
$authorization = "Bearer " . $_SESSION['bearer_token'];

// Convertir le JSON en objet
$data = curlApiGet($url, $authorization);

// $organizationSlug = $data_asso->organizationSlug;
