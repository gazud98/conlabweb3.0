<?php
//     presntadio n par todos lod produtos tipo producro en genral
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
    if (isset($_REQUEST['status'])) {
        $status = $_REQUEST['status'];
        if ($status == "-1") {
            $status = "";
        }
    } else {
        $status = 0;
    }
    if (isset($_REQUEST['estado'])) {
        $estado = $_REQUEST['estado'];
        if ($estado == "-1") {
            $estado = "";
        }
    } else {
        $estado = 0;
    }
    //echo '..............................'.$_REQUEST['id'].'...';
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }
    $GLOBALS['id'] = $id;

    //$id=1;
    // echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "3"; //es un PRODUCTO
    $referencia = "";
    $nombre = "";
    $id_departamento = "";
    $estado = "";
    $cantidad_presentacion = "";
    $id_presentacion = "";
    $cantidad_unidadmedida = "";
    $id_unidadmedida = "";
    $id_clasificacion_riesgo = "";
    $nombre_imagen = "";
    $id_bodegas = "";
    $id_departamento = "";
    $stckmin = "";
    $stckpntoreorden = "";
    $stckmax = "";
    $csmoprommes = "";
    $id_condicion_almacenaje = "";
    $cod_contable = "";
    $categoria = "";
    $principio_activo =  "";
    $forma_farmaceutica =  "";
    $vida_util =  "";
    $lote =  "";
    $marca = "";
    $serie =  "";
    $fecha_vencimiento =  "";
    $concentracion =  "";
    $reg_invima =  "";
    $tipo_prod =  "";
    $iva =  "";
    if ($id != 0) {
        $cadena = "select P.id_producto,P.referencia,P.id_categoria_producto,P.nombre,id_departamento,P.estado,
                        P.cantidad_presentacion,P.id_presentacion,P.cantidad_unidadmedida,P.id_unidadmedida,
                        P.id_clasificacion_riesgo,P.nombre_imagen,P.id_bodegas,P.id_departamento,
                        P.stckmin,P.stckpntoreorden,P.stckmax,P.csmoprommes,P.id_condicion_almacenaje,P.cod_contable,P.categoria,P.principio_activo,P.forma_farmaceutica,
                        P.vida_util,P.lote,P.marca,P.serie,P.fecha_vencimiento,P.concentracion,P.reg_invima,P.tipo_prod,P.iva
                    from producto P
                    where P.id_producto='" . $id . "'";
        //                 echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = "3"; //es un producto
            $referencia = trim($filaP2['referencia']);
            $nombre = trim($filaP2['nombre']);
            $id_departamento = trim($filaP2['id_departamento']);
            $estado = trim($filaP2['estado']);
            $cantidad_presentacion = trim($filaP2['cantidad_presentacion']);
            $id_presentacion = trim($filaP2['id_presentacion']);
            $cantidad_unidadmedida = trim($filaP2['cantidad_unidadmedida']);
            $id_unidadmedida = trim($filaP2['id_unidadmedida']);
            $id_clasificacion_riesgo = trim($filaP2['id_clasificacion_riesgo']);
            $nombre_imagen = trim($filaP2['nombre_imagen']);
            $id_bodegas = trim($filaP2['id_bodegas']);
            $id_departamento = trim($filaP2['id_departamento']);
            $stckmin = trim($filaP2['stckmin']);
            $stckpntoreorden = trim($filaP2['stckpntoreorden']);
            $stckmax = trim($filaP2['stckmax']);
            $csmoprommes = trim($filaP2['csmoprommes']);
            $id_condicion_almacenaje = trim($filaP2['id_condicion_almacenaje']);
            $cod_contable = trim($filaP2['cod_contable']);
            $categoria = trim($filaP2['categoria']);
            $principio_activo = trim($filaP2['principio_activo']);
            $forma_farmaceutica = trim($filaP2['forma_farmaceutica']);
            $vida_util = trim($filaP2['vida_util']);
            $lote = trim($filaP2['lote']);
            $marca = trim($filaP2['marca']);
            $serie = trim($filaP2['serie']);
            $fecha_vencimiento = trim($filaP2['fecha_vencimiento']);
            $concentracion = trim($filaP2['concentracion']);
            $reg_invima = trim($filaP2['reg_invima']);
            $tipo_prod = trim($filaP2['tipo_prod']);
            $iva = trim($filaP2['iva']);
        }
    }

