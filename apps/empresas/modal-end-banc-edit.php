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

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $sql = "SELECT id_entidades_bancarias, descripcion, puc, estado FROM entidades_bancarias WHERE id_entidades_bancarias = '$id'";

    $rest = mysqli_query($conetar, $sql);

    while ($element = mysqli_fetch_array($rest)) {
        $id_entidades_bancarias = trim($element['id_entidades_bancarias']);
        $descripcion = trim($element['descripcion']);
        $puc = trim($element['puc']);
        $estado = trim($element['estado']);
    }
}

?>

<input type="hidden" name="id" value="<?php echo $id_entidades_bancarias; ?>">
<div class="col-md-12">
    <label for="">Descripción:</label>
    <input class="form-control" type="text" name="desc" id="desc" value="<?php echo $descripcion; ?>" required>
</div>
<br>
<div class="col-md-12">
    <label for="">PUC</label>
    <input class="form-control" type="text" name="puc" id="puc" value="<?php echo $puc; ?>" required>
</div>
<br>
<div class="col-md-12">
    <label for="">Estado:</label>
    <select class="form-control" name="estado" id="estado" required>
        <?php

        if ($estado == 1) {

        ?>
            <option value="1" selected>Activo</option>
            <option value="2">Inactivo</option>
        <?php

        } else if ($estado == 2) {

        ?>
            <option value="1">Activo</option>
            <option value="2" selected>Inactivo</option>
        <?php
        }
        ?>
    </select>
</div>
