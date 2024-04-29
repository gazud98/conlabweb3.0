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
    $status = $_REQUEST['status'];


    $id = $_REQUEST['id'];


    if ($status == "D") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $cadena = "delete  from cotizacion_insumos where id='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
    } else {

        date_default_timezone_set('America/Bogota');
        $fechaActual = date('Y-d-m');
        $id_req = trim(htmlspecialchars($_REQUEST['id_req']));
        $id_prod = trim(htmlspecialchars($_REQUEST['id_producto']));
        if (isset($_REQUEST['id_proveedor'])) {
            $idprovee = $_REQUEST['id_proveedor'];
            if ($idprovee == "-1") {
                $idprovee = "";
            }
        } else {
            $idprovee = 0;
        }
      //  $idprovee = trim(htmlspecialchars($_REQUEST['id_proveedor']));
        $cantidad = trim(htmlspecialchars($_REQUEST['cantidad']));
        //   $status = trim(htmlspecialchars($_REQUEST['status']));
        $fecha = $fechaActual;
        $hora = date("h:i:s");


        if (!$idprovee==0) {
            $cadenx = "insert into cotizacion_insumos(id_proveedor,id_producto,cantidad,fecha,hora,norequisicion,estado_cot,estado)values(
                '" . $idprovee .
                "','" . $id_prod .
                "','" . $cantidad .
                "','" . $fecha .
                "','" . $hora .
                "','" . $id_req .
                "','P','1')";
            $resultado = mysqli_query($conetar, $cadenx);

            ////CREACION
        }
    }
}//de hay cneion e bbd
