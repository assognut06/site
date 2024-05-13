<?php
require_once(__DIR__ . '/../../../../includes/functions.php');
require_once(__DIR__ . '/../../../../config/constants.php');
require_once __DIR__ . '/../../../../includes/tokenHelloasso.php';
require_once __DIR__ . '/../../../../includes/orders.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril Fatface">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Association Gnut 06 est une association régie par la loi 1901 domiciliée à Nice, dédiée à l'inclusion des personnes en situation de handicap grâce aux technologies innovantes. Nous utilisons la réalité virtuelle, la réalité augmentée et la réalité mixte pour offrir des expériences concrètes et enrichissantes aux personnes en situation de handicap, favorisant ainsi leur intégration sociale et leur épanouissement. Rejoignez-nous pour construire une société inclusive !">
    <meta name="keywords" content="association, Gnut 06, inclusion, handicap, réalité virtuelle, réalité augmentée, réalité mixte, technologies innovantes, visite hôpital, stages, société inclusive">
    <meta name="author" content="Association Gnut 06">
    <link rel="stylesheet" href="css/style.css" />
    <title>Association Gnut 06 - Des Mondes Virtuels, des Liens Réels : L'Inclusion à Portée de Main</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container pt-0">
        <div class="mx-3">
            <h2 class="my-5 text-success text-center">Détails du billet numéro : <?= $_GET['order'] ?></h2>
            <div class="border border-success mb-5 "></div>
            <div class="row justify-content-center">
                <div class="col">
                    <p>
                        <?php if ($data_forms !== null) {
                            if (isset($data_forms->payer->company)) { ?>
                                Socété : <?= htmlspecialchars($data_forms->payer->company) ?><br>
                            <?php } ?>
                            Nom : <?= htmlspecialchars($data_forms->payer->lastName) ?><br>
                            Prénom : <?= $data_forms->payer->firstName ?><br>
                            Email : <?= $data_forms->payer->email ?><br>
                            <?php if (isset($data_forms->payer->address)) { ?>
                                Adresse : <?= htmlspecialchars($data_forms->payer->address) ?><br>
                                Code postal : <?= htmlspecialchars($data_forms->payer->zipCode) ?><br>
                                Villle : <?= htmlspecialchars($data_forms->payer->city) ?>
                            <?php } ?>
                    </p>
                </div>
                <div class="col">
                    <p>
                        <h5><?= $data_forms->order->formName ?></h5>
                        <div class="border border-success mb-5"></div>
                        <p><?= isset($data_forms->tierDescription) ? nl2br(htmlspecialchars($data_forms->tierDescription )) : '' ?></p>
                        <?= isset($data_forms->payments[0]->id) ? '<br>Référence payment : ' . $data_forms->payments[0]->id : '' ?><br>
                        Date : <?= date_en_francais($data_forms->order->date) ?>
                        <br>
                        <div class="border border-success mb-5"></div>
                        Type : <?= $data_forms->order->formType ?><br>
                        <?= isset($data_forms->payments) ? 'Mode de paiement : '. $data_forms->payments[0]->paymentMeans .'</br>' : '' ?>
                        Montant : <?= formattedPrice($data_forms->amount) ?><br>
                        <?= isset($data_forms->ticketUrl) ? '<a class="btn btn-warning mt-3" href="'. $data_forms->ticketUrl .'" target="_blank">Ticket</a>' : '' ?>
                        <?= isset($data_forms->membershipCardUrl) ? '<a class="btn btn-warning mt-3" href="'. $data_forms->membershipCardUrl .'" target="_blank">Carte d\'adhérant</a>' : '' ?>
                    
                    </p>
                </div>
                <?php if (isset($data_forms->payer->company) && isset($data_forms->payer->address)) { ?>
                    <div class="col">
                        <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=<?= GNUT06MAPAPI ?>
                        &q=<?= str_replace(' ', '+', htmlspecialchars($data_forms->payer->company)) ?>,<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($data_forms->payer->address))) . "+" . $data_forms->payer->zipCode . "+" . str_replace(' ', '+', htmlspecialchars($data_forms->payer->city)) ?>,<?= $data_forms->payer->country ?>">
                        </iframe>
                    </div>
                    <?php } else {
                                if (isset($data_forms->payer->address)) { ?>
                        <div class="col">
                            <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=<?= GNUT06MAPAPI ?>
                    &q=<?= str_replace(' ', '+', htmlspecialchars($data_forms->payer->lastName)) ?>+<?= str_replace(' ', '+', htmlspecialchars($data_forms->payer->firstName)) ?>,<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($data_forms->payer->address))) . "+" . $data_forms->payer->zipCode . "+" . str_replace(' ', '+', htmlspecialchars($data_forms->payer->city)) ?>,<?= $data_forms->payer->country ?>">
                            </iframe>
                        </div>
            <?php }
                            }
                        } else {
                            echo "<p>Aucun paiement</p>";
                        } ?>
            <!-- <div class="col-12 text-center mt-5">
            <?php
            // Vérifier si l'en-tête 'Referer' est présent
            if (!empty($_SERVER['HTTP_REFERER'])) {
                // Créer un lien de retour basé sur l'URL précédemment visitée
                echo '<a class="btn btn-success" href="' . htmlspecialchars($_SERVER['HTTP_REFERER'], ENT_QUOTES, 'UTF-8') . '">Retour</a>';
            } else {
                // Alternative si l'en-tête 'Referer' n'est pas disponible
                echo '<p>Impossible de retourner à la page précédente.</p>';
            }
            ?>
        </div> -->
            </div>
        </div>
    </div>
</body>