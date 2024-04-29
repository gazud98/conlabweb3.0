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
    $cadena = "select id,cargo,tiempo ,salario
from u116753122_cw3completa.mano_obra 
where id='" . $id . "'";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $cargo = trim($filaP2['cargo']);
        $tiempo = trim($filaP2['tiempo']);
        $salario = trim($filaP2['salario']);
    }
?>
    <div class="form-group">
        <label>Codigo</label>
        <input type="text" class="form-control" name="idmano" id="idmano" required readonly style="border:none;" value="<?php echo $id ?>">
    </div>
    <div class="form-group">
        <label>Cargo</label>
        <input type="text" class="form-control" name="cargo" id="cargo" required value="<?php echo $cargo ?>">
    </div>
    <div class="form-group">
        <label>Tiempo</label>
        <input type="text" class="form-control" name="tiempo" id="tiempo" required value="<?php echo $tiempo ?>">
    </div>
    <div class="form-group">
        <label>Salario</label>
        <input type="text" class="form-control" name="salario" id="salario" required value="<?php echo $salario ?>">
    </div>

<?php } ?>