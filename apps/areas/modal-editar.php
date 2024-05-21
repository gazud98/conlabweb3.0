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
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }
    $cadena = "select id,nombre,id_departamento,estado
    from u116753122_cw3completa.area_laboratorio 
    where id='" . $id . "'";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $nombre = trim($filaP2['nombre']);
        $estado = trim($filaP2['estado']);
        $id_departamento = trim($filaP2['id_departamento']);
    }
?>


    <div class="form-group" style="display: none;">
        <label>Codigo</label>
        <input type="text" class="form-control" name="id" id="idedit" required readonly style="border:none;" value="<?php echo $id ?>">
    </div>
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombredit" required value="<?php echo $nombre ?>">
    </div>
    <div class="form-group">
        <label>Departamento:</label>
        <select class="form-control" name="departamento" id="departamentoedit" style="width: 100%;">
            <option selected disabled required>Selecciona:</option>
            <?php
            $cadena = "SELECT id, nombre FROM departamentos where estado='1'";
            $resultadP2a = $conetar->query($cadena);

            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                echo "<option value='" . trim($filaP2a['id']) . "'";
                if (trim($filaP2a['id']) == $id_departamento) {
                    echo ' selected';
                }
                echo '>' . $filaP2a['nombre'] . "</option>";
            }
            ?>
        </select>
    </div>
    </div>

<?php } ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        $('#departamentoedit').select2();
    });
</script>