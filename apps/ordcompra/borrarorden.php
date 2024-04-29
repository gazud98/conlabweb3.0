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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

//echo '.......<br>'.'...'.hostname.','.db_login.','.cw3ctrlsrv.'???'.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
   
    $id_prove = $_REQUEST['id_prov'];
    $id_prod = $_REQUEST['id_prod'];
    $numcotiza = $_REQUEST['numcotiza'];
    $cadena = "DELETE  FROM u116753122_cw3completa.orden_compratemp where id_proveedor=".$id_prove." AND id_producto=". $id_prod;
    $resultado = mysqli_query($conetar, $cadena);   
    $cadena2 = "UPDATE  u116753122_cw3completa.cotizacion_insumos SET estado_cot='PO' where id=".$numcotiza;
    $resultado2 = mysqli_query($conetar, $cadena2);  
}
 
 ?>