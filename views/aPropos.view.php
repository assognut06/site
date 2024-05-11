<?php ob_start() ?>
<!--Contenu-->
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-6 pb-5">

<div class="container mt-5">
    <h1 class="mb-4 text-center  text-success">À propos de l'association Gnut 06</h1>
    
    <p>L'association Gnut 06 est née de la conviction que chaque individu, quel que soit son handicap, a le droit de vivre des expériences enrichissantes et d'être pleinement intégré dans la société.</p>

    <h3 class="mt-4">Notre Mission</h3>
    <p>Nous utilisons les technologies innovantes comme la réalité virtuelle, augmentée et mixte pour créer des expériences concrètes pour les personnes en situation de handicap. Notre objectif est de leur permettre de transcender les limites imposées par leur environnement physique et de leur offrir une chance d'explorer, d'apprendre et de s'épanouir.</p>

    <h3>Nos Activités</h3>
    <p>Nos membres dévoués organisent régulièrement des visites à l'hôpital, transformant les chambres d'hôpital en portails vers d'autres mondes grâce à la réalité virtuelle. Ces séances ne sont pas seulement divertissantes, elles offrent un répit essentiel aux patients en les éloignant temporairement de leur environnement médicalisé.</p>
    <p>Par ailleurs, nous proposons également des stages d'initiation aux nouvelles technologies. Ces ateliers visent à familiariser les participants avec les outils de demain, renforçant ainsi leur estime de soi et leur autonomie.</p>

    <h3>Notre Vision</h3>
    <p>Nous aspirons à une société où le handicap n'est pas une barrière. Une société où les technologies innovantes servent de ponts, comblant les fossés et ouvrant des horizons. À travers nos efforts, nous espérons inspirer d'autres à envisager un monde plus inclusif.</p>
    </div>
<div class="col-lg-3"></div>
</div>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>
