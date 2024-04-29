<?php
$result = "err";
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

if (file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    date_default_timezone_set('America/Bogota');
    $fechaActual = date('d-m-Y');
    $id_prod = trim($_REQUEST['id_prod']);
    $fvence = $_REQUEST['fvence'];
    $identre = $_REQUEST['identre'];
    $canreci = $_REQUEST['canreci'];
    $udetalle = $_REQUEST['udetalle'];
    $uentrada = $_REQUEST['uentrada'];
    $id_ord = $_REQUEST['id_ord'];
    $vtotal = $_REQUEST['vtotal'];
    $cant_ordenada = $_REQUEST['cant_ordenada'];
    $nofactura = $_REQUEST['nofactura'];
    $nolote = $_REQUEST['nolote'];

    $cadena = "insert into u116753122_cw3completa.bodegaubcproducto(idproducto, identrepanio, id_orden, cant_recibida, unidadentrada, valorunidad, unidaddetalle, fchvence,fecha_ingreso,nofactura,no_lote)values('" .
        $id_prod .
        "','" . $identre .
        "','" . $id_ord .
        "','" . $canreci .
        "','" . $uentrada .
        "','" . $vtotal .
        "','" . $udetalle .
        "','" . $fvence .
        "','" . $fechaActual .
        "','" . $nofactura .
        "','" . $nolote .
        "')";
    $resultado = mysqli_query($conetar, $cadena);
}//de hay cneion e bbd
