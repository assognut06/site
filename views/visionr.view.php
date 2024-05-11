<?php ob_start() ?><!--Contenu-->
<div class="text-center mt-5 py-5">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/videoseries?si=4MVvAjz-Oyew5Zuv&amp;list=PLuJwrz-KtAhs4la1AoN6JEp6dsgg9xRs2" allowfullscreen></iframe>
    </div>
</div>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>