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
    $idc=$_REQUEST['idc'];
    $fun=$_REQUEST['fun'];
   
    IF ($fun=='R'){
      $cadena = "update u116753122_cw3completa.orden_compra set
              estado_orden='R'
            where id=" . $idc . "";
    $resultado = mysqli_query($conetar, $cadena);
    $result = "ok";
   }else if($fun=='PR'){
    $cadena = "update u116753122_cw3completa.orden_compra set
    estado_orden='PR'
    where id=" . $idc . "";
    $resultado = mysqli_query($conetar, $cadena);
    $result = "ok ";
   }
}
