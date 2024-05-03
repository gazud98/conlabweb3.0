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


    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());
    $status = $_REQUEST['status'];


  


    if ($status == "D") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $id = $_REQUEST['id'];
        $cadena = "delete  from u116753122_cw3completa.ordrequisicion_temp where id='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);        
    }elseif ($status == "A") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $id_prod = trim(htmlspecialchars($_REQUEST['id_prod']));
        $valor = $_REQUEST['valor'];
        $cadena = "update u116753122_cw3completa.ordrequisicion_temp set cantidad  ='".$valor."' where id_producto='" . $id_prod . "'";
        $resultado = mysqli_query($conetar, $cadena);
    } 
    else {

        date_default_timezone_set('America/Bogota');
        $fechaActual = date('d-m-Y');

        $id_persona = trim(htmlspecialchars($_REQUEST['id_users']));
        $id_prod = trim(htmlspecialchars($_REQUEST['id_producto']));
        $id_sede = trim(htmlspecialchars($_REQUEST['id_sede']));
        $ccosto = trim(htmlspecialchars($_REQUEST['ccosto']));
        $id_departamento = trim(htmlspecialchars($_REQUEST['id_departamento']));
        $cantidad = trim(htmlspecialchars($_REQUEST['cantidad']));
        //   $status = trim(htmlspecialchars($_REQUEST['status']));
        $fecha = $fechaActual;
        $hora = date("h:i:s");

        ////CREACION
        $cadena = "insert into u116753122_cw3completa.ordrequisicion_temp( id_persona,id_producto,id_sede,ccosto,cantidad,id_departamento)values(
            '" . $id_persona .
            "','" . $id_prod .
            "','" . $id_sede .
            "','" . $ccosto .
            "','" . $cantidad .
            "','" . $id_departamento .
            "')";

            echo $cadena;
        $resultado = mysqli_query($conetar, $cadena);

        
    }
}//de hay cneion e bbd
