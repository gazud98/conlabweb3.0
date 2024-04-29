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

    $id_modu = "";

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "0";
    }

    $cadena33 = "SELECT id_modulo FROM roles where id='" . $id . "'";
    $resultadP2a33 = $conetar->query($cadena33);
    $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
    if ($numerfiles2a33 >= 1) {
        while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
            $id_modu = trim($filaP2a33['id_modulo']);

        }
    }




    ?>

    <div class="form-group" style="height: 200px; overflow-y: auto;" id="checkboxList">
        <label>Módulos:</label><br>
        <?php
        $cadena33 = "SELECT id_modulos, name FROM modulos where estado =1";
        $resultadP2a33 = $conetar->query($cadena33);
        $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
        $idsGuardados = explode(',', $id_modu);
        if ($numerfiles2a33 >= 1) {
            while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                $id_modulos = trim($filaP2a33['id_modulos']);
                $name = $filaP2a33['name'];

                $checked = in_array($id_modulos, $idsGuardados) ? 'checked' : '';
                $disabled = 'disabled'; // Todos los checkboxes están deshabilitados inicialmente
    
                ?>
                <div class="form-check">
                    <input type="checkbox" style="font-size: 12px;" class="form-check-input" name="regimen[]"
                        value="<?= $id_modulos ?>" id="checkreg<?= $id_modulos ?>" <?= $checked ?>             <?= $disabled ?>>
                    <label style="font-size: 12px;" class="form-check-label" for="checkreg<?= $id_modulos ?>">
                        <?= $name ?>
                    </label>
                </div>
                <?php
            }
        }
        ?>
    </div>



<?php } ?>