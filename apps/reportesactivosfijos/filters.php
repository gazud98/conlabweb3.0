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
<div class="row border  mb-4">
    <div class="col-md-2">
        <label for="sedefiltro"  style="font-size:14px;">Filtrar por Sede:</label>
        <select name="sedefiltro" id="sedefiltro" class="form-control"  style="font-size:14px;">
            <option value="" selected disabled></option>
            <?php
            $sql = "SELECT id_sedes, nombre FROM sedes";
            $rest = mysqli_query($conetar, $sql);
            while ($data = mysqli_fetch_array($rest)) {
            ?>
                <option value="<?php echo $data['id_sedes']; ?>"><?php echo $data['nombre']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-2">
        <label for="estadofiltro"  style="font-size:14px;"> Filtrar por Estado:</label>
        <select name="estadofiltro" id="estadofiltro" class="form-control"  style="font-size:14px;">
            <option value="" selected disabled></option>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
        </select>
    </div>
    <div class="col-md-2" style="margin-top: 25px;">
        <button type="button" class="btn btn-info btn-sm" onclick="loadFilters()"><i class="fa-solid fa-magnifying-glass"></i> &nbsp; Buscar</button>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#sedefiltro').select2();
        $('#estadofiltro').select2();
    });

    function loadFilters() {
        miDataTableReporte1.ajax.reload();
    }
</script>