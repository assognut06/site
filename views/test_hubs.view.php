<?php ob_start() ?><!--Contenu-->
<div class="pt-2">
    <div class="my-1 mx-2 text-center">
    <iframe width="1080px" height="2500" src="https://forms.office.com/e/VPCWvvjNPk?embed=true" frameborder="0" marginwidth="0" marginheight="0" style="border: none; max-width:100%; max-height:100vh" allowfullscreen webkitallowfullscreen mozallowfullscreen msallowfullscreen> </iframe>
    </div>
</div>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>