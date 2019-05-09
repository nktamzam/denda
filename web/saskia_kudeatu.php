<?php
session_start();

if (isset($_GET["add"])) {
    $i = $_GET["add"];
    $salneurria = $_GET["salneurria"];

    if (isset($_SESSION["sal"][$i])) {
        $_SESSION["sal"][$i] += (float) $salneurria;
    } else {
        $_SESSION["sal"][$i] = (float) $salneurria;
    }
    if (isset($_SESSION["cart"][$i])) {
        ++$_SESSION["cart"][$i];
    } else {
        $_SESSION["cart"][$i] = 1;
    }
    $_SESSION["salneurria"] += $salneurria;
    ++$_SESSION["total"];
}

if (isset($_GET["remove"])) {
    $i = $_GET["remove"];
    $salneurria = $_GET["salneurria"];
    if (isset($_SESSION["cart"][$i])) {
        --$_SESSION["cart"][$i];
        $_SESSION["salneurria"] -= $salneurria;
        $_SESSION["sal"][$i] -= $salneurria;
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
    session_destroy();
}

echo json_encode($_SESSION);
