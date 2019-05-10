<?php

$databaseHost = 'localhost';
$databaseName = 'enekotam_denda';
$databaseUsername = 'enekotam_denda';
$databasePassword = 'denda1';

try {
    $dbConn = new PDO("mysql:host={$databaseHost};dbname={$databaseName};charset=utf8", $databaseUsername, $databasePassword);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
