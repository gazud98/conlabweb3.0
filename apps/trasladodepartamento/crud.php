<?php
$result = "err";
//

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

  
    $fchhora = date('m-d-Y h:i:s a', time());

    $idpe = $_REQUEST['idpe'];

    $id_prod = trim($_POST['id_prod']);
    
    $cant = trim($_POST['cant']);
    $fchvence = trim($_POST['fchvence']);
    $unidadentrada = trim($_POST['unidadentrada']);
    $unidaddetalle = trim($_POST['unidaddetalle']);
    $nofactura = trim($_POST['nofactura']);
    $id_orden = trim($_POST['id_orden']);
    $entr = trim($_POST['entr']);
    $dep = trim($_POST['dep']);

    $id_persona = trim($_POST['id_persona']);
    $total = trim($_POST['total']);
    $totalc = -1* $cant;

    date_default_timezone_set('America/Bogota');
    $fechaActual = date('d-m-Y');

    // Primera inserción
    $cadenax = "insert into u116753122_cw3completa.bodegaubcproducto(idproducto,identrepanio,id_orden,cant_recibida,unidadentrada,unidaddetalle,fchvence,nofactura,idempleado,depdestino,op)values('" .
        $id_prod .
        "','" . $entr .
        "','" . $id_orden .
        "','" . $totalc .
        "','" . $unidadentrada .
        "','" . $unidaddetalle .
        "','" . $fchvence .
        "','" . $nofactura .
        "','" . $id_persona .
        "','" . $dep .
        "','-')";
    $resultadox = mysqli_query($conetar, $cadenax);

    // Obtener el ID generado por la primera inserción
    $id_generado = mysqli_insert_id($conetar);
    $num_salida=$id_generado+1;
    // Segunda inserción utilizando el ID generado en la primera inserción
    $cadenax = "insert into u116753122_cw3completa.movi_insumos(num_salida,idproducto,identrepanio,id_origen,id_orden,cant_recibida,unidadentrada,unidaddetalle,nofactura,idempleado,depdestino,fecha_entrega)values(
        '" . $num_salida .
        "','" . $id_prod .
        "','" . $entr .
        "','" . $id_generado . // Utilizamos el ID generado como entrepanio_origen
        "','" . $id_orden .
        "','" . $totalc .
        "','" . $unidadentrada .
        "','" . $unidaddetalle .
        "','" . $nofactura .
        "','" . $id_persona .
        "','" . $dep ."','" . $fechaActual ."')";
    $resultadox = mysqli_query($conetar, $cadenax);

    echo $num_salida;

}
