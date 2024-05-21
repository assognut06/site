<?php ob_start() ?>
<!--Contenu Actualité spéciale-->
<?php
if (isset($_GET['slug']) && isset($_GET['formType'])) { ?>
    <div class="container text-center">
        <h2><?= $data_actu->title ?></h2>
        <div>

            <div class="row row-cols-12 row-cols-lg-3">
                <div class="col"></div>
                <div class="col">
                    <div class="alert alert-danger text-center mx-5 shadow-lg rounded-pill" role="alert">
                        <?php
                        $endDate = new DateTime(htmlspecialchars($data_actu->endDate));
                        $now = new DateTime(); // Date et heure actuelles
                        if ($endDate > $now) {
                            $interval = $now->diff($endDate); // Calcule l'intervalle de temps entre maintenant et endDate
                            echo '<strong>Expire dans ' . $interval->days . " jours.</strong>";
                        }
                        $place = array(
                            "address" => $data_actu->place->address,
                            "name" => $data_actu->place->name,
                            "city" => $data_actu->place->city,
                            "zipCode" => $data_actu->place->zipCode,
                            "country" => $data_actu->place->country
                        );
                        ?>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <p><?= nl2br(htmlspecialchars($data_actu->description)) ?></p>
            <!-- <?= var_dump($data_actu); ?> -->
            <div class="row row-cols-12 row-cols-xl-3 g-12 g-xl-3">
                <div class="col d-flex flex-column align-items-center justify-content-center">
                    <h5><?= $place["name"] ?></h5>
                    <div>

                        <p>Adresse : <?= $place["address"] ?><br><?= $place["zipCode"] ?> <?= $place["city"] ?> </p>
                    </div>

                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="alert alert-success text-center mx-5 shadow-lg rounded-pill" role="alert">
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

                        // $place = array(
                        //     "address" => $data_actu->place->address,
                        //     "name" => $data_actu->place->name,
                        //     "city" => $data_actu->place->city,
                        //     "zipCode" => $data_actu->place->zipCode,
                        //     "country" => $data_actu->place->country
                        // );
                        ?>
                    </div>
                </div>
                <div class="col">
                    <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDQEwwzk02B0XRb0GuJm82MGrF9LJmHFRk
                        &q=<?= str_replace(' ', '+', htmlspecialchars($data_actu->place->name)) ?>,<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($data_actu->place->address))) . "+" . $data_actu->place->zipCode . "+" . str_replace(' ', '+', htmlspecialchars($data_actu->place->city)) ?>,<?= $data_actu->place->country ?>">
                    </iframe>
                </div>
            </div>
        </div>
        <!-- <?php
                // Vérifiez d'abord si la propriété tiers existe et qu'elle est non vide
                if (isset($data_actu->tiers) && is_array($data_actu->tiers)) {
                    // Parcourt chaque élément de l'attribut tiers
                    foreach ($data_actu->tiers as $tier) {
                        // Vérifiez si l'attribut label est bien présent
                        if (isset($tier->label)) {
                            echo htmlspecialchars($tier->label) . "<br>"; // Affiche le label
                        } else {
                            echo "Label non défini pour cet élément.<br>";
                        }
                    }
                } else {
                    echo 'Pas de données disponibles pour les tiers.';
                }

                ?> -->
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
        <!-- <?php

                // // Définir les variables à partir du tableau de données
                // echo $data_actu->place->address;
                // $place = array(
                //     "address" => $data_actu->place->address,
                //     "name" => $data_actu->place->name,
                //     "city" => $data_actu->place->city,
                //     "zipCode" => $data_actu->place->zipCode,
                //     "country" => $data_actu->place->country
                // );
                // Définir les variables pour la carte
                $latitude = ""; // Latitude du lieu (à déterminer à partir de l'adresse)
                $longitude = ""; // Longitude du lieu (à déterminer à partir de l'adresse)
                $zoom = 15; // Niveau de zoom

                // Code HTML pour l'iframe
                // Créer le code d'iframe
                $encodedPlaceName = urlencode(htmlspecialchars($data_actu->place->name));
                $iframe_code = '<iframe src="https://www.google.com/maps/embed?pb=' .
                    '!1m18' . // Utilisation de 1m18 pour 3D view avec contrôle de zoom
                    '!1m12' .
                    '!1m3' .
                    '!1d' . $latitude .
                    '!2d' . $longitude .
                    '!3d' . $latitude .
                    '!2m3' .
                    '!1f0' .
                    '!2f0' .
                    '!3f0' .
                    '!3m2' .
                    '!1i1024' .
                    '!2i768' .
                    '!4f13.1' .
                    '!2m1' .
                    '!1s' . $encodedPlaceName .
                    '!5e0' .
                    '!3m2' .
                    '!1sen' .
                    '!2sin' .
                    '!4v1668743652871' .
                    '!5m2' .
                    '!1sen' .
                    '!2sin' .
                    '!3m3' .
                    '!1m2' .
                    '!1d' . $latitude .
                    '!2d' . $longitude .
                    '!13z' . // Définir le zoom à 15
                    '?zoom=15" ' .
                    'width="600" ' .
                    'height="450" ' .
                    'style="border:0;" ' .
                    'allowfullscreen="" ' .
                    'loading="lazy"></iframe>';
                // $iframe_code = '<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d' . $latitude . '!2d' . $longitude . '!3d' . $latitude . '!13z' . $zoom . '!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s' . $place["name"] . '!5e0!3m2!1sen!2sin!4v1668743652871!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

                // Déterminer les coordonnées GPS à partir de l'adresse
                // if (!empty($place["address"])) {
                //     // Utiliser une API de géocodage (par exemple, Google Maps Geocoding API) pour récupérer les coordonnées GPS à partir de l'adresse
                //     // Exemple d'utilisation de Google Maps Geocoding API:
                //     // $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . str_replace(' ', '+', $place["address"]) . "+". $place["zipCode"] ."+" . $place["city"] . "&key=AIzaSyCLUG5D1Odsfx3K4ZBBNcvqQcGn_HdT9x8"; // Remplacez 'YOUR_API_KEY' par votre clé API Google Maps
                //     $url = "https://maps.googleapis.com/maps/api/geocode/json?address=9+Rue+du+pont+vieux+06300+Nice&key=AIzaSyCLUG5D1Odsfx3K4ZBBNcvqQcGn_HdT9x8";
                //     echo $url;
                //     $json_data = file_get_contents($url);
                //     $data = json_decode($json_data);
                //     if ($data->status === "OK") {
                //         echo $data->results[0]->geometry->location->lat . "</br>";
                //     }
                //     var_dump($data);
                //     echo $data->results[0]->geometry->location->lat;
                //     //             if ($data["status"] === "OK") {
                //     $latitude = $data->results[0]->geometry->location->lat;
                //     $longitude = $data->results[0]->geometry->location->lng;
                //     //                 $latitude = $results["geometry"]["location"]["lat"];
                //     //                 echo $latitude ;
                //     // // $longitude = $results["geometry"]["location"]["lng"];
                //     //             }
                // }

                // // Affichage du code iframe
                // if (!empty($latitude) && !empty($longitude)) {
                //     echo $iframe_code;

                //     //         echo '<gmp-map center="43.701595306396484,7.28159761428833" zoom="14" map-id="DEMO_MAP_ID">
                //     //   <gmp-advanced-marker position="43.701595306396484,7.28159761428833" title="My location"></gmp-advanced-marker>
                //     // </gmp-map>';
                // } else {
                //     echo "Impossible de déterminer les coordonnées GPS.Veuillez vérifier l'adresse.";
                // }

                ?> -->
        <!-- <div class="card w-10">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($place["address"]))) . "+" . $place["zipCode"] . "+" . str_replace(' ', '+', htmlspecialchars($place["city"])) ?>&zoom=17&size=400x400&key=AIzaSyDq82jZsa1AKcT9WoFyEmqEa0d5VTybZZ8" alt="Carte statique de Berkeley, CA" />


            <div class="card-body">
                <h5 class="card-title">Adresse</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div> -->
        <!-- <gmp-map center="40.12150192260742,-100.45039367675781" zoom="4" map-id="DEMO_MAP_ID">
            <gmp-advanced-marker position="40.12150192260742,-100.45039367675781" title="My location"></gmp-advanced-marker>
        </gmp-map> -->
        <!-- <div>
            https://maps.googleapis.com/maps/api/staticmap?center=<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($place["address"]))) . "+" . $place["zipCode"] . "+" . str_replace(' ', '+', htmlspecialchars($place["city"])) ?>
        </div>
        <div class="row row-cols-12 row-cols-xxl-2">
            <div class="col">

            </div>
            <div class="col">
                <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?= htmlspecialchars(str_replace(' ', '+', htmlspecialchars($place["address"]))) . "+" . $place["zipCode"] . "+" . str_replace(' ', '+', htmlspecialchars($place["city"])) ?>&zoom=17&size=400x400&key=AIzaSyDq82jZsa1AKcT9WoFyEmqEa0d5VTybZZ8" alt="Carte statique de Berkeley, CA" />
            </div>
        </div> -->



        <!-- https://maps.googleapis.com/maps/api/staticmap?center=Berkeley,CA&zoom=14&size=400x400&key=AIzaSyDq82jZsa1AKcT9WoFyEmqEa0d5VTybZZ8&signature=a5Q9VIZPNRWl-JxL04kNbOtlrXc= -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_tier">Participer</button>
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
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- <?= var_dump($data_actu->tiers[0]->label) ?> -->
    </div>
