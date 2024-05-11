<!--Contenu Actualités-->
<div class="pt-0">
    <div class="mx-3">
        <h2 class="my-5 text-success text-center">Actualités de Gnut 06</h2>
        <div class="border border-success mb-5 mx-5 "></div>
        <div class="row row-cols-12 row-cols-xxl-5 pt-5 g-12 g-md-5 align-items-start">
            <?php
            if (isset($data_forms->data)) {
                // Filtrer les données pour ne garder que les éléments avec endDate supérieur à la date actuelle
                $now = new DateTime(); // Date et heure actuelles
                $data_forms->data = array_filter($data_forms->data, function ($item) use ($now) {
                    if (isset($item->endDate)) {
                        $endDate = new DateTime(htmlspecialchars($item->endDate));
                        return $endDate > $now; // Retourne true si endDate est dans le futur
                    }
                    return false;
                });
                usort($data_forms->data, function ($a, $b) {
                    if (isset($a->endDate) && isset($b->endDate)) {

                        $date_a = new DateTime(htmlspecialchars($a->endDate));
                        $date_b = new DateTime(htmlspecialchars($b->endDate));
                        return $date_a <=> $date_b;
                    }
                });
            }

            $i = 0;
            if (isset($data_forms->data)) {
                foreach ($data_forms->data as $item) {
                    if ($item->formType == "Event") { ?>
                        <div class="col d-flex justify-content-around my-3">
                            <div class="card shadow-lg" style="width: 21rem;">
                                <?php
                                $dir = 'images/news/'; // Spécifiez le chemin vers votre répertoire contenant les images
                                $images = glob($dir . '/*.jpeg'); // Récupère tous les fichiers JPEG du répertoire

                                if (!empty($images)) {
                                    $randomImage = $images[array_rand($images)]; // Sélectionne aléatoirement une image parmi celles trouvées

                                    // Utilisez $randomImage pour afficher l'image ou effectuer d'autres opérations
                                    // echo '<img src="' . $randomImage . '" alt="Image aléatoire">';
                                } else {
                                    echo 'Aucune image trouvée dans le répertoire.';
                                }

                                ?>
                                <img src="<?= $randomImage ?>" class="card-img-top" alt="Evénements Gnut 06">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?= htmlspecialchars($item->title) ?></h5>
                                    <p class="card-text">
                                    <div class="alert alert-danger text-center mx-5 shadow-lg rounded-pill" role="alert">
                                        <?php
                                        $endDate = new DateTime(htmlspecialchars($item->endDate));
                                        $now = new DateTime(); // Date et heure actuelles
                                        if ($endDate > $now) {
                                            $interval = $now->diff($endDate); // Calcule l'intervalle de temps entre maintenant et endDate
                                            if ($interval->days === 0) {
                                                echo "<strong>Expire dans quelques heures</strong>";
                                            } else {
                                                echo '<strong>Expire dans ' . $interval->days . " jours.</strong>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?= substr(htmlspecialchars($item->description), 0, 200) ?>...<br>
                                    <a href="<?= '?page=' . htmlspecialchars($_GET['page']) . '&formType=' . htmlspecialchars($item->formType) . '&slug=' . htmlspecialchars($item->formSlug) ?>">
                                    > En savoir plus...
                                </a>
                                </p>
                                    <div class="text-center">
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_<?= $i ?>">Réserver</button>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade modal-lg" id="modal_<?= $i ?>" tabindex="-1" aria-labelledby="ModalLabel_<?= $i ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="ModalLabel_<?= $i ?>"><?= htmlspecialchars($item->title) ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe id="haWidget" allowtransparency="true" scrolling="auto" src="<?= htmlspecialchars($item->widgetFullUrl) ?>" style="width: 100%; height: 750px; border: none;"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="d-flex align-items-center">
                                        <iframe id="haWidget" allowtransparency="true" src="<?= htmlspecialchars($item->widgetButtonUrl) ?>" style="width: 100%; height: 70px; border: none;"></iframe>
                                    </div> -->
                                </div>
                            </div>
                        </div>
            <?php
                        $i++;
                    }
                }
            } else {
                echo "No data available.";
            }
            ?>
        </div>
    </div>

</div>