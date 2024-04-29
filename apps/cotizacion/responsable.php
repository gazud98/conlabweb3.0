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
}

if (isset($_REQUEST['idprod'])) {
    $idprod = $_REQUEST['idprod'];
    if ($idprod == "-1") {
        $idprod = "";
    }
} else {
    $idprod = 0;
}

?>
   <label>Responsable</label>
        <input type="input" class="form-control" name="resp" id="resp" value="" disabled></input>