<img src="img/logo.png" alt="Logo de Guider" height="120px" width="120px" id="mainLogo">
<header class="container-fluid">
 
 
  <nav class="navbar navbar-expand-lg navbar-blue text-custom-white col-xl-9 offset-xl-3">
    <img src="img/logo.png" alt="Logo de Guider" height="60px" width="60px" id="mainLogoSmall" class="d-md-none d-lg-none d-xl-none">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburger" aria-controls="hamburger" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fas fa-bars text-custom-white"></span>
    </button>
    <div class="collapse navbar-collapse" id="hamburger">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link text-custom-white" href="index.php">Accueil</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-custom-white" href="#" id="themeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Thèmes
          </a>
          <div class="dropdown-menu" aria-labelledby="themeDropdown">
            <a class="dropdown-item text-custom-white" href="#">Dégustation</a>
            <a class="dropdown-item text-custom-white" href="#">Visite à la ferme</a>
          </div>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-custom-white" href="#" id="paysDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Arrières-Pays
          </a>
          <div class="dropdown-menu" aria-labelledby="paysDropDown">
            <a class="dropdown-item text-custom-white" href="pays.php?url=1">Arrière-pays Grassois</a>
            <a class="dropdown-item text-custom-white" href="pays.php?url=2">Vallée de l'Esteron</a>
            <a class="dropdown-item text-custom-white" href="pays.php?url=3">Vallée du Var</a>
            <a class="dropdown-item text-custom-white" href="pays.php?url=4">Vallée de la Tinée</a>
            <a class="dropdown-item text-custom-white" href="pays.php?url=5">Vallée de la Vésubie</a>
            <a class="dropdown-item text-custom-white" href="pays.php?url=6">Pays des Paillons</a>
            <a class="dropdown-item text-custom-white" href="pays.php?url=7">Vallée de la Roya</a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link text-custom-white" href="contact.php">Nous contacter</a>
        </li>
        <?php 
          if(!isset($_SESSION['user'])){
        ?>
        <li class="nav-item">
          <a class="nav-link text-custom-white" href="login-register.php">Se connecter/S'enregistrer&nbsp;<i class="fas fa-sign-in-alt"></i></a>
        </li>
      <?php } ?>
      <?php 
          if(!empty($_SESSION['user'])){
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-custom-white" href="#" id="accountDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Mon Compte
          </a>
          <div class="dropdown-menu" aria-labelledby="accountDropDown">
            <a class="dropdown-item text-custom-white" href="account.php">Mon Compte</a>
            <a class="dropdown-item text-custom-white" href="disconnect.php">Déconnexion</a>
          </div>
        </li>
        <?php } ?>
      </ul>
    </div>
  </nav>

</header>