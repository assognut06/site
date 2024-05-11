<?php ob_start() ?>
<!--Contenu-->
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6 pb-5 text-center">


        <section>
            <h1 class="my-5 text-success">Bienvenue à Xyloscope Nexus</h1>
            <p class="lead">Orchestré par l'association innovante Gnut 06, "Xyloscope Nexus" est l'espace virtuel de prédilection pour les passionnés de communication et médias numériques.</p>
            <hr class="my-4">
            <p>Ce hub virtuel représente l'expertise de Xyloscope dans les domaines suivants :</p>
            <ul class="list-unstyled">
                <li><strong>Communication et Presse :</strong> Plateforme pour des conférences de presse virtuelles, des débats en direct et des séminaires.</li>
                <li><strong>Captation Numérique :</strong> Démonstrations et ateliers sur les techniques de capture d'images et de sons.</li>
                <li><strong>Organisme de Formations :</strong> Programmes éducatifs spécialisés dans la photographie, la vidéographie et l'utilisation d'aéronefs.</li>
                <li><strong>Photos et Vidéos :</strong> Galerie virtuelle pour l'exposition et la collaboration sur des projets multimédia.</li>
                <li><strong>Aéronef :</strong> Centre d'information pour l'imagerie par drone.</li>
            </ul>
            <a class="btn btn-success btn-lg" href="https://4ea7e20c60.us2.myhubs.net/link/mPbvJCo" role="button" target="_blank">Xyloscope Nexus</a>
    </div>
    <div class="col-lg-3"></div>
</div>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>