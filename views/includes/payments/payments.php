<!--Contenu Actualités-->
<div class="pt-0">
    <div class="mx-3">
        <h2 class="my-5 text-success text-center">Les paiements de Gnut 06</h2>
        <div class="border border-success mb-5 mx-5"></div>
        <div class="row align-items-start mx-auto">
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
                        <th  class="text-end" scope="col">Montant</th>
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
                                    <th scope="row"><a href="?page=<?= $_GET['page'] ?>&payment=<?= htmlspecialchars($item->id) ?>"><?= htmlspecialchars($item->id) ?></th>
                                    <td><?= htmlspecialchars($item->payerLastName) ?></td>
                                    <td><?= htmlspecialchars($item->payerFirstName) ?></td>
                                    <td><?= htmlspecialchars($item->userEmail) ?></td>
                                    <td><?= htmlspecialchars($item->formType) ?></td>
                                    <td><?php date_fr_j_h($item->orderDate) ?></td>
                                    <td><?php echo $item->orderId ?></td>
                                    <td  class="text-end"><?= formattedPrice($item->amount) ?></td>
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