<?session_start();

include "./php/conexion.php";

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

$sql = $dbConn->prepare("INSERT INTO eskariak (id_bezeroa, salneurria)
    VALUES (:id_bezeroa, :salneurria)");

$sql->bindParam(':id_bezeroa', $last_id_bezeroa);
$sql->bindParam(':salneurria', $_SESSION["salneurria"]);
//$sql->bindParam(':ordainketa', "true");

$sql->execute();

foreach ($_SESSION['cart'] as $id => $kant) {

    $sql = $dbConn->prepare("INSERT INTO eskariak_produktuak (id_produktoa, id_bezeroa, kantitatea)
    VALUES (:id_produktoa, :id_bezeroa, :kantitatea)");

    $sql->bindParam(':id_produktoa', $id);
    $sql->bindParam(':id_bezeroa', $last_id_bezeroa);
    $sql->bindParam(':kantitatea', $kant);

    $sql->execute();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
