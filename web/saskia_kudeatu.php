<?php
session_start();

if (isset($_GET["add"])) {
    $i = $_GET["add"];
    if (isset($_SESSION["cart"][$i])) {
        ++$_SESSION["cart"][$i];
    } else {
        $_SESSION["cart"][$i] = 1;
    }
    $_SESSION["salneurria"] += $_GET["salneurria"];
    //$_SESSION["cart"][$i]["saln"] += $_GET["salneurria"];
    ++$_SESSION["total"];
}

if (isset($_GET["remove"])) {
    $i = $_GET["remove"];
    if (isset($_SESSION["cart"][$i])) {
        --$_SESSION["cart"][$i];
        $_SESSION["salneurria"] -= $_GET["salneurria"];
        //$_SESSION["cart"][$i]["saln"] -= $_GET["salneurria"];
        if ($_SESSION['cart'][$i] == 0) {
            unset($_SESSION['cart'][$i]);
        }
    }
    if ($_SESSION['total'] > 0) {
        --$_SESSION["total"];
    }
}

if (isset($_GET["clear"])) {
    unset($_SESSION['cart']);
    $_SESSION["total"] = 0;
}

echo json_encode($_SESSION);
