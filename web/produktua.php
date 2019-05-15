<?session_start();?>
<?include "./includes/head.php"?>
<body>

<?php include "./includes/menu.php"?>

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

    <?php
$id = $_GET["id"];
$result = $dbConn->query("SELECT *, produktuak_lang.izena as izena, produktuak_lang.deskribapena as deskribapena FROM `produktuak` inner JOIN produktuak_lang on produktuak.id = produktuak_lang.id_produktoa WHERE produktuak.id=$id and hizkuntza = '$lang';");
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    ?>

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <img src="./img/produktuak/<?=$id?>.jpg" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

            <div class="mb-3">
              <a href="">
                <span class="badge purple mr-1"><?=$categoria[$row['kategoria']]?></span>
              </a>
            </div>

            <p class="lead">
              <span class="mr-1">

              <span><?=$row['salneurria']?>€</span>
            </p>

            <p class="lead font-weight-bold"><?=$row['izena']?></p>

            <p><?=$row['deskribapena']?></p>

            <form class="d-flex justify-content-left">
              <!-- Default input -->
               <button class="btn btn-primary btn-md my-0 p" onclick="add(<?=$id?>,<?=$row['salneurria']?>)"  type="button"><?=$tx_erosi?>
                <i class="fas fa-shopping-cart ml-1"></i>
              </button>

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <?}?>

      <hr>


    </div>
  </main>
  <!--Main layout-->

  <?php include "./includes/pie.php"?>


</body>

</html>
