<div class="container pt-0">
    <div class="mx-3">
        <h2 class="my-5 text-success text-center">Détails du billet numéro : <?= $_GET['order'] ?></h2>
        <div class="border border-success mb-5 mx-5 "></div>
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
                    N° de commande : <?= $data_forms->order->id ?><br>
                    Date : <?= date_en_francais($data_forms->date) ?>
                    Type : <?= $data_forms->order->formType ?><br>
                    Montant : <?= formattedPrice($data_forms->amount) ?><br>
                    Mode de paiement : <?= $data_forms->paymentMeans ?><br>
                    <a href="<?= $data_forms->paymentReceiptUrl ?>" target="_blank">Reçu de paiement</a>

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
        <div class="col-12 text-center mt-5">
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
        </div>
        </div>
    </div>
</div>