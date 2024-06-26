<?php
//Si bahy consulta

// echo __FILE__.'>dd.....<br>';
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


//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $fecha = $_REQUEST['fecha'];
    $hora = $_REQUEST['hora'];
    $vendedor = $_REQUEST['vendedor'];
    $nombrecontacto = $_REQUEST['nombrecontacto'];
    $celularcontacto = $_REQUEST['celularcontacto'];
    $emailcontacto = $_REQUEST['emailcontacto'];
    $empresa = $_REQUEST['empresa'];
    $medico = $_REQUEST['medico'];
 
    $cadena = "insert into citas(fecha,hora,vendedor,empresa,medico,nombre_contacto,celular_contacto,email_contacto)values('" . $fecha .
        "','" . $hora . "','".$vendedor."','".$empresa."','".$medico."','".$nombrecontacto."','".$celularcontacto."','".$emailcontacto."')";
    $resultado = mysqli_query($conetar, $cadena);

    //iniciar negociación

    $sql = "INSERT INTO negociaciones(empresa, medico, fechainicio, estado) 
    VALUES('$empresa', '$medico', '$fecha', '1')";
    $rest = mysqli_query($conetar, $sql);
    
}

?>