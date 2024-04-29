<?php
$result = "err";

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

    $sql = "SELECT id, descripcion FROM motivos_reprogramar";

    $rest = mysqli_query($conetar, $sql);
}
?>
<label for="">Motivo:</label>
<select class="form-control" name="motivo" id="motivo">
    <option value="" disabled selected>SELECCIONA:</option>
    <?php
    while($data = mysqli_fetch_array($rest)){
        echo '<option value="'.$data['id'].'">'.$data['descripcion'].'</option>';
    }
    ?>
</select>