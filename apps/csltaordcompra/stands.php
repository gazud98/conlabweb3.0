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
        $ide = $_REQUEST['id'];
        if ($ide == "-1") {
            $ide = "";
        }
    } else {
        $ide = 0;
    }
    // $ide = $_REQUEST['id'];
?>

    <label style="font-size: 13px;">Estante</label>
    <select class="form-control" onclick='agregar2(this);' id="stand">
        <option value="0" disabled selected></option>
        <?php

        $cadenax = "SELECT b.id,b.nombre,b.predeterminado
            FROM u116753122_cw3completa.bodegas a, u116753122_cw3completa.bodegastand b
            where  a.id = b.idbodega

            and a.id ='" . $ide . "'";

        $resultadP2ax = $conetar->query($cadenax);
        $numerfiles2ax = mysqli_num_rows($resultadP2ax);
        if ($numerfiles2ax >= 1) {
            while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
                echo "<option value='" . trim($filaP2ax['id']) . "'";
                if (trim($filaP2ax['predeterminado']) == '1') {
                    echo ' selected';
                }
                echo '>' . $filaP2ax['nombre'] . "</option>";
            }
        }
        ?>
    </select>
    <div id="standx">
    </div>
<?php } ?>