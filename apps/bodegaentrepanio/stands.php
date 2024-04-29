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


?>

    <label>Stands</label>
    <select class="form-control"  id="id_stands" name="id_stands" onchange='agregar2(this);'>
        <option selected="true" disabled="disabled"></option>
        <?php

        $cadenax = "SELECT b.id,b.nombre
            FROM u116753122_cw3completa.bodegas a, u116753122_cw3completa.bodegastand b
            where  a.id = b.idbodega

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
    
<?php } ?>

<script>
    
    function agregar2(sel) {
        var id = $('option:selected', sel).attr('value');
      
        $("#id_standd").val(id);

    };
</script>