<?php } else { ?>
    <!--Contenu-->
    <div class="pt-0">
        <div class="mx-3">
            <h2 class="my-5 text-success text-center">Actualités de Gnut 06</h2>
            <div class="border"></div>
            <div class="row row-cols-12 row-cols-xxl-5 pt-5 g-12 g-md-5 align-items-start">
                <?php
                // Assurez-vous que les données sont définies
                // if (isset($data_forms->data)) {
                //     // Filtrer les données pour ne garder que les éléments avec endDate supérieur à la date actuelle
                //     $now = new DateTime(); // Date et heure actuelles
                //     $data_forms->data = array_filter($data_forms->data, function ($item) use ($now) {
                //         if (isset($item->endDate)) {
                //             $endDate = new DateTime(htmlspecialchars($item->endDate));
                //             return $endDate > $now; // Retourne true si endDate est dans le futur
                //         }
                //         return false;
                //     });
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

                // Sort $data_forms->data by $item->endDate in descending order
                // if (isset($data_forms->data)) {


                $i = 0;
                foreach ($data_forms->data as $item) {
                    // $i = 0;
                    // if (isset($data_forms->data)) {
                    //     foreach ($data_forms->data as $item) { 
                ?>
                    <div class="col d-flex justify-content-around my-3">
                        <div class="card shadow-lg" style="width: 21rem;">
                            <?php
                            if (isset($item->banner->publicUrl)) { ?>
                                <img class="imgTop" src="<?= $item->banner->publicUrl ?>" class="card-img-top" alt="Evénements Gnut 06">
                            <?php
                            }
                            ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item->title) ?></h5>
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
                                <?= htmlspecialchars($item->description) ?>
                                </p>
                                <!-- <?= var_dump($item) ?> -->
                                <!-- <div class="d-flex align-items-center">
                                    <iframe id="haWidget" allowtransparency="true" src="<?= htmlspecialchars($item->widgetButtonUrl) ?>" style="width: 100%; height: 70px; border: none;"></iframe>
                                </div> -->
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_<?= $i ?>">Participer</button>
                                <a href="<?= '?page=' . htmlspecialchars($_GET['page']) . '&formType=' . htmlspecialchars($item->formType) . '&slug=' . htmlspecialchars($item->formSlug) ?>" class="btn btn-info">
                                    Info
                                </a>
                                <!-- <?= '?page=' . htmlspecialchars($_GET['page']) . '&formType=' . htmlspecialchars($item->formType) . '&slug=' . htmlspecialchars($item->formSlug) ?> -->
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
                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                    // var_dump($item);
                    // echo "<h2>" . htmlspecialchars($item->title) . "</h2>";
                    // echo "<p>Description: " . htmlspecialchars($item->description) . "</p>";
                    // if (isset($item->startDate)) {
                    //     // Create a DateTime object from the string
                    //     $date = new DateTime(htmlspecialchars($item->startDate));

                    //     echo "<p>Start Date: " . $date->format('d/m/Y') . "</p>";
                    // }
                    // if (isset($item->endDate)) {
                    //     // Create a DateTime object from the string
                    //     $date = new DateTime(htmlspecialchars($item->endDate));

                    //     echo "<p>End Date: " . $date->format('d/m/Y') . "</p>";
                    // }
                    // echo "<p>State: " . htmlspecialchars($item->state) . "</p>";
                    // echo "<p>URL: <a href='" . htmlspecialchars($item->url) . "'>" . htmlspecialchars($item->url) . "</a></p>";
                    // echo "<hr>";
                }
                // } else {
                //     echo "No data available.";
                //     echo $data_forms;
                // }
                ?>
            </div>
        </div>

    </div>
