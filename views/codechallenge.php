<?php
$length = 64; // Longueur du code verifier en octets

// Générer le code_verifier aléatoirement
$codeVerifier = bin2hex(random_bytes($length));

// Calculer le code_challenge
$codeChallenge = base64url_encode(hash('sha256', $codeVerifier, true));

echo "Code Verifier: " . $codeVerifier . "<br>";
echo "Code Challenge: " . $codeChallenge;

// Fonction d'encodage Base64URL
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
?>



