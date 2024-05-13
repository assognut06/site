<div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link<?= (isset($_GET['page']) && $_GET['page'] === 'orders') ? ' active' : '' ?>" aria-current="page" href="?page=orders">Billets</a>
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