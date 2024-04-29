<?php
if (file_exists("../../config/global_config.php")) {
    include("../../config/accesosystems.php");
}
$filterfrom = "";
$filterwhere = "";
// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    /* */
    // $caso=$_REQUEST['caso'];
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        //$id=1;
        // echo $caso.'----'.$id;
        /* */

        $cadena = "SELECT id,fecha, id_proveedor,id_instrumento,instrumento,falla,reparacion, repuesto,tecnico, valor, estado
             FROM u116753122_cw3completa.visitas_tecnicas
             where id='" . $id . "'";


        // echo $cadena;


        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $fecha = $filaP2['fecha'];
            $id_proveedor = $filaP2['id_proveedor'];
            $id_instrumento = $filaP2['id_instrumento'];
            $instrumento = $filaP2['instrumento'];
            $falla = $filaP2['falla'];
            $reparacion = $filaP2['reparacion'];
            $repuesto = $filaP2['repuesto'];
            $tecnico = $filaP2['tecnico'];
            $valor = $filaP2['valor'];
            $estado = $filaP2['estado'];
        }
    } else {
        $id = "";
        $fecha = "";
        $id_proveedor = "";
        $id_instrumento = "";
        $instrumento = "";
        $falla = "";
        $reparacion = "";
        $repuesto = "";
        $tecnico = "";
        $valor = "";
        $estado = "";
    }
?>

    <div class="col-md-12 col-lg-12 p-1" name="iddatas" id="iddatas" style="pointer-events: none;">
        <div class="row bg-light p-2" name="accionejec" id="accionejec" style="text-align:center; font-weight:bold;display:none"></div><?php //Aqui se esceo lo que va a pasar 
                                                                                                                                        ?>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Codigo:</label>
                <input type="input" class="form-control" style="border:thin solid transparent; " disabled name="id" id="id" value="<?php echo $id; ?>"></input>
                <?php if ($estado == '0') {
                    echo "<span style='color:red;'> Inhabilitado</span>";
                } ?>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Fecha:</label>
                <input type="input" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Proveedor:</label>
                <select class="form-control" aria-label="Default select example" name="id_empleado" id="id_empleado">
                    <?php
                    $cadena = "SELECT id_proveedores, nombre_comercial
                                                    FROM u116753122_cw3completa.proveedores
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";
                            if (trim($filaP2a['id_proveedores']) == $id_proveedor) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre_comercial'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3 col-lg-3 ">
                <img src='assets/image/qr.png'>
            </div>
        </div>


        <div class="row mb-2">
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Instrumento:</label>
                <select class="form-control" aria-label="Default select example" name="instrumento" id="instrumento">
                    <?php
                    $cadena = "SELECT id, instrumento
                                                    FROM u116753122_cw3completa.mantenimiento
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_instrumento) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['instrumento'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Falla:</label>
                <input type="input" class="form-control" name="falla" id="falla" value="<?php echo $falla; ?>"></input>
            </div>

            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Reparacion:</label>
                <input type="input" class="form-control" name="reparacion" id="reparacion" value="<?php echo $reparacion; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Repuesto:</label>
                <input type="input" class="form-control" name="repuesto" id="repuesto" value="<?php echo $repuesto; ?>"></input>
            </div>

        </div>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Técnico:</label>
                <input type="input" class="form-control" name="tecnico" id="tecnico" value="<?php echo $tecnico; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Valor:</label>
                <input type="input" class="form-control" name="tecnico" id="tecnico" value="<?php echo $tecnico; ?>"></input>
            </div>
        </div>


    </div>





<?php
}
?>
