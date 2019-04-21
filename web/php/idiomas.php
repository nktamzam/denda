<?php

/* Setting variables */
$langs = array('es', 'eu');
$cookie_name = "idioma";
$cookie_domain = ".aeg.eus";

if (!empty($_GET['idioma']) && in_array($_GET['idioma'], $langs)) {

    /* Set language */
    $lang = $_GET['idioma'];

    /* Set cookie */
    $set_cookie = true;

} else {

    /* Check if cookie exists */
    if ( isset($_COOKIE[$cookie_name]) AND !empty($_COOKIE[$cookie_name]) AND in_array($_COOKIE[$cookie_name], $langs) ) {

        /* Get cookie and set language*/
        $lang = $_COOKIE[$cookie_name];

    } else {

        /* Get browser language */
        if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
          $browserlang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
          $li = 999;
          $lang = $langs[0];
          foreach ($langs as $l) {
            $x = strpos($browserlang, $l);
            if ($x !== false && $x<$li) {
              $li = $x;
              $lang = $l;
            }
          }
        } else {
          $lang = $langs[0];
        }

        /* Set cookie */
        $set_cookie = true;

    }
}

/* Incluir archivo del idioma */
include 'idioma_' .$lang . '.php';
if ($lang=="eu") {$idioma="Esp";$idfiomadestino="es";} else {$idioma="Eus";$idfiomadestino="eu";}


/* Finally set cookie */
if ($set_cookie) { setcookie("$cookie_name", $lang, time()+(60*60*24*365), "/", $cookie_domain); }


/* Cambiar idiomas */
function cambiaIdioma($a, $b) {
$url=$_SERVER['REQUEST_URI'];
if (substr($url, -3, 3)==$a) {
  echo $url;
}
else if (substr($url, -3, 3)==$b) {
  echo substr($url, 0, -3).$a;
} else {
  echo $url.$a;
}
}

?>
