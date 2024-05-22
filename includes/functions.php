<?php
//fonction d'unicité
function is_already_in_use($field, $value, $table)
{
	$bdd = getbdd();
	$req = $bdd->prepare('SELECT id FROM ' . $table . ' WHERE ' . $field . ' =?');
	$req->execute(array($value));
	$count = $req->rowCount();
	return $count;
}
function message_flash($message, $type = 'success')
{
	$_SESSION['message_flash'] = '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">'
		. $message .
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
function activ_mail($name, $speudo, $email)
{
	$token = sha1($name . $speudo . $email);
	//@ permet de masquer le message d'erreur
	if (@mail($email, 'Activation du compte', 'Activation du compte, veuillez cliquer sur : ' . WEBSITE_URL . '?page=activation&speudo=' . $speudo . '&token=' . $token)) {
		message_flash("Un mail d'activation vous a été envoyé", "info");
	} else {
		message_flash("Probléme d'envoi du mail d'activation", "danger");
	}
}
function forget_mdp_email($name, $speudo, $email)
{
	$token = sha1($name . $speudo . $email);
	//@ permet de masquer le message d'erreur
	if (@mail($email, 'Réinitialisation du mot de passe', 'Réinitialisation du mot de passe, veuillez cliquer sur : ' . WEBSITE_URL . '?page=reset_mdp&speudo=' . $speudo . '&token=' . $token)) {
		message_flash("Un mail d'activation vous a été envoyé", "info");
	} else {
		message_flash("Probléme d'envoi du mail de réinitialisation", "danger");
	}
}
//test si les champs ne sont pas vide
function not_empty($tableau)
{
	foreach ($tableau as $champ) {
		if (empty($_POST[$champ]) || trim($_POST[$champ]) == "") {
			return false;
			# code.
		}
	}
	return true;
}
//date en français
function date_en_francais($date_json)
{
	$jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
	$mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	// Définir la langue française pour les fonctions de date et d'heure.
	setlocale(LC_TIME, 'fr_FR.UTF-8');

	// Créer un objet DateTime à partir de la date de $data_actu->startDatee.
	$date = new DateTime(htmlspecialchars($date_json));

	// Extraire les informations de date.
	$day = $date->format('N');
	$dayOfWeek = $jours[$day - 1];
	$dayOfMonth = $date->format('j');
	$month = $date->format('n');
	$monthName = $mois[$month - 1];
	$year = $date->format('Y');

	// Afficher la date formatée.
	echo "le " . $dayOfWeek . ' ' . $dayOfMonth . ' ' . $monthName . ' ' . $year . ' à ' . $date->format('H:i:s') . '</br>';
}
function date_fr_j_h($orderDate)
{

	// Créer un objet DateTime représentant la date et l'heure actuelles
	$date = new DateTime(htmlspecialchars($orderDate));

	// Afficher la date au format jj/mm/yy h:m:s
	echo $date->format('d/m/y H:i:s');
}
function formattedPrice($price)
{
	// Convertir les centimes en euros avec une séparation pour les décimales
	$priceInEuros = $price / 100;

	// Formater le nombre pour séparer les milliers et retirer le séparateur décimal
	$formattedPrice = number_format($priceInEuros, 2, ',', ' ');

	// Remplacer la virgule par l'euro et ajuster pour le format voulu
	// Ici, on prend la partie entière, on ajoute '€' et on append les deux derniers chiffres
	$formattedPrice = substr($formattedPrice, 0, -3) . '€' . substr($formattedPrice, -2);

	// Afficher le prix formaté
	echo $formattedPrice;  // Output: 1 300€50
}
function curlApiGet($url, $authorization)
{
    $curl = curl_init();

    require('sslVerifypeer.php');
    curl_setopt_array($curl, [

        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPGET => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: $authorization"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    if ($err) {
		exit;
        echo "cURL Error #:" . $err;
    }
	else {
		return json_decode($response);
	}
}

function fetchToken($urlToken, $params) {
    $curl = curl_init();
    require('sslVerifypeer.php'); // Dépend de votre configuration sslVerifypeer
    
    curl_setopt($curl, CURLOPT_URL, $urlToken);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

    $responseToken = curl_exec($curl);
    curl_close($curl);
    
    return json_decode($responseToken, true);
}

function updateTokens($data) {
    if (isset($data['access_token'])) {
        $_SESSION['bearer_token'] = $data['access_token'];
        $now = new DateTime();
        
        $expirationDate = clone $now;
        // Ajouter l'intervalle à la date actuelle
        $expirationDate->add(new DateInterval('PT' . $data['expires_in'] . 'S'));
        // Mise à jour de la session pour les tokens
        $_SESSION['expiration_token'] = $expirationDate;
        
        $refreshTokenDate = clone $now;
        $refreshTokenDate->add(new DateInterval('P1M'));
        $_SESSION['expirationRefreshToken'] = $refreshTokenDate;
        
        if (isset($data['refresh_token'])) {
            $_SESSION['refresh_token'] = $data['refresh_token'];
        }
    } else {
        echo 'Erreur lors de la récupération du jeton Bearer JWT';
    }
}