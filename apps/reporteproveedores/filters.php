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
}
?>
<div class="row">
    <div class="col-md-2">
        <label for="">Departamento:</label>
        <select name="dep" id="dep" class="form-control">
            <option value="" selected disabled>SELECCIONA:</option>
            <?php
            $sql = "SELECT id, nombre FROM departamentos";
            $rest = mysqli_query($conetar, $sql);
            while($data = mysqli_fetch_array($rest)){
            ?>
            <option value="<?php echo $data['id']; ?>"><?php echo $data['nombre']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-2">
        <label for="">Departamento:</label>
        <select name="cat" id="cat" class="form-control">
            <option value="" selected disabled>SELECCIONA:</option>
            <?php
            $sql = "SELECT id_categoria_producto, nombre FROM categoria_producto";
            $rest = mysqli_query($conetar, $sql);
            while($data = mysqli_fetch_array($rest)){
            ?>
            <option value="<?php echo $data['id_categoria_producto']; ?>"><?php echo $data['nombre']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-2" style="margin-top: 28px;">
        <button type="button" class="btn btn-info btn-sm" id="btnSearh">Buscar</button>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#dep').select2();
        $('#cat').select2();
    })
</script>