<!--Contenu Orders-->
<?php
if(isset($data_forms->pagination)){
    // Récupération des données de pagination
$pageSize = $data_forms->pagination->pageSize;
$totalCount = $data_forms->pagination->totalCount;
$pageIndex = $data_forms->pagination->pageIndex;
$totalPages = $data_forms->pagination->totalPages;
$continuationToken = $data_forms->pagination->continuationToken;

// Calcul des liens précédent et suivant
$prevPage = max(1, $pageIndex - 1);
$nextPage = min($totalPages, $pageIndex + 1);}

?>
<div class="pt-0">
    <div class="mx-3">
        <h2 class="my-5 text-success text-center"><?= isset($_GET['formSlug']) ? $data_forms->data[0]->order->formName : "Les billets de Gnut 06" ?></h2>
        <div class="border border-success mb-5 mx-5"></div>
        <div class="row align-items-start mx-auto">
            <div class="col-12">
                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Réf order</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Liste</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Paiement</th>
                            <th class="text-end" scope="col">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $total_payment = 0;
                        if (isset($data_forms->data)) {
                            foreach ($data_forms->data as $item) {
                                if ($item->state == "Processed") {
                                    require 'views/admin/includes/orders/_partials/tableau.php';
                                    $total_payment += $item->amount;
                                    $i++;
                                }
                            }
                        } else {
                            echo "No data available.";
                        }
                        ?>
                        <tr>
                            <td class="text-end" cope="row" colspan="10"><strong class="text-success">Soit <?= $i ?> billets sur <?= $totalCount ?> pour un Total</strong> : <?php formattedPrice($total_payment); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 pagination-container mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item <?php echo $prevPage == $pageIndex ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?= $_GET['page'] ?>&item=<?= $_GET['item'] ?>&pageIndex=<?php echo $prevPage; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo $i == $pageIndex ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?= $_GET['page'] ?>&item=<?= $_GET['item'] ?>&pageIndex=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?php echo $nextPage == $pageIndex ? 'disabled' : ''; ?>">
                            <a class="page-link" href=",page=<?= $_GET['page'] ?>&pageIndex=<?php echo $nextPage; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
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
                <!-- <?php
                echo '<br>'; 
                var_dump($_SESSION['expiration_token']) ;
                echo '<br>';
                var_dump(new DateTime());
                if(new DateTime() > $_SESSION['expiration_token']) {
                    echo '<br>ok';
                }
                ?> -->
            </div>
        </div>
    </div>

</div>