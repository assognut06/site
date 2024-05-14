    <div class="container pt-0">
        <div class="mx-3">
            <h2 class="my-5 text-success text-center">Détails du paiment numéro : <?= $_GET['payment'] ?></h2>
            <div class="border border-success mb-5 mx-5 "></div>
            <div class="row justify-content-center">
                <div class="col">
                    <p>
                        <?php if ($data_payment !== null) {
                            if (isset($data_payment->payer->company)) { ?>
                                Socété : <?= htmlspecialchars($data_payment->payer->company) ?><br>
                            <?php } ?>
                            Nom : <?= htmlspecialchars($data_payment->payer->lastName) ?><br>
                            Prénom : <?= $data_payment->payer->firstName ?><br>
                            Email : <?= $data_payment->payer->email ?><br>
                            <?php if (isset($data_payment->payer->address)) { ?>
                                Adresse : <?= htmlspecialchars($data_payment->payer->address) ?><br>
                                Code postal : <?= htmlspecialchars($data_payment->payer->zipCode) ?><br>
                                Villle : <?= htmlspecialchars($data_payment->payer->city) ?>
                            <?php } ?>
                    </p>
                </div>
                <div class="col">
                    <p>
                        N° de commande : <?= $data_payment->order->id ?><br>
                        Date : <?= date_en_francais($data_payment->date) ?>
                        Type : <?= $data_payment->order->formType ?><br>
                        Montant : <?= formattedPrice($data_payment->amount) ?><br>
                        Mode de paiement : <?= $data_payment->paymentMeans ?><br>
                        <a href="<?= $data_payment->paymentReceiptUrl ?>" target="_blank">Reçu de paiement</a>
                        <?php if (isset($data_payment->fiscalReceiptUrl)) {
                                echo '<br><a href="' . $data_payment->fiscalReceiptUrl . '" target="_blank">Reçu de fiscal</a>';
                            }
                        ?>

                    </p>
                </div>
                <?php if (isset($data_payment->payer->company) && isset($data_payment->payer->address)) { ?>
                    <div class="col">
                        <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=<?= GNUT06MAPAPI ?>
                        &q=<?= str_replace(' ', '+', htmlspecialchars($data_payment->payer->company)) ?>,<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($data_payment->payer->address))) . "+" . $data_payment->payer->zipCode . "+" . str_replace(' ', '+', htmlspecialchars($data_payment->payer->city)) ?>,<?= $data_payment->payer->country ?>">
                        </iframe>
                    </div>
                    <?php } else {
                                if (isset($data_payment->payer->address)) { ?>
                        <div class="col">
                            <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=<?= GNUT06MAPAPI ?>
                        &q=<?= str_replace(' ', '+', htmlspecialchars($data_payment->payer->lastName)) ?>+<?= str_replace(' ', '+', htmlspecialchars($data_payment->payer->firstName)) ?>,<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($data_payment->payer->address))) . "+" . $data_payment->payer->zipCode . "+" . str_replace(' ', '+', htmlspecialchars($data_payment->payer->city)) ?>,<?= $data_payment->payer->country ?>">
                            </iframe>
                        </div>
            <?php }
                            }
                        } else {
                            echo "<p>Aucun paiement</p>";
                        } ?>
            </div>
        </div>
    </div>
