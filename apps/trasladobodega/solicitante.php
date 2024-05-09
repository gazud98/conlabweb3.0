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
    if (isset($_REQUEST['idd'])) {
        $idd = $_REQUEST['idd'];

        if ($idd == "-1") {
            $idd = "";
        }
    } else {
        $idd = 0;
    }
}
?>

<label style="font-size:13px">Solicitante</label>
<select class="form-control" style="font-size:13px">
    <option selected="true" disabled="disabled"></option>
    <?php
    $cadena = "SELECT b.id_departamento, a.nombre_1,a.nombre_2,a.apellido_1,a.apellido_2
    FROM u116753122_cw3completa.persona a, u116753122_cw3completa.persona_empleados b
    where a.id_persona = b.id_persona 
    and b.id_departamento =".$idd;
    $resultadP2a = $conetar->query($cadena);
    $numerfiles2a = mysqli_num_rows($resultadP2a);
    if ($numerfiles2a >= 1) {
        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {

            echo "<option value='" . trim($filaP2a['id_persona']) . "'";
            echo '>' . $filaP2a['nombre_1'] . " " . $filaP2a['nombre_2'] . " " . $filaP2a['apellido_1'] . " " . $filaP2a['apellido_2'] . "</option>";
        }
    }
    ?>
</select>
<input type="input" class="form-control" name="idd" id="idd" value="<?php echo $idd ?>" style="display:none"></input>
<script>
    var idd = $("#idd").val();
  
</script>