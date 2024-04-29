<?php
$result = "err";

if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $fchhora = date('Y-m-d', time());
    $idpe = $_REQUEST['idpe'];
    $id_prod = trim($_POST['id_prod']);
    $identre = trim($_POST['identre']);
    $cant = trim($_POST['cant']);
    $fchvence = trim($_POST['fchvence']);
    $unidadentrada = trim($_POST['unidadentrada']);
    $unidaddetalle = trim($_POST['unidaddetalle']);
    $nofactura = trim($_POST['nofactura']);
    $id_orden = trim($_POST['id_orden']);
    $total = trim($_POST['total']);
    $entr = trim($_POST['entr']);
    $totalc = -1 * $cant;

    // Primera inserción
    $cadenax = "insert into u116753122_cw3completa.bodegaubcproducto(idproducto,identrepanio,id_orden,cant_recibida,unidadentrada,unidaddetalle,fchvence,nofactura,op)values('" .
        $id_prod .
        "','" . $entr .
        "','" . $id_orden .
        "','" . $totalc .
        "','" . $unidadentrada .
        "','" . $unidaddetalle .
        "','" . $fchvence .
        "','" . $nofactura .
        "','-')";
    $resultadox = mysqli_query($conetar, $cadenax);
    
 

    // Obtener el ID generado por la primera inserción
    $id_padre = mysqli_insert_id($conetar);
   $cadenax = "insert into traslado(idproducto,identrepanio,id_origen,id_orden,cant_recibida,unidadentrada,unidaddetalle,fchvence,fecha_ingreso,nofactura)values('" .
        $id_prod .
        "','" . $identre .
        "','" . $id_padre .
        "','" . $id_orden .
        "','" . $cant .
        "','" . $unidadentrada .
        "','" . $unidaddetalle .
        "','" . $fchvence .
        "','" . $fchhora .
        "','" . $nofactura .
        "')";
    $resultadox = mysqli_query($conetar, $cadenax);
   
   $cadena = "insert into u116753122_cw3completa.bodegaubcproducto(idproducto,idpadre,identrepanio,id_orden,cant_recibida,unidadentrada,unidaddetalle,fchvence,nofactura,op)values('" .
        $id_prod .
        "','" . $id_padre . // Utilizamos el ID generado como idpadre
        "','" . $identre .
        "','" . $id_orden .
        "','" . $cant .
        "','" . $unidadentrada .
        "','" . $unidaddetalle .
        "','" . $fchvence .
        "','" . $nofactura .
        "','+')";
    $resultado = mysqli_query($conetar, $cadena);
}

