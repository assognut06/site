<!--Contenu Orders-->
<?php
// Récupération des données de pagination
$pageSize = $data_forms->pagination->pageSize;
$totalCount = $data_forms->pagination->totalCount;
$pageIndex = $data_forms->pagination->pageIndex;
$totalPages = $data_forms->pagination->totalPages;
$continuationToken = $data_forms->pagination->continuationToken;

// Calcul des liens précédent et suivant
$prevPage = max(1, $pageIndex - 1);
$nextPage = min($totalPages, $pageIndex + 1);
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
                        ?>

                                    <tr>
                                        <th scope="row">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modal_<?= htmlspecialchars($item->id) ?>">
                                                <?= htmlspecialchars($item->id) ?>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade  modal-xl" id="Modal_<?= htmlspecialchars($item->id) ?>" tabindex="-1" aria-labelledby="Modal_<?= htmlspecialchars($item->id) ?>Label" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="Modal_<?= htmlspecialchars($item->id) ?>Label">Détails du billet numéro : <?= htmlspecialchars($item->id) ?></h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <?php 
                                                            $_GET['order'] = htmlspecialchars($item->id);
                                                            include "includes/orders.php";
                                                            include 'views/admin/includes/orders/order.php' ?>
                                                            <!-- <iframe src="views/admin/includes/orders/order.php?order=<?= htmlspecialchars($item->id) ?>" frameborder="0" width="100%" height="700px"></iframe> -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <td><?= htmlspecialchars($item->payer->lastName) ?></td>
                                        <td><?= htmlspecialchars($item->payer->firstName) ?></td>
                                        <td><?= htmlspecialchars($item->payer->email) ?></td>
                                        <?= isset($item->customFields[0]->answer) ? '<td>' . htmlspecialchars($item->customFields[0]->answer) . '</td>' : '<td>Aucun</td>' ?>
                                        <td><a href="?page=<?= $_GET['page'] ?>&item=<?= $_GET['item'] ?>&formType=<?= $item->order->formType ?>&formSlug=<?= $item->order->formSlug ?>"><i class="bi bi-browser-edge"></i></a></td>
                                        <td><?= htmlspecialchars($item->order->formType) ?></td>
                                        <td><?php date_fr_j_h($item->order->date) ?></td>
                                        <td><?php if (isset($item->payments[0]->id)) { ?>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modal_payment_<?= htmlspecialchars($item->payments[0]->id) ?>">
                                                    <?= htmlspecialchars($item->payments[0]->id) ?>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade  modal-xl" id="Modal_payment_<?= htmlspecialchars($item->payments[0]->id) ?>" tabindex="-1" aria-labelledby="Modal_payment_<?= htmlspecialchars($item->payments[0]->id) ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="Modal_payment_<?= htmlspecialchars($item->payments[0]->id) ?>Label">Détails du paiement numéro : <?= htmlspecialchars($item->payments[0]->id) ?></h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <?php 
                                                            $_GET['payment'] = htmlspecialchars($item->payments[0]->id);
                                                            include "includes/payments.php";
                                                            include 'views/admin/includes/payments/payment.php' ?>
                                                                <!-- <iframe src="views/admin/includes/payments/payment.php?payment=<?= htmlspecialchars($item->payments[0]->id) ?>" frameborder="0" width="100%" height="730px"></iframe> -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { echo 'Gratuit' ;}?>
                                        </td>
                                        <td class="text-end"><?= formattedPrice($item->amount) ?></td>
                                    </tr>

                        <?php
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
            </div>
        </div>
    </div>

</div>