<?php } ?>
<!-- <?= var_dump($data_forms); ?> -->
<!-- <?php

        $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}";
        $authorization = "Bearer " . $_SESSION['bearer_token'];

        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
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
        $data_object = json_decode($response);
        if ($err) {
            echo $authorization;
            echo "cURL Error #:" . $err;
        } else {
            var_dump($data_object);
        }
        $data_object->name;
        ?> -->
<!-- <?php

        // URL de l'endpoint pour récupérer le jeton
        $url = 'https://api.helloasso.com/v5/organizations/gnut-06';

        // Paramètres de la requête
        $paramsForms = array(
            'Authorization' => 'Bearer ' . $_SESSION['bearer_token'],
        );

        // Initialisation de la requête
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, http_build_query($paramsForms));

        // Exécution de la requête
        $responseToken = curl_exec($curl);
        if ($responseToken === false) {
            echo 'Curl error: ' . curl_error($curl);
        };
        // Convertir le JSON en objet
        $data_object = json_decode($responseToken);
        var_dump($data_object);
        // Accédez aux propriétés de l'objet
        // echo $data_object->property1;
        // echo $data_object->property2;

        // Fermeture de la connexion
        curl_close($curl);

        ?> -->

</div>
<!-- <?php

        $url = "https://api.helloasso.com/v5/organizations/gnut-06/forms";
        $authorization = "Bearer " . $_SESSION['bearer_token'];

        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
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
        $data_object = json_decode($response);
        if ($err) {
            echo $authorization;
            echo "cURL Error #:" . $err;
        }
        // else {
        //     var_dump($data_object);
        // }
        // Check if the 'data' key exists
        if (isset($data_object->data)) {
            echo "<h1>Listing Data</h1>";
            foreach ($data_object->data as $item) {
                echo "<h2>" . htmlspecialchars($item->title) . "</h2>";
                echo "<p>Description: " . htmlspecialchars($item->description) . "</p>";
                if (isset($item->startDate)) {
                    // Create a DateTime object from the string
                    $date = new DateTime(htmlspecialchars($item->startDate));

                    echo "<p>Start Date: " . $date->format('d/m/Y') . "</p>";
                }
                if (isset($item->endDate)) {
                    // Create a DateTime object from the string
                    $date = new DateTime(htmlspecialchars($item->endDate));

                    echo "<p>End Date: " . $date->format('d/m/Y') . "</p>";
                }
                echo "<p>State: " . htmlspecialchars($item->state) . "</p>";
                echo "<p>URL: <a href='" . htmlspecialchars($item->url) . "'>" . htmlspecialchars($item->url) . "</a></p>";
                echo "<hr>";
            }
        } else {
            echo "No data available.";
        }
        ?> -->
<!-- <?php
        // Paramètres de la requête
        $paramsForms = array(
            'Authorization' => 'Bearer ' . $_SESSION['bearer_token'],
        );
        $curl = curl_init();
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        // Use GET request
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.helloasso.com/v5/organizations/{$organizationSlug}",
            CURLOPT_RETURNTRANSFER => true,
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($paramsForms));
        $response = curl_exec($curl);
        if ($response === false) {
            echo 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);

        // Convertir le JSON en tableau
        $data_array = json_decode($response);
        var_dump($data_array);

        // Affiche le tableau
        // echo "Tableau <br>";
        // echo "<pre>";
        // print_r($data_array);
        // echo "</pre>";

        ?> -->
<!-- <?php
        if (function_exists('curl_version')) {
            $curl_version = curl_version();
            print_r($curl_version);
        } else {
            echo "cURL is not available\n";
        }
        ?> -->
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>