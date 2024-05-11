<!--Contenu Orders-->
<div class="pt-0">
    <div class="mx-3">
        <h2 class="my-5 text-success text-center">Les billets de Gnut 06</h2>
        <div class="border border-success mb-5 mx-5"></div>
        <div class="row align-items-start mx-auto">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">Réf order</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Liste</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Paiement</th>
                        <th  class="text-end" scope="col">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $total_payment = 0;
                    if (isset($data_forms->data)) {
                        foreach ($data_forms->data as $item) {
                            if ($item->state == "Processed") { 
                                // echo $item->order->id;
                                ?>

                                <tr>
                                    <th scope="row"><a href="?page=<?= $_GET['page'] ?>&order=<?= htmlspecialchars($item->id) ?>"><?= htmlspecialchars($item->id) ?></th>
                                    <td><?= htmlspecialchars($item->payer->lastName) ?></td>
                                    <td><?= htmlspecialchars($item->payer->firstName) ?></td>
                                    <td><?= htmlspecialchars($item->payer->email) ?></td>
                                    <td><i class="bi bi-browser-edge"></i></td>
                                    <td><?= htmlspecialchars($item->order->formType) ?></td>
                                    <td><?php date_fr_j_h($item->order->date) ?></td>
                                    <td><?= isset($item->payments[0]->id) ? '<a href="?page=payments&payment=' . $item->payments[0]->id . '">' . $item->payments[0]->id . '</a>' : "Gratuit" ?></td>
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
                        <td class="text-end" cope="row" colspan="8"><strong class="text-success">Soit <?= $i ?> billets pour un Total</strong> : <?php formattedPrice($total_payment); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>