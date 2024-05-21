<!--Contenu Actualités-->
<div class="pt-0">
    <div class="mx-3">
        <h2 class="my-5 text-success text-center">Les paiements de Gnut 06</h2>
        <div class="border border-success mb-5 mx-5"></div>
        <div class="row align-items-start mx-auto">
            <div class="col-12">
                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Réf paiement</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Order</th>
                            <th class="text-end" scope="col">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $total_payment = 0;
                        if (isset($data_forms->data)) {
                            foreach ($data_forms->data as $item) {
                                if ($item->status == "Authorized") { ?>
                                    <tr>
                                        <th scope="row">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modal_payment_<?= htmlspecialchars($item->id) ?>">
                                                <?= htmlspecialchars($item->id) ?>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade  modal-xl" id="Modal_payment_<?= htmlspecialchars($item->id) ?>" tabindex="-1" aria-labelledby="Modal_payment_<?= htmlspecialchars($item->id) ?>Label" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="Modal_payment_<?= htmlspecialchars($item->id) ?>Label">Détails du paiement numéro : <?= htmlspecialchars($item->id) ?></h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            $_GET['payment'] = htmlspecialchars($item->id);
                                                            include "includes/payments.php";
                                                            include 'views/admin/includes/payments/payment.php' ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <td><?= htmlspecialchars($item->payerLastName) ?></td>
                                        <td><?= htmlspecialchars($item->payerFirstName) ?></td>
                                        <td><?= htmlspecialchars($item->userEmail) ?></td>
                                        <td><?= htmlspecialchars($item->formType) ?></td>
                                        <td><?php date_fr_j_h($item->orderDate) ?></td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modal_<?= htmlspecialchars($item->orderId) ?>">
                                                <?= htmlspecialchars($item->orderId) ?>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade  modal-xl" id="Modal_<?= htmlspecialchars($item->orderId) ?>" tabindex="-1" aria-labelledby="Modal_<?= htmlspecialchars($item->orderId) ?>Label" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="Modal_<?= htmlspecialchars($item->orderId) ?>Label">Détails du billet numéro : <?= htmlspecialchars($item->orderId) ?></h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            $_GET['order'] = htmlspecialchars($item->orderId);
                                                            include "includes/orders.php";
                                                            include 'views/admin/includes/orders/order.php' ?>
                                                            <!-- <iframe src="views/admin/includes/orders/order.php?order=<?= htmlspecialchars($item->orderId) ?>" frameborder="0" width="100%" height="700px"></iframe> -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                            <td class="text-end" cope="row" colspan="8"><strong class="text-success">Total</strong> : <?php formattedPrice($total_payment); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>