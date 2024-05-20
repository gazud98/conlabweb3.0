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
    // $ide = $_REQUEST['id'];
?>
    <label for="nuevo_campo" style="font-size: 11px;">Area</label>
    <select class="form-control" name="area" id="area" style="width: 100%;">

        <?php
        $cadena = "SELECT id, nombre FROM area_laboratorio where estado='1' and id_departamento=" . $id . "";
        $resultadP2a = $conetar->query($cadena);
        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
            echo "<option value='" . trim($filaP2a['id']) . "'";

            echo '>' . $filaP2a['nombre'] . "</option>";
        }
        ?>
    </select>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#area').select2({
                minimumResultsForSearch: 0
            });
        });
    </script>
<?php } ?>