<?session_start();
if (!isset($_SESSION["total"])) {
    header('Location: ./index.php');
}

include "./includes/head.php";

$izena = $abizena = $email = $pass = $helbidea = $herria = $herrialdea = $pk = "";

$izena = test_input($_POST["izena"]);
$abizena = test_input($_POST["abizena"]);
$email = test_input($_POST["email"]);
$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
$helbidea = test_input($_POST["helbidea"]);
$herria = test_input($_POST["herria"]);
$herrialdea = test_input($_POST["herrialdea"]);
$pk = test_input($_POST["pk"]);

$sql = $dbConn->prepare("INSERT INTO bezeroak (izena, abizena, email, helbidea, herria, herrialdea, pk, pass)
    VALUES (:izena, :abizena, :email, :helbidea, :herria, :herrialdea, :pk, :pass)");

$sql->bindParam(':izena', $izena);
$sql->bindParam(':abizena', $abizena);
$sql->bindParam(':email', $email);
$sql->bindParam(':pass', $pass);
$sql->bindParam(':helbidea', $helbidea);
$sql->bindParam(':herria', $herria);
$sql->bindParam(':herrialdea', $herrialdea);
$sql->bindParam(':pk', $pk);

$sql->execute();

$last_id_bezeroa = $dbConn->lastInsertId();

//echo "<br>" . $e->getMessage();

$sql = $dbConn->prepare("INSERT INTO eskariak (id_bezeroa, salneurria, data)
    VALUES (:id_bezeroa, :salneurria, :data)");

$sql->bindParam(':id_bezeroa', $last_id_bezeroa);
$sql->bindParam(':salneurria', $_SESSION["salneurria"]);
$sql->bindParam(':data', date("Y-m-d H:i:s"));

$sql->execute();

$last_id_eskaria = $dbConn->lastInsertId();

foreach ($_SESSION['cart'] as $id => $kant) {

    $sql = $dbConn->prepare("INSERT INTO eskariak_produktuak (id_produktoa, id_eskaria, kantitatea)
    VALUES (:id_produktoa, :id_eskaria, :kantitatea)");

    $sql->bindParam(':id_produktoa', $id);
    $sql->bindParam(':id_eskaria', $last_id_eskaria);
    $sql->bindParam(':kantitatea', $kant);

    $sql->execute();
}

foreach ($_SESSION['cart'] as $id => $kant) {

    $sql = $dbConn->prepare("UPDATE produktuak SET kantitatea = (kantitatea - :kantitatea)  WHERE id=$id");

    $sql->bindParam(':kantitatea', $kant);

    $sql->execute();
}

?>

<body>

<?php include "./includes/menu.php"?>

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center"><?=$tx_ordaniketa?></h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div>
            <p><?=$tx_mila?></p>
          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->


      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
  <?php include "./includes/pie.php"?>
  <script>setTimeout(limpiar, 2000);</script>

</body>

</html>

