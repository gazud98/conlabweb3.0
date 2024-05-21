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
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    if ($id == "-1") {
        $id = "";
    }
} else {
    $id = 0;
}
?>
<label style="font-size:13px">Estante</label>
<select class="form-control" id="std" onchange="agregar2(this)" style="font-size:13px;width:100%">
    <option selected="true" disabled="disabled"></option>
    <?php

    $cadenax = "SELECT b.id,b.nombre,b.predeterminado
                               FROM u116753122_cw3completa.bodegas a, u116753122_cw3completa.bodegastand b
                               where  a.id = b.idbodega
                               and    b.idbodega=" . $id;

    $resultadP2ax = $conetar->query($cadenax);
    $numerfiles2ax = mysqli_num_rows($resultadP2ax);
    if ($numerfiles2ax >= 1) {
        while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
            echo "<option value='" . trim($filaP2ax['id']) . "'";
            echo '>' . $filaP2ax['nombre'] . "</option>";
        }
    }
    ?>
</select>
<div id="stdx"></div>
<script>
    $(document).ready(function() {
        $('#std').select2({
            language: "es"
        });
    });
</script>