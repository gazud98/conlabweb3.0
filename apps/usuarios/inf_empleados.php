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

if (isset($_REQUEST['documento'])) {
    $documento = $_REQUEST['documento'];
    if ($documento == "-1") {
        $documento = "";
    }
} else {
    $documento = "";
}
if (isset($_REQUEST['t_iden'])) {
    $t_iden = $_REQUEST['t_iden'];
    if ($t_iden == "-1") {
        $t_iden = "";
    }
} else {
    $t_iden = "";
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $cadenax = "SELECT id_persona,nombre_1, nombre_2, apellido_1, apellido_2
                   FROM persona
                   WHERE documento = '" . $documento . "' and id_tipo_identificacion ='" . $t_iden . "'";
    $resultadP2x = $conetar->query($cadenax);
    $numerfiles2x = mysqli_num_rows($resultadP2x);
    if ($numerfiles2x >= 1) {

        $filaP2ax = mysqli_fetch_array($resultadP2x);
        $id = $filaP2ax['id_persona'];
        $nombre_1 = $filaP2ax['nombre_1'];
        $nombre_2 = $filaP2ax['nombre_2'];
        $apellido_1 = $filaP2ax['apellido_1'];
        $apellido_2 = $filaP2ax['apellido_2'];
    } else {
        $id = "";
        $nombre_1 = "";
        $nombre_2 = "";
        $apellido_1 = "";
        $apellido_2 = "";
    }
}
?>



<input type="input" class="form-control" name="idx" id="idx" value="<?php echo $id; ?>" style="display:none;"
    readonly></input>



<div class="row mb-2" id="infempleado">
    <div class="col-md-3">

        <label style="font-size: 12px;">Primer Nombre:</label>
        <input type="input" class="form-control" name="nombre_1" id="nombre_1" value="<?php echo $nombre_1; ?>"
            readonly></input>
    </div>

    <div class="col-md-3">
        <label style="font-size: 12px;">Segundo Nombre:</label>
        <input type="input" class="form-control" name="nombre_2" id="nombre_2" value="<?php echo $nombre_2; ?> "
            readonly></input>

    </div>

    <div class="col-md-3">
        <label style="font-size: 12px;">Primer Apellido:</label>
        <input type="input" class="form-control" name="apellido_1" id="apellido_1" value="<?php echo $apellido_1; ?>"
            readonly></input>

    </div>
    <div class="col-md-3">
        <label style="font-size: 12px;">Segundo Apellido:</label>
        <input type="input" class="form-control" name="apellido_2" id="apellido_2" value="<?php echo $apellido_2; ?>"
            readonly></input>

    </div>
</div>

<script>
    var id = $("#idx").val();
    $("#id").val(id);
</script>