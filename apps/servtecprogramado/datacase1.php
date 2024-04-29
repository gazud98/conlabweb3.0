<?php
//si hay consulta
//     presntadio n par todos los departamento

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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');

    //echo '..............................'.$_REQUEST['id'].'...';

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "1"; //esa ctivo fijo
    $fecha = "";
    $id_proveedor = "";
    $id_instrumento = "";
    $falla = "";
    $reparacion = "";
    $repuesto = "";
    $tecnico = "";
    $valor = "";
    $estado = "";


    if ($id != "") {
        $cadena = "select id,fecha,id_proveedor,id_instrumento,falla,reparacion,repuesto,tecnico,valor,estado
                    from u116753122_cw3completa.visitas_tecnicas
                    where id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $fecha = $filaP2['fecha'];
            $id_proveedor = $filaP2['id_proveedor'];
            $id_instrumento = $filaP2['id_instrumento'];
            $falla = $filaP2['falla'];
            $reparacion = $filaP2['reparacion'];
            $repuesto = $filaP2['repuesto'];
            $tecnico = $filaP2['tecnico'];
            $valor = $filaP2['valor'];
            $estado = $filaP2['estado'];
        }
    }

?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


        <div class="row mb-2">

            <div class="col-md-12 col-lg-12 ">
                <div class="row mb-2">
                    <div class="col-md-4 col-lg-4 ">
                        <label style="font-size: 12px;">Codigo:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                        <?php if ($estado == '0') {
                            echo "<span style='color:red;'> Inhabilitado</span>";
                        } ?>
                    </div>
                    <div class="col-md-4 col-lg-4 ">
                        <label style="font-size: 12px;">Fecha:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " name="fecha" id="fecha" value="<?php echo $fecha; ?>"></input>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4 col-lg-4">
                        <label style="font-size: 12px;">Proveedor</label>
                        <select class="form-control" name="id_proveedores" id="id_proveedores">
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
                    <div class="col-md-4 col-lg-4">
                        <label style="font-size: 12px;">Instrumento</label>
                        <select class="form-control" name="id_instrumento" id="id_instrumento">
                            <?php
                            $cadena = "SELECT id_producto, nombre
                                                    FROM u116753122_cw3completa.producto
                                                    where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_producto']) . "'";
                                    if (trim($filaP2a['id_producto']) == $id_instrumento) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label style="font-size: 12px;">Falla</label>
                        <input type="input" class="form-control" name="falla" id="falla" value="<?php echo $falla; ?>"></input>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4 col-lg-4">
                        <label style="font-size: 12px;">Reparacion</label>
                        <input type="input" class="form-control" name="reparacion" id="reparacion" value="<?php echo $reparacion; ?>"></input>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label style="font-size: 12px;">Repuesto</label>
                        <input type="input" class="form-control" name="repuesto" id="repuesto" value="<?php echo $repuesto; ?>"></input>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label style="font-size: 12px;">Tecnico</label>
                        <input type="input" class="form-control" name="tecnico" id="tecnico" value="<?php echo $tecnico; ?>"></input>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Valor</label>
                <input type="input" class="form-control" name="valor" id="valor" value="<?php echo $valor; ?>"></input>
            </div>
        </div>


    </form>


<?php
}
?>