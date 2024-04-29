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
    $cadena = "select id,motivo_costo ,valor
from u116753122_cw3completa.costo_indirecto 
where id='" . $id . "'";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $motivo_costo = trim($filaP2['motivo_costo']);
        $valor = trim($filaP2['valor']);
    }
?>
    <div class="form-group">
        <label>Codigo</label>
        <input type="text" class="form-control" name="idcod" id="idcod" required readonly style="border:none;" value="<?php echo $id ?>">
    </div>
    <div class="form-group">
        <label>Motivo Costo</label>
        <input type="text" class="form-control" name="motivo_costo" id="motivo_costo" required value="<?php echo $motivo_costo ?>">
    </div>
    <div class="form-group">
        <label>Valor</label>
        <input type="text" class="form-control" name="valor" id="valor" required value="<?php echo $valor ?>">
    </div>

<?php } ?>