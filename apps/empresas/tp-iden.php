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
<label for="">Tipo Identificación:</label>
<select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion" style="width: 100%;" required>
    <option selected= disabled>SELECCIONA:</option>
    <?php

    $sql = "SELECT id, nombre, abreviatura FROM tipo_identificacion";

    $rest = mysqli_query($conetar, $sql);

    while ($data = mysqli_fetch_array($rest)) {

    ?>

        <option value="<?php echo $data['id']; ?>"><?php echo $data['abreviatura'] . ' - ' . $data['nombre']; ?></option>

    <?php
    }
    ?>
</select>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#id_tipo_identificacion').select2({
            language: "es"
        });
    })
</script>