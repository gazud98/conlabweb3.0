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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {



    include('reglasdenavegacion.php');


    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
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
    $sol = trim($_POST['sol']);
    $total = trim($_POST['total']);
    $totalc = -1* $cant;
    date_default_timezone_set('America/Bogota');
    $fechaActual = date('d-m-Y');

  /*  $cadena = "insert into u116753122_cw3completa.bodegaubcproducto(idproducto,idpadre,identrepanio,id_orden,cant_recibida,unidadentrada,unidaddetalle,fchvence,nofactura,op)values('" .
        $id_prod .
        "','" . $idpe .
        "','" . $identre .
        "','" . $id_orden .
        "','" . $cant .
        "','" . $unidadentrada .
        "','" . $unidaddetalle .
        "','" . $fchvence .
        "','" . $nofactura .
        "','+')";
    $resultado = mysqli_query($conetar, $cadena);*/



    $cadenax = "insert into u116753122_cw3completa.movi_insumos(idproducto,identrepanio,id_orden,cant_recibida,unidadentrada,unidaddetalle,nofactura,idempleado,depdestino,fecha_entrega)values(
        '" . $id_prod .
        "','" . $entr .
        "','" . $id_orden .
        "','" . $totalc .
        "','" . $unidadentrada .
        "','" . $unidaddetalle .
        "','" . $nofactura .
        "','" . $sol .
        "','" . $dep ."','" . $fechaActual ."')";
    $resultadox = mysqli_query($conetar, $cadenax);
    
    echo $cadenax;
    echo $resultadox;
    
    
}







