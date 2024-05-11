<?php ob_start() ?>
<!--Contenu-->
<div class="container mt-5">
        <h1 class="text-center text-success py-5">Optimisation des scènes</h1>
        <h2 class="text-success">Améliorer la performance</h2>
        <p>Lors de la création de scènes Hubs, vous souhaiterez probablement qu'elles soient performantes sur un large éventail d'appareils. Des casques VR haut de gamme reliés par câble aux téléphones mobiles les moins puissants; la performance d'une scène peut varier en fonction du type d'appareil et de la vitesse de connexion de vos visiteurs.</p>

        <h3 class="text-success">Mesurer la performance</h3>
        <p>Pour examiner de plus près les performances de votre scène, vous pouvez ouvrir le menu État VR. Cliquez sur le compteur FPS dans le coin inférieur droit sur le bureau (ou en VR, tapez /vrstats dans la boîte de chat). Cela vous montrera des informations supplémentaires sur le temps de chargement, le nombre de triangles et les textures de votre scène.</p>

        <h3 class="text-success">Optimisation des images et vidéos</h3>
        <ul>
                <li>Réduisez les dimensions des grandes images/vidéos</li>
                <li>Comprimez les fichiers, utilisez la fonction "enregistrer pour le web" dans Photoshop pour les images, ou utilisez un outil de compression d'images ou de vidéos en ligne pour réduire la taille du fichier.
                </li>
                <li>Essayez de convertir les images .png en .jpeg, car elles ont souvent des tailles de fichier plus petites.
                </li>
                <li>Convertissez les GIF en format vidéo, car ils fonctionnent plus efficacement dans Hubs.
                </li>
        </ul>

        <h3 class="text-success">Optimisation des modèles 3D</h3>
        <p>Des modèles 3D trouvés à l'aide du navigateur Sketchfab et Google Poly dans Spoke et Hubs sont déjà filtrés en fonction de la taille/complexité des objets. Cependant, si vous souhaitez améliorer les performances d'un autre modèle téléchargeable, vous pouvez soit réduire la taille de la texture de l'objet, soit réduire le nombre de triangles. Vous pouvez utiliser un outil comme Blender pour cela.
        </p>

        <h4 class="text-success">Réduire la taille de la texture</h4>
        <p>Pour réduire la taille de la texture d'un modèle glb, vous pouvez le convertir en fichier gltf, de sorte qu'il y ait un dossier avec tous les fichiers de texture et réduire la taille des textures d'image à l'aide d'un outil comme Photoshop (réduisez la taille des images de moitié, ou d'un quart par exemple).
        </p>
        <p>Nous avons également réalisé une vidéo sur d'autres choses que vous pouvez faire pour optimiser la taille de vos textures dans Blender.</p>

        <h4 class="center text-success">Réduire le nombre de triangles</h4>
        <p>Il n'y a pas de règle d'or sur le nombre idéal de triangles dans un modèle, cependant, nous recommandons d'utiliser des modèles avec seulement des dizaines de milliers, plutôt que des centaines de milliers de triangles. De nombreux modèles 3D complexes peuvent voir leur nombre de triangles réduit sans grande incidence sur l'apparence du modèle. Vous pouvez le faire à l'aide de l'outil de Décimation de maillage dans Blender. Pour des instructions, consultez cette vidéo.
        </p>

        <h3 class="text-success">Notes sur Oculus Quest & Mobile</h3>
        <p>Notez que certaines scènes pourraient sembler différentes.</p>
</div>
<?php $contenu = ob_get_clean()  ?>
<?php require_once 'views/gabarit.php'; ?>