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
                            Nom : <?php
                                    echo htmlspecialchars(
                                        isset($data_forms->user->lastName) && !empty($data_forms->user->lastName)
                                            ? $data_forms->user->lastName
                                            : (isset($data_forms->payer->lastName) ? $data_forms->payer->lastName : '')
                                    );
                                    ?><br>
                            Prénom : <?php
                                        echo htmlspecialchars(
                                            isset($data_forms->user->firstName) && !empty($data_forms->user->firstName)
                                                ? $data_forms->user->firstName
                                                : (isset($data_forms->payer->firstName) ? $data_forms->payer->firstName : '')
                                        );
                                        ?><br>
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
                    <p><?= isset($data_forms->tierDescription) ? nl2br(htmlspecialchars($data_forms->tierDescription)) : '' ?></p>
                    <?= isset($data_forms->payments[0]->id) ? '<br>Référence payment : ' . $data_forms->payments[0]->id : '' ?><br>
                    Date : <?= date_en_francais($data_forms->order->date) ?>
                    <br>
                    <div class="border border-success mb-5"></div>
                    Type : <?= $data_forms->order->formType ?><br>
                    <?= isset($data_forms->payments) ? 'Mode de paiement : ' . $data_forms->payments[0]->paymentMeans . '</br>' : '' ?>
                    Montant : <?= formattedPrice($data_forms->amount) ?><br>
                    <?= isset($data_forms->ticketUrl) ? '<a class="btn btn-warning mt-3" href="' . $data_forms->ticketUrl . '" target="_blank">Ticket</a>' : '' ?>
                    <?= isset($data_forms->membershipCardUrl) ? '<a class="btn btn-warning mt-3" href="' . $data_forms->membershipCardUrl . '" target="_blank">Carte d\'adhérant</a>' : '' ?>

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
                            echo "<p>Aucun billet</p>";
                        } ?>
            </div>
        </div>