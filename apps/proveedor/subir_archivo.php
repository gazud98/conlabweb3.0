<?php

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



    $nombrefile = trim($_POST['nombrefile']);
    $descrip = trim($_POST['descrip']);
    $idp = trim($_POST['idp']);
    $rutafile = trim($_POST['rutafile']);

    $cadena = "select valor from u116753122_cw3completa.configuracion where id=1";
    $resultadP2a = $conetar->query($cadena);
    $numerfiles2a = mysqli_num_rows($resultadP2a);
    if ($numerfiles2a >= 1) {
        $filaP2a = mysqli_fetch_array($resultadP2a);
        $valor = trim($filaP2a['valor']);
    }
    $ruta='/proveedor/'.$idp.'/'.$nombrefile;

    $carpetaDestino=$valor.$ruta;
   echo $carpetaDestino;
    if(file_exists($carpetaDestino)){
        move_uploaded_file($rutafile,$carpetaDestino);
    } else{
        @mkdir($carpetaDestino);
        move_uploaded_file($rutafile,$carpetaDestino);
    }
   
   
   
   $cadenax = "insert into u116753122_cw3completa.proveedores_archivo(idproveedor,descripcion,ruta,nombre_archivo)values('". $idp . "','" . $descrip . "','" . $ruta . "','" . $nombrefile . "')";
    $resultado = mysqli_query($conetar, $cadenax);
    $result = "ok";


} 
?>

    
