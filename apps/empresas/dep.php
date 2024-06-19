<?php

// echo __FILE__.'>dd.....<br>';
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

<style>
    .select2-container .select2-selection--single {
        font-size: 13px;
        /* Cambia este valor según tus necesidades */
        padding: 2px;
    }

    /* Ajusta el tamaño de la fuente del menú desplegable select2 */
    .select2-container .select2-results__option {
        font-size: 13px;
        /* Cambia este valor según tus necesidades */
    }
</style>

<label style="font-size: 12px;">Departamento:</label>
<select class="form-control" name="dep" id="dep" style="width: 100%;" onchange="loadCities()" required>
    <option selected="true" disabled="disabled"></option>
    <?php
    $cadena33 = "SELECT id, nombre FROM departamento";
    $resultadP2a33 = $conetar->query($cadena33);

    if ($resultadP2a33->num_rows > 0) {
        while ($row = $resultadP2a33->fetch_assoc()) {
            $value = $row['id'];
            $dep_nombre = $row['nombre'];
            $selected = ($departamento == $value) ? 'selected' : '';
            echo "<option value='$value' $selected>$dep_nombre</option>";
        }
    }
    ?>
</select>
<div id="depx"></div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dep').select2();
    })
</script>