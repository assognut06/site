<nav class="navbar navbar-expand-xxl bg-dark fixed-top" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=index"><img src="images/logo_trans-min.png" alt="Logo de Association Gnut 06" class="logoNavbar"> Gnut 06</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse fs-5" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= (empty($_GET['page']) || ($_GET['page'] == "index")) ? "active" : "" ?>" aria-current="page" href="?page=index">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (!empty($_GET['news']) && $_GET['page'] == "news") ? "active" : "" ?>" href="?page=news">Actualités</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Nos Hubs
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="https://gnut06.sharepoint.com/sites/Gnut06" target="_blank">Le Hub Gnut 06 sur notre portail Microsoft</a></li>
            <li><a class="dropdown-item <?= (!empty($_GET['page']) && $_GET['page'] == "accueilGnut06") ? "active" : "" ?>" href="?page=accueilGnut06">Salle d'initialtion au métaverse Gnut 06</a></li>
            <li><a class="dropdown-item <?= (!empty($_GET['page']) && $_GET['page'] == "test_hubs") ? "active" : "" ?>" href="?page=test_hubs">Participer aux tests des Hubs</a></li>
            <li><a class="dropdown-item <?= (!empty($_GET['page']) && $_GET['page'] == "xyloscope") ? "active" : "" ?>" href="?page=xyloscope">Xyloscope Nexus</a></li>
            <li><a class="dropdown-item" href="https://e24594a3fa.us2.myhubs.net/link/P7RJ8TC" target="_blank">Le metaverse musical avec Cnut 06</a></li>
            <li><a class="dropdown-item <?= (!empty($_GET['page']) && $_GET['page'] == "stephaneMaurel") ? "active" : "" ?>" href="?page=stephaneMaurel">Maurel Communication &amp; Events</a></li>
            <li><a class="dropdown-item <?= (!empty($_GET['page']) && $_GET['page'] == "scnes") ? "active" : "" ?>" href="?page=scenes" target="_blank">Optimisation des scènes</a></li>
            <!-- 
            <li><a class="dropdown-item" href="https://8b9007428f.us1.myhubs.net/link/eCicRYk" target="_blank">Studio Gnut 06</a></li> -->
            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vivre un handicap
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item <?= (!empty($_GET['page']) && $_GET['page'] == "associationsNice") ? "active" : "" ?>" href="?page=associationsNice">Associations à Nice</a></li>
            <li><a class="dropdown-item" href="https://mdph.departement06.fr/informations-pratiques/accueil-du-public-5391.html" target="_blank">MDPH des Alpes-Maritimes</a></li>
            <li><a class="dropdown-item" href="https://www.handitoit.org/" target="_blank">HandiToit Alpes-Maritimes</a></li>
            <!--<li><a class="dropdown-item" href="http://www.handisport-cotedazur.org/" target="_blank">HandiSport Côte d'Azur</a></li> -->
            <li><a class="dropdown-item" href="https://www.ladapt.net/" target="_blank">ADAPT Alpes-Maritimes</a></li>
            <!-- <li><a class="dropdown-item" href="http://www.aciah.com/" target="_blank">ACIAH - Association Côte d'Azur</a></li> -->
            <li><a class="dropdown-item" href="https://www.service-public.fr/particuliers/vosdroits/N19775" target="_blank">Allocations pour adulte handicapé</a></li>
            <li><a class="dropdown-item" href="https://www.agefiph.fr/" target="_blank">AGEFIPH (emploi et handicap)</a></li>
            <li><a class="dropdown-item" href="https://www.handicap.gouv.fr/" target="_blank">Secrétariat d’État chargé des Personnes handicapées</a></li>
            <li><a class="dropdown-item" href="https://www.fiphfp.fr/" target="_blank">FIPHFP</a></li>
            <li><a class="dropdown-item" href="https://www.cnsa.fr/" target="_blank">CNSA</a></li>
            <li><a class="dropdown-item" href="https://www.unapei.org/" target="_blank">Unapei</a></li>
            <li><a class="dropdown-item" href="https://www.adapt.org/" target="_blank">L’ADAPT</a></li>
            <li><a class="dropdown-item" href="https://www.apf-francehandicap.org/" target="_blank">APF France handicap</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://youtube.com/playlist?list=PLNoj2I1xAgEwK9d8LJDqTQ6plCA0bacAn&si=gEhfn2h3jZINW5Hq" target="_blank">Voyage VR</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://gnut06-my.sharepoint.com/:p:/g/personal/gnut_gnut06_org/EWF1GZ9xibdFlb59cTLDpt4B1DtbBnk526A6JjOu-0dP0A?rtime=0eCPW1Mr3Eg" target="_blank">Présentation</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Soutenir GNUT 06</a>
          <ul class="dropdown-menu">
            <li class="nav-item">
              <a class="nav-link <?= (!empty($_GET['page']) && $_GET['page'] == "adhesion") ? "active" : "" ?>" href="?page=adhesion">Adhésion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= (!empty($_GET['page']) && $_GET['page'] == "boutique") ? "active" : "" ?>" href="?page=boutique">Boutique Gnut 06</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= (!empty($_GET['page']) && $_GET['page'] == "don") ? "active" : "" ?>" href="?page=don">Faire un don</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (!empty($_GET['page']) && $_GET['page'] == "contact") ? "active" : "" ?>" href="?page=contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (!empty($_GET['page']) && $_GET['page'] == "aPropo") ? "active" : "" ?>" href="?page=aPropos">A propos</a>
        </li>
      </ul>
    </div>
  </div>
</nav>