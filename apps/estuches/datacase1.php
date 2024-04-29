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
    $nombre = "";
    $id_reactivo = "";
    $reactivo = "";
    $descripcion = "";
    $instrumento = "";
    $fecha_apertura = "";
    $fecha_expiracion = "";
    $presentacion = "";
    $no_lote = "";
    $fabricante = "";
    $referencia_fabricante = "";
    $pruebas_nominales = "";
    $valor_reactivo = "";
    $usuario = "";
    $estado = "";


    if ($id != "") {
        $cadena = "select id, id_reactivo,reactivo,descripcion,instrumento,fecha_apertura,fecha_expiracion,presentacion,no_lote,fabricante,
        referencia_fabricante,pruebas_nominales,valor_reactivo,usuario,estado
                    from u116753122_cw3completa.estuches
                    where id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $id_reactivo = trim($filaP2['id_reactivo']);
            $reactivo = trim($filaP2['reactivo']);
            $descripcion = trim($filaP2['descripcion']);
            $instrumento = trim($filaP2['instrumento']);
            $fecha_apertura = trim($filaP2['fecha_apertura']);
            $fecha_expiracion = trim($filaP2['fecha_expiracion']);
            $presentacion = trim($filaP2['presentacion']);
            $no_lote = trim($filaP2['no_lote']);
            $fabricante = trim($filaP2['fabricante']);
            $referencia_fabricante = trim($filaP2['referencia_fabricante']);
            $pruebas_nominales = trim($filaP2['pruebas_nominales']);
            $valor_reactivo = trim($filaP2['valor_reactivo']);
            $usuario = trim($filaP2['usuario']);
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
                    <div class="col-md-2 col-lg-2 ">
                        <label style="font-size: 12px;">Codigo Reactivo:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id_reactivo" id="id_reactivo" value="<?php echo $id_reactivo; ?>"></input>
                        <?php if ($estado == '0') {
                            echo "<span style='color:red;'> Inhabilitado</span>";
                        } ?>
                    </div>
                    <div class="col-md-2 col-lg-2 ">
                        <label style="font-size: 12px;">Codigo Estuche:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " name="id" id="id" value="<?php echo $id; ?>"></input>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <label style="font-size: 12px;">Descripcion</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>"></input>
                    </div>
                </div>

            </div>


        </div>




        <div class="row mb-2">

            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Instrumento:</label>
                <input type="input" class="form-control" name="instrumento" id="instrumento" value="<?php echo $instrumento; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Fecha Apertura:</label>
                <input type="input" class="form-control" name="fecha_apertura" id="fecha_apertura" value="<?php echo $fecha_apertura; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Fecha Expiración:</label>
                <input type="input" class="form-control" name="fecha_expiracion" id="fecha_expiracion" value="<?php echo $fecha_expiracion; ?>"></input>
            </div>

        </div>

        <div class="row mb-2">

            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Presentación:</label>
                <input type="input" class="form-control" name="presentacion" id="presentacion" value="<?php echo $presentacion; ?>"></input>
            </div>
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">No Lote:</label>
                <input type="input" class="form-control" name="no_lote" id="no_lote" value="<?php echo $no_lote; ?>"></input>
            </div>
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Fabricante:</label>
                <input type="input" class="form-control" name="fabricante" id="fabricante" value="<?php echo $fabricante; ?>"></input>
            </div>

        </div>

        <div class="row mb-2">

            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Ref. Fabricante:</label>
                <input type="input" class="form-control" name="referencia_fabricante" id="referencia_fabricante" value="<?php echo $referencia_fabricante; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-43">
                <label style="font-size: 12px;">No Pruebas Nominales:</label>
                <input type="input" class="form-control" name="pruebas_nominales" id="pruebas_nominales" value="<?php echo $pruebas_nominales; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Valor Reactivo:</label>
                <input type="input" class="form-control" name="valor_reactivo" id="valor_reactivo" value="<?php echo $valor_reactivo; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Usuario:</label>
                <input type="input" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario; ?>"></input>
            </div>

        </div>


    </form>


<?php
}
?>