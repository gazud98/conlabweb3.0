
<?php

//Configuración global
require_once 'config/global_config.php';
//Funciones para el controlador frontal
require_once 'core/system/ControladorFrontal.func.php';

if (empty($_GET["ext"])) {
    if (!empty($_COOKIE["public_key"])) {
        $prefixdb  = cargarCookiedb($_COOKIE["public_key"]);
    } else {
        setcookie('public_key', KEY_PUBLIC_DEFAULT);
        $prefixdb  = cargarCookiedb(KEY_PUBLIC_DEFAULT);
    }
} else {
    if (!empty($_COOKIE["public_key"])) {
        if ($_COOKIE["public_key"] == $_GET["ext"]) {
            $prefixdb = cargarCookiedb($_COOKIE["public_key"]);
        } else {
            if (cargarCookiedb($_GET["ext"]) == PREFIX_DEFAULT) {
                $prefixdb = cargarCookiedb($_GET["ext"]);
            } else {
                //comprobar si la sessión esta iniciada.
                setcookie('public_key', $_GET["ext"]);
                $prefixdb = cargarCookiedb($_GET["ext"]);
            }
        }
    } else {
        setcookie('public_key', $_GET["ext"]);
        $prefixdb  = cargarCookiedb($_GET["ext"]);
    }
}

//define('prefixdb', $prefixdb);
define('prefixdb','u116753122_cw3completa');
//Base para los controladores
require_once 'core/system/ControladorBase.php';
//Cargamos controladores y acciones
if (isset($_GET["c"])) {
    $controllerObj = cargarControlador($_GET["c"]);
    lanzarAccion($controllerObj);
} else {
    $controllerObj = cargarControlador(CONTROLADOR_DEFECTO);
    lanzarAccion($controllerObj);
}


?>