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
        <?php } else {
            echo 'Gratuit';
        } ?>
    </td>
    <td class="text-end"><?= formattedPrice($item->amount) ?></td>
</tr>