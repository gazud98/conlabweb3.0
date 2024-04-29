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
} else {

    if (isset($_REQUEST['user'])) {
        $user = $_REQUEST['user'];
    }
}
?>

<br><label for="">Asesor(a) comercial:</label>
<select name="aseco" id="aseco" class="form-control">
    <option value="" disabled selected>SELECCIONA:</option>
    <?php
    $sql = "SELECT id_persona, CONCAT(nombre_1,' ',apellido_1) AS nombre FROM persona";
    $rest = mysqli_query($conetar, $sql);
    while ($data = mysqli_fetch_array($rest)) {
    ?>
        <option value="<?php echo $data['id_persona']; ?>"><?php echo $data['nombre']; ?></option>
    <?php
    }
    ?>
</select>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#aseco').select2();
    })
</script>