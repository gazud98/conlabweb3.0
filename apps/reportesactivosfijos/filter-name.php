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
<div class="col-md-3">
    <label for="">Nombre:</label>
    <br><select class="form-control nombreactivo" name="nombreactivo" id="nombreactivo">
        <option value="" selected disabled>SELECCIONA:</option>
        <?php

        $cadena = "SELECT p.id_producto,p.referencia,p.lote,p.nombre,p.estado,a.nombre 
            as nombresede FROM cw3completa.producto p INNER JOIN cw3completa.sedes a 
            ON p.id_sede = a.id_sedes WHERE id_categoria_producto = '1';";

        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                $id = trim($filaP2['id_producto']);
                $nombre = $filaP2['nombre'];
        ?>
                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
        <?php
            }
        }
        ?>
    </select>
</div>

<div class="col-md-2" style="margin-top: 25px;">
    <button class="btn btn-info btn-sm">Buscar</button>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.nombreactivo').select2();
    })
</script>