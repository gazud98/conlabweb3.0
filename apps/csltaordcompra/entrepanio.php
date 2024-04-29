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
    if (empty($_REQUEST['id'])) {
        $ide = 0;
    } else {
        $ide = $_REQUEST['id'];
    }
?>

    <label style="font-size: 13px;">Entrepaño</label>
    <select class="form-control" onclick='agregar3(this);' id="entrepanio2">
        <option disabled selected></option>
        <?php

        $cadenax = "SELECT b.id,b.nombre
            FROM u116753122_cw3completa.bodegastand a, u116753122_cw3completa.bodegaentrepanio b
            where  a.id = b.idstand

            and a.id ='" . $ide . "'";

        $resultadP2ax = $conetar->query($cadenax);
        $numerfiles2ax = mysqli_num_rows($resultadP2ax);
        if ($numerfiles2ax >= 1) {
            while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
                echo "<option value='" . trim($filaP2ax['id']) . "'";
                echo '>' . $filaP2ax['nombre'] . "</option>";
            }
        }
        ?>
    </select>
    <div id="entrepanio2x">
    </div>
<?php } ?>