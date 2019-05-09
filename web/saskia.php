<?session_start();?>
<?include "./includes/head.php"?>
<body>

<?php include "./includes/menu.php"?>

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Saskia</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body" action="ordainketa.php" method="post">

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--firstName-->
                  <div class="md-form ">
                    <input type="text" id="izena" name="izena" class="form-control" pattern="([A-z])+" required>
                    <label for="firstName" class="">Izena</label>
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--lastName-->
                  <div class="md-form">
                    <input type="text" id="abizena" name="abizena" class="form-control" pattern="([A-z])+" required>
                    <label for="lastName" class="">Abizena</label>
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--email-->
              <div class="md-form mb-5">
                <input type="text" id="email" name="email" class="form-control" placeholder="youremail@example.com" required>
                <label for="email" class="">Email</label>
              </div>

              <!--pass-->
              <div class="md-form mb-5">
                <input type="password" id="pass" class="form-control" placeholder="password" required>
                <label for="email" class="">Password</label>
              </div>

              <!--address-->
              <div class="md-form mb-5">
                <input type="text" name="helbidea" class="form-control" placeholder="1234 Main St" pattern="([A-z1-9\s,.:º-])+" required>
                <label for="address" class="">helbidea</label>
              </div>

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4">

                  <label for="country">Herria</label>
                  <select class="custom-select d-block w-100" name="herria" required>
                    <option value="">Aukeratu</option>
                    <option>Donostia</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="state">Herrialdea</label>
                  <select class="custom-select d-block w-100" name="herrialdea" required>
                    <option value="">Aukeratu</option>
                    <option>Espainia</option>
                  </select>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="zip">PK</label>
                  <input type="text" pattern="([0-9]{5})" class="form-control" name="pk" placeholder="" required>
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Comprar</button>

            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Pedido</span>
            <span class="badge badge-secondary badge-pill" id="kant2"><?=$_SESSION["total"]?></span>
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1" id="faktura">
          <?php foreach ($_SESSION['cart'] as $id => $kant) {
    $result = $dbConn->query("SELECT *, produktuak_lang.izena as izena, produktuak_lang.deskribapena as deskribapena FROM `produktuak` inner JOIN produktuak_lang on produktuak.id = produktuak_lang.id_produktoa WHERE produktuak.id=$id and hizkuntza = 'eu';");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>

            <li class="list-group-item justify-content-between lh-condensed" id="li_<?=$id?>">
              <div>
                <h6 class="my-0"><?=$row['izena']?></h6>

                <a onclick="remove(<?=$id?>,<?=$row['salneurria']?>)"><span class="badge red z-depth-1 mr-1"> - </span></a>
                <a onclick="add(<?=$id?>,<?=$row['salneurria']?>)"><span class="badge green z-depth-1 mr-1"> + </span></a>
                <span class="badge badge-light z-depth-1 mr-1" id="kant_<?=$id?>"> <?=$kant?> </span>
              </div>

              <span class="text-muted" style="float:right;" id="saln_<?=$id?>"><?=$_SESSION["sal"][$id]?>€</span>
            </li>
          <?php }}?>

            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong id="salneurritotala"><?=$_SESSION["salneurria"]?>€</strong>
            </li>
          </ul>
          <!-- Cart -->


          <button onclick="limpiar()" class="btn btn-secondary btn-md waves-effect m-0" type="button" >Limpiar</button>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
  <?php include "./includes/pie.php"?>

</body>

</html>
