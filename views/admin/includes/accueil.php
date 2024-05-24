<div class="container pt-0">
    <div class="mx-3">
        <h2 class="my-5 text-success text-center"><?= htmlspecialchars($data->name) ?> Administration</h2>
        <div class="border border-success mb-5 mx-5 "></div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <img src="<?= $data->logo ?>" alt="Logo <?= htmlspecialchars($data->name) ?>" class="mx-auto">
            </div>
            <div class="col-12 my-4 text-center">
                <p class="fs-4">
                    <?php
                    // Récupérer la description depuis $data
                    $description = htmlspecialchars($data->description);

                    // Ajouter un retour à la ligne après chaque point
                    $description_with_line_breaks = str_replace('.', ".<br>", $description);

                    // Afficher la description avec les sauts de ligne
                    echo $description_with_line_breaks;
                    ?>
                </p>
            </div>
            <div class="col-12 col-xxl-4 fs-4 text-center"><?= (htmlspecialchars($data->type) == "Association1901Rig") ? "Association loi 1901 : " : "" ?> <?= htmlspecialchars($data->category) ?></div>
            <div class="col-12 col-xxl-4 fs-4 text-center"><?= htmlspecialchars($data->zipCode) ?> <?= htmlspecialchars($data->city) ?></div>
            <div class="col-12 col-xxl-4 mb-4 fs-4 text-center">RNA : <?= htmlspecialchars($data->rnaNumber) ?></div>
            <div class="col-12 mb-4 text-center">
                <button class="HaAuthorizeButton mx-auto" onclick="var left = (screen.width - 600) / 2; var top = (screen.height - 600) / 2; window.open('https://auth.helloasso.com/authorize?client_id=6bebba59efa144698eaac784f4de1fcf&redirect_uri=https://gnut06.org&code_challenge=YsY192w3qKcEm7Kd8KpLgC25nRAavhDSvPakJtoVRq8&code_challenge_method=S256&state=500','_blank','width=600,height=600,left='+left+',top='+top);">
                    <img src="https://api.helloasso.com/v5/DocAssets/logo-ha.svg" alt="" class="HaAuthorizeButtonLogo">
                    <span class="HaAuthorizeButtonTitle">Connecter à HelloAsso</span>
                </button>
            </div>
            <div class="col-12 fs-4 mb-4 text-center"><a href="<?= htmlspecialchars($data->url) ?>" target="_blank" rel="noopener noreferrer">Gnut 06 chez Helloasso</a></div>
            
        </div>
    </div>
</div>