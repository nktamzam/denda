<?php

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

echo $izena;
echo "hola";


$dbsql = $dbConn->prepare("INSERT INTO bezeroak (izena, abizena, email, helbidea, herria, herrialdea, pk, pass)
    VALUES (:izena, :abizena, :email, :helbidea, :herria, :herrialdea, :pk, :pass)");

    $dbsql->bindParam(':izena', $izena);
    $dbsql->bindParam(':abizena', $abizena);
    $dbsql->bindParam(':email', $email);
    $dbsql->bindParam(':pass', $pass);
    $dbsql->bindParam(':helbidea', $helbidea);
    $dbsql->bindParam(':herria', $herria);
    $dbsql->bindParam(':herrialdea', $herrialdea);
    $dbsql->bindParam(':pk', $pk);
  
    $dbsql->execute();


    $last_id = $dbConn->lastInsertId();
    echo $last_id;



//echo "<br>" . $e->getMessage();



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
?>