?>

    <style>
        .formcontrol2 {
            display: block;
            width: 100%;
            height: 65%;
            font-size: 12px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #AFAFAF !important;
            border-radius: 0.25rem;
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .table-txt-order {
            width: 100%;
        }

        .table-txt-order tr,
        tr td {
            width: 80px;
            padding-left: 10px;
        }
    </style>

    <form name="formcontrol2" id="formcontrol2" action="" method="POST" enctype="multipart/form-data" style="
    width:100%;
    padding: 0px 30px 10px  30px; ">
        <input type="hidden" name="modeeditstatus1" id="modeeditstatus1" value="">
        <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="3">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
        <input type="hidden" name="tipprod" id="tipprod" value="I">

        <div class="row mb-2">
            <table class="table-txt-order">
                <tr>
                    <td>
                        <?php
                        $parametroacodificar = "Codigo: " . $id . "\nReferencia: " . $referencia . "\nNombre: " . $nombre;


                        ?>
                        <div id="codeqr">

                        </div>


                    </td>



                    <td><label style="font-size: 12px;">Codigo:</label>
                        <input type="input" class="formcontrol" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>

                    </td>
                    <td>
                        <label style="font-size: 12px;">Referencia:</label>
                        <input type="input" class="formcontrol" name="referencia" name="referencia" id="referencia" value="<?php echo $referencia; ?>"></input>
                        <div id="referenciax"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Codigo Contable:</label>
                        <input type="input" class="formcontrol" name="cod_contable" id="cod_contable" value="<?php echo $cod_contable; ?>"></input>
                        <div id="cod_contablex"></div>
                    </td>
                </tr>
            </table>


        </div>


        <div class="row">

            <table class="table-txt-order">

                <tr>
                    <td>
                        <label style="font-size: 12px;">Nombre:</label>
                        <input type="input" class="formcontrol" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                        <div id="nombrex"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Departamento</label>

                        <select class="formcontrol" name="id_departamento" id="id_departamento">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT id, nombre
                                    FROM u116753122_cw3completa.departamentos
                                    where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id']) . "'";
                                    if (trim($filaP2a['id']) == $id_departamento) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="id_departamentox"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">IVA:</label>
                        <input type="number" class="formcontrol" name="iva" id="iva" value="<?php echo $iva; ?>"></input>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row pb-2">

            <table class="table-txt-order">
                <tr>
                    <td>
                        <label style="font-size: 12px;">Unidad:</label>
                        <input type="input" class="formcontrol" name="cantidad_unidadmedida" id="cantidad_unidadmedida" value="<?php echo $cantidad_unidadmedida; ?>"></input>
                        <div id="cantidad_unidadmedidax"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;"></label>
                        <select class="formcontrol" name="id_unidadmedida" id="id_unidadmedida">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT um.id,um.nombre, um.simbolo
                                                            FROM u116753122_cw3completa.unidad_medida um
                                                            where um.estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id']) . "'";
                                    if (trim($filaP2a['id']) == $id_unidadmedida) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="id_unidadmedidax"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Presentacion:</label>
                        <input type="input" class="formcontrol" name="cantidad_presentacion" id="cantidad_presentacion" value="<?php echo $cantidad_presentacion; ?>"></input>
                        <div id="cantidad_presentacionx"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;"></label>
                        <select class="formcontrol" name="id_presentacion" id="id_presentacion">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT UM.id,UM.nombre
                                                        FROM u116753122_cw3completa.unidad_medida UM
                                                        where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id']) . "'";
                                    if (trim($filaP2a['id']) == $id_presentacion) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="id_presentacionx"></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row" style="border:1px dotted black;padding:5px;">

            <table class="table-txt-order">

                <tr>
                    <td>


                        <label style="font-size: 12px;">Stock Minimo:</label>
                        <input type="input" class="formcontrol" name="stckmin" id="stckmin" value="<?php echo $stckmin; ?>"></input>
                        <div id="stckminx"></div>

                    </td>
                    <td>

                        <label style="font-size: 12px;">Punto de Reorden:</label>
                        <input type="input" class="formcontrol" name="stckpntoreorden" id="stckpntoreorden" value="<?php echo $stckpntoreorden; ?>"></input>
                        <div id="stckpntoreordenx"></div>

                    </td>
                    <td>

                        <label style="font-size: 12px;">Stock Maximo:</label>
                        <input type="input" class="formcontrol" name="stckmax" id="stckmax" value="<?php echo $stckmax; ?>"></input>
                        <div id="stckmaxx"></div>

                    </td>
                    <td>

                        <label style="font-size: 12px;">Consumo :</label>
                        <input type="input" class="formcontrol" name="csmoprommes" id="csmoprommes" readonly value="<?php echo $csmoprommes; ?>"></input>
                    </td>
                    <?php
                    $cadenax =  "SELECT MIN(fchvence) as fchvence 
            FROM u116753122_cw3completa.bodegaubcproducto 
            where idproducto = '" . $id . "' and identrepanio <>0";

                    $resultadP2ax = $conetar->query($cadenax);
                    $numerfiles2ax = mysqli_num_rows($resultadP2ax);
                    if ($numerfiles2ax >= 1) {
                        while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
                            $fchvence = trim($filaP2ax['fchvence']);
                        }
                    } else {
                        $fchvence = "";
                    }
                    ?>

                    <td >

                        <label style="font-size: 12px;">F. Vence Producto en Bodega:</label>
                        <input type="input" class="formcontrol" name="fvence" id="fvence" readonly value="<?php echo $fchvence; ?>"></input>

                
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">

            <table class="table-txt-order">
                <tr>
                    <td>
                        <label style="font-size: 12px;">Nivel de Riesgo:</label>
                        <select class="formcontrol" aria-label="Default select example" name="id_clasificacion_riesgo" id="id_clasificacion_riesgo">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT id_clasificacion_riesgo, descripcion
                                                    FROM u116753122_cw3completa.clasificacion_riesgo
                                                    where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_clasificacion_riesgo']) . "'";
                                    if (trim($filaP2a['id_clasificacion_riesgo']) == $id_clasificacion_riesgo) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['descripcion'];
                                    echo "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="id_clasificacion_riesgox"></div>

                    </td>
                    <td>
                        <label style="font-size: 12px;">Condiciones de Almacenamiento:</label>
                        <select class="formcontrol" aria-label="Default select example" name="id_condicion_almacenaje" id="id_condicion_almacenaje">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT id_condicion_almacenaje, descripcion
                                                    FROM u116753122_cw3completa.condicion_almacenaje
                                                    where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_condicion_almacenaje']) . "'";
                                    if (trim($filaP2a['id_condicion_almacenaje']) == $id_condicion_almacenaje) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['descripcion'];
                                    echo "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="id_condicion_almacenajex"></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row mt-2">

            <table class="table-txt-order">

                <tr>
                    <td>
                        <label style="font-size: 12px;">Vida Util:</label>
                        <input type="input" class="formcontrol" name="vida_util" id="vida_util" value="<?php echo $vida_util; ?>"></input>
                        <div id="vida_utilx"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Lote:</label>
                        <input type="input" class="formcontrol" name="lote" id="lote" value="<?php echo $lote; ?>"></input>
                        <div id="lotex"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Marca:</label>
                        <input type="input" class="formcontrol" name="marca" id="marca" value="<?php echo $marca; ?>"></input>
                        <div id="marcax"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Serie:</label>
                        <input type="input" class="formcontrol" name="serie" id="serie" value="<?php echo $serie; ?>"></input>
                        <div id="seriex"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Reg Invima:</label>
                        <input type="input" class="formcontrol" name="reg_invima" id="reg_invima" value="<?php echo $reg_invima; ?>"></input>
                       
                    </td>
                </tr>

            </table>

        </div>
        <div class="row mt-2">

            <table class="table-txt-order">

                <tr>
                    <td>
                        <label style="font-size: 12px;">Concentracion:</label>
                        <input type="input" class="formcontrol" name="concentracion" id="concentracion" value="<?php echo $concentracion; ?>"></input>
                        <div id="concentracionx"></div>
                    </td>

                </tr>

            </table>
        </div>





    </form>



