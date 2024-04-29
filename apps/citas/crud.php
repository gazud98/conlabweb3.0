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

    $id = 0;

    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }

    $fecha = $_REQUEST['fecha'];
    $hora = $_REQUEST['hora'];
    $vendedor = $_REQUEST['vendedor'];
    $nombrecontacto = $_REQUEST['nombrecontacto'];
    $celularcontacto = $_REQUEST['celularcontacto'];
    $emailcontacto = $_REQUEST['emailcontacto'];
 
    $cadena = "UPDATE citas SET fecha='$fecha', hora='$hora', vendedor='$vendedor', nombre_contacto='$nombrecontacto',
    celular_contacto='$celularcontacto', email_contacto='$emailcontacto' WHERE id = '$id'";
    $resultado = mysqli_query($conetar, $cadena);

    $rest = mysqli_query($conetar, $cadena);
    
}

?>