<div class="container pt-0">
    <div class="mx-3">
        <h2 class="my-5 text-success text-center"><?= $data_actu->title ?></h2>
        <div class="border border-success mb-5 mx-5 "></div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <p class="fs-4"><?= nl2br(htmlspecialchars($data_actu->description)) ?></p>
            </div>
            <div class="col-12 col-lg-4"></div>
            <div class="col-12 col-lg-4 text-center d-flex flex-column align-self-center mt-3">

            </div>
            <div class="col-12 col-lg-4"></div>
            <div class="col-12 col-lg-4 text-center d-flex flex-column align-self-center">
                <h5><?= htmlspecialchars($data_actu->place->name) ?></h5>
                <div>
                    <p>Adresse : <?= htmlspecialchars($data_actu->place->address) ?><br><?= htmlspecialchars($data_actu->place->zipCode) ?> <?= htmlspecialchars($data_actu->place->city) ?> </p>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-center d-flex flex-column align-self-center">
                <div class="alert alert-danger text-center mx-5 mb-5 mt-2 shadow-lg rounded-pill" role="alert">
                    <?php
                    $endDate = new DateTime(htmlspecialchars($data_actu->endDate));
                    $now = new DateTime(); // Date et heure actuelles
                    if ($endDate > $now) {
                        $interval = $now->diff($endDate); // Calcule l'intervalle de temps entre maintenant et endDate
                        echo '<strong>Expire dans ' . $interval->days . " jours.</strong>";
                    }

                    ?>
                </div>
                <div class="alert alert-success text-center mx-5 mb-5 shadow-lg rounded-pill" role="alert">
                    <?php
                    $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                    $mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

                    // Définir la langue française pour les fonctions de date et d'heure.
                    setlocale(LC_TIME, 'fr_FR.UTF-8');

                    // Créer un objet DateTime à partir de la date de $data_actu->startDatee.
                    $date = new DateTime(htmlspecialchars($data_actu->startDate));

                    // Extraire les informations de date.
                    $day = $date->format('N');
                    $dayOfWeek = $jours[$day - 1];
                    $dayOfMonth = $date->format('j');
                    $month = $date->format('n');
                    $monthName = $mois[$month - 1];
                    $year = $date->format('Y');

                    // Afficher la date formatée.
                    echo "Débute le " . $dayOfWeek . ' ' . $dayOfMonth . ' ' . $monthName . ' ' . $year . ' à ' . $date->format('H\h') . '</br>';
                    // Créer un objet DateTime à partir de la date de $data_actu->startDatee.
                    $dateEnd = new DateTime(htmlspecialchars($data_actu->endDate));

                    // Extraire les informations de date.
                    $day = $dateEnd->format('N');
                    $dayOfWeek = $jours[$day - 1];
                    $dayOfMonth = $dateEnd->format('j');
                    $month = $dateEnd->format('n');
                    $monthName = $mois[$month - 1];
                    $year = $dateEnd->format('Y');

                    // Afficher la date formatée.
                    echo "Fini le " . $dayOfWeek . ' ' . $dayOfMonth . ' ' . $monthName . ' ' . $year . ' à ' . $dateEnd->format('H\h');
                    ?>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-center d-flex flex-column align-self-center mt-3">
            <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=<?= GNUT06MAPAPI?>
                        &q=<?= str_replace(' ', '+', htmlspecialchars($data_actu->place->name)) ?>,<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($data_actu->place->address))) . "+" . $data_actu->place->zipCode . "+" . str_replace(' ', '+', htmlspecialchars($data_actu->place->city)) ?>,<?= $data_actu->place->country ?>">
                    </iframe>
                <!-- <img class="img-fluid rounded-4 shadow-lg" src="https://maps.googleapis.com/maps/api/staticmap?center=<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($data_actu->place->address))) . "+" . $data_actu->place->zipCode . "+" . str_replace(' ', '+', htmlspecialchars($data_actu->place->city)) ?>,<?= $data_actu->place->country ?>&zoom=17&size=400x400&key=<?= YOURAPIKEY ?>" alt="<?= htmlspecialchars($data_actu->place->name) ?>" /> -->
            </div>
            <div class="col-12">
                <table class="table table-success table-striped mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Formule</th>
                            <th scope="col">Description</th>
                            <th scope="col">Tarif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Vérifiez d'abord si la propriété tiers existe et qu'elle est non vide
                        if (isset($data_actu->tiers) && is_array($data_actu->tiers)) {
                            // Parcourt chaque élément de l'attribut tiers
                            foreach ($data_actu->tiers as $tier) {
                                if (isset($tier->label)) {
                        ?>
                                    <tr>
                                        <th scope="row"><?= htmlspecialchars($tier->label) ?></th>
                                        <td><?= htmlspecialchars($tier->description) ?></td>
                                        <td><?= number_format($tier->price / 100, 2, ',', ' ') . '€'; ?></td>
                                    </tr>
                        <?php
                                } else {
                                    echo "Label non défini pour cet élément.<br>";
                                }
                            }
                        } ?>
                    </tbody>

                </table>
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_tier">Réservé</button>
                <!-- Modal -->
                <div class="modal fade modal-lg" id="modal_tier" tabindex="-1" aria-labelledby="ModalLabel_tier" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalLabel_tier"><?= htmlspecialchars($data_actu->title) ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <iframe id="haWidget" allowtransparency="true" scrolling="auto" src="<?= htmlspecialchars($data_actu->widgetFullUrl) ?>" style="width: 100%; height: 750px; border: none;"></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>