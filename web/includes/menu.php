  <?php
if (!isset($_SESSION["total"])) {$_SESSION["total"] = 0;}
if (!isset($_SESSION["salneurria"])) {$_SESSION["salneurria"] = 0;}
?>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->

        <img src="./img/alokairukar.png" style="width: 80px; "/>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="./index.php">Denda
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="https://enekotamayo.aegcloud.pro/blog/" target="_blank">Gure bloga</a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="https://enekotamayo.aegcloud.pro/descargar-db/"
              target="_blank">DB Deskarga</a>
          </li>

        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="./saskia.php">
              <span class="badge red z-depth-1 mr-1" id="kant"> <?=$_SESSION["total"]?> </span>
              <i class="fas fa-shopping-cart"></i>
              <span class="clearfix d-none d-sm-inline-block"> Carrito </span>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?idioma=es"class="nav-link waves-effect">
          <span class="flag-icon flag-icon-es"> ESP </span>
          </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?idioma=eu"class="nav-link waves-effect">
          <span class="flag-icon flag-icon-es"> EUS </span>
          </a>
          </li>


        </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->