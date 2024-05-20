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

?>
    <label for="responsable" style="font-size: 11px;">Responsable Tenencia</label>
    <select class="select2" name="responsable" id="responsable" style="width: 100%;">
        <option selected disabled>Selecciona:</option>
        <?php
        $cadena = "SELECT trim(P.id_persona) as id_persona,trim(CONCAT( P.nombre_1,' ',P.nombre_2,' ',P.apellido_1,' ',P.apellido_2)) as nombre 
                    FROM  u116753122_cw3completa.persona P,  u116753122_cw3completa.persona_empleados PE where P.id_persona=PE.id_persona and p.estado = 1;";
        $resultadP2a = $conetar->query($cadena);
        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
            echo "<option value='" . trim($filaP2a['id_persona']) . "'";
            if (trim($filaP2a['id_persona']) == $id) {
                echo ' selected';
            }
            echo '>' . $filaP2a['nombre'] . "</option>";
        }
        ?>
    </select>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                minimumResultsForSearch: 0
            });
        });
    </script>
<?php } ?>