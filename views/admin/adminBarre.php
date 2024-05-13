<div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link<?= (isset($_GET['item']) && $_GET['item'] === 'orders') ? ' active' : '' ?>" aria-current="item" href="?page=admin&item=orders">Billets</a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?= (isset($_GET['page']) && $_GET['page'] === 'payments') ? ' active' : '' ?>" href="?page=payments">Paiements</a>
        </li>
        <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> -->
        <li class="nav-item">
            <a class="nav-link disabled">A venir</a>
        </li>
    </ul>
</div>