<?php
}
?>



<script>
    function savedata() {
        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/producto/crud.php',
            data: $('#formcontrol2').serialize(),
            success: function(respuesta) {
                cargarDatos();
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: '¡Registro Exitoso!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });



        inhabilitacmpos();
    } //de alvar datos

    $(document).ready(function() {
        $('#cancelbtn').click(function() {
            $("#referencia").css("border", "thin solid rgb(233,236,239)");
            $("#referenciax").empty();
            $("#nombre").css("border", "thin solid rgb(233,236,239)");
            $("#nombrex").empty();
            $("#id_departamento").css("border", "thin solid rgb(233,236,239)");
            $("#id_departamentox").empty();
            $("#cantidad_unidadmedida").css("border", "thin solid rgb(233,236,239)");
            $("#cantidad_unidadmedidax").empty();
            $("#id_unidadmedida").css("border", "thin solid rgb(233,236,239)");
            $("#id_unidadmedidax").empty();
            $("#cantidad_presentacion").css("border", "thin solid rgb(233,236,239)");
            $("#cantidad_presentacionx").empty();
            $("#id_presentacion").css("border", "thin solid rgb(233,236,239)");
            $("#id_presentacionx").empty();
            /* $("#stckmin").css("border", "thin solid rgb(233,236,239)");
             $("#stckminx").empty();
             $("#stckpntoreorden").css("border", "thin solid rgb(233,236,239)");
             $("#stckpntoreordenx").empty();
             $("#stckmax").css("border", "thin solid rgb(233,236,239)");
             $("#stckmaxx").empty();*/
            $("#id_clasificacion_riesgo").css("border", "thin solid rgb(233,236,239)");
            $("#id_clasificacion_riesgox").empty();
            $("#id_condicion_almacenaje").css("border", "thin solid rgb(233,236,239)");
            $("#id_condicion_almacenajex").empty();
        });
    });
</script>