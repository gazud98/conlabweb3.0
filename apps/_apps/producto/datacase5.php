<?php
//     presntadio n par todos lod produtos tipo insumo
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
    // echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "5"; //es un Insumo
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

    $id_departamento = "";
    $stckmin = "";
    $stckpntoreorden = "";
    $stckmax = "";
    $csmoprommes = "";
    $id_condicion_almacenaje = "";
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



    if ($id != "") {
        $cadena = "select P.id_producto,P.referencia,P.id_categoria_producto,P.nombre,id_departamento,P.estado,
                        P.cantidad_presentacion,P.id_presentacion,P.cantidad_unidadmedida,P.id_unidadmedida,
                        P.id_clasificacion_riesgo,P.nombre_imagen,P.id_bodegas,P.id_departamento,
                        P.stckmin,P.stckpntoreorden,P.stckmax,P.csmoprommes,P.id_condicion_almacenaje,P.categoria,P.principio_activo,P.forma_farmaceutica,
                        P.vida_util,P.lote,P.marca,P.serie,P.fecha_vencimiento,P.concentracion,P.reg_invima
                    from u116753122_cw3completa.producto P
                    where P.id_producto='" . $id . "'";
        //                 echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = "5";
            $referencia = trim($filaP2['referencia']);
            $nombre = trim($filaP2['nombre']);
            $id_departamento = trim($filaP2['id_departamento']);
            $estado = trim($filaP2['estado']);
            $cantidad_presentacion = trim($filaP2['cantidad_presentacion']);
            $id_presentacion = trim($filaP2['id_presentacion']);
            $cantidad_unidadmedida = trim($filaP2['cantidad_unidadmedida']);
            $id_unidadmedida = trim($filaP2['id_unidadmedida']);
            $id_clasificacion_riesgo = trim($filaP2['id_clasificacion_riesgo']);

            $id_departamento = trim($filaP2['id_departamento']);
            $stckmin = trim($filaP2['stckmin']);
            $stckpntoreorden = trim($filaP2['stckpntoreorden']);
            $stckmax = trim($filaP2['stckmax']);
            $csmoprommes = trim($filaP2['csmoprommes']);
            $id_condicion_almacenaje = trim($filaP2['id_condicion_almacenaje']);
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
        }
    }


?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="5">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">

        <div class="row mb-2">
            <div class="col-md-3 col-lg-3 ">
                <?php
                if ($id != "") {
                    $parametroacodificar = "Codigo: " . $id . "\nReferencia: " . $referencia . "\nNombre: " . $nombre;
                    include('../../apps/genqr.php');
                } else {
                    echo "<img src='assets/image/qr.png'>";
                }
                ?>
            </div>
            <div class="col-md-9 col-lg-9 ">
                <div class="row mb-2">
                    <div class="col-md-6 col-lg-6 ">
                        <label style="font-size: 12px;">Codigo:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                        <?php if ($estado == '0') {
                            echo "<span style='color:red;'> Inhabilitado</span>";
                        } ?>
                    </div>
                    <div class="col-md-6 col-lg-6 ">
                        <label style="font-size: 12px;">Referencia:</label>
                        <input type="input" class="form-control" name="referencia" name="referencia" id="referencia" value="<?php echo $referencia; ?>"></input>
                        <div id="referenciax"></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Nombre:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                <div id="nombrex"></div>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Departamento</label>
                <select class="form-control" name="id_departamento" id="id_departamento">
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
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_departamentox"></div>
            </div>

        </div>

        <div class="row mb-2">

        </div>



        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-md-12"><label style="font-size: 12px;">Unidad:</label></div>
                    <div class="col-md-3">
                        <input type="input" class="form-control" name="cantidad_unidadmedida" id="cantidad_unidadmedida" value="<?php echo $cantidad_unidadmedida; ?>"></input>
                        <div id="cantidad_unidadmedidax"></div>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control" name="id_unidadmedida" id="id_unidadmedida">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT um.id_unidad_medida,um.nombre, um.simbolo
                                                            FROM u116753122_cw3completa.unidad_medida um
                                                            where um.estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_unidad_medida']) . "'";
                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="id_unidadmedidax"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-md-12"><label style="font-size: 12px;">Presentacion:</label></div>
                    <div class="col-md-3">
                        <input type="input" class="form-control" name="cantidad_presentacion" id="cantidad_presentacion" value="<?php echo $cantidad_presentacion; ?>"></input>
                        <div id="cantidad_presentacionx"></div>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control" name="id_presentacion" id="id_presentacion">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT UM.id_unidad_medida,UM.nombre
                                                        FROM u116753122_cw3completa.unidad_medida UM
                                                        where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_unidad_medida']) . "'";
                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="id_presentacionx"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row m-2 p-2" style="border:thin dotted gray">
            <div class="col-md-2 col-lg-2 ">
                <label style="font-size: 12px;">Stock Minimo:</label>
                <input type="input" class="form-control" name="stckmin" id="stckmin" value="<?php echo $stckmin; ?>"></input>
                <div id="stckminx"></div>
            </div>
            <div class="col-md-2 col-lg-2 ">
                <label style="font-size: 12px;">Punto de Reorden:</label>
                <input type="input" class="form-control" name="stckpntoreorden" id="stckpntoreorden" value="<?php echo $stckpntoreorden; ?>"></input>
                <div id="stckpntoreordenx"></div>
            </div>
            <div class="col-md-2 col-lg-2">
                <label style="font-size: 12px;">Stock Maximo:</label>
                <input type="input" class="form-control" name="stckmax" id="stckmax" value="<?php echo $stckmax; ?>"></input>
                <div id="stckmaxx"></div>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Consumo :</label>
                <input type="input" class="form-control" name="csmoprommes" id="csmoprommes" readonly value="<?php echo $csmoprommes; ?>"></input>
                <div id="csmoprommesx"></div>
            </div>
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
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">F. Vence Producto en Bodega:</label>
                <input type="input" class="form-control" name="fvence" id="fvence" readonly value="<?php echo $fchvence; ?>"></input>
            </div>
        </div>

        <div class="row mb-2 p-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Nivel de Riesgo:</label>
                <select class="form-control" aria-label="Default select example" name="id_clasificacion_riesgo" id="id_clasificacion_riesgo">
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
                            echo '>' . $filaP2a['descripcion'];
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_clasificacion_riesgox"></div>
            </div>

            <div class="col-md-6 col-lg-6 ">
                <label style="font-size: 12px;">Condiciones de Almacenamiento:</label>
                <select class="form-control" aria-label="Default select example" name="id_condicion_almacenaje" id="id_condicion_almacenaje">
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
                            echo '>' . $filaP2a['descripcion'];
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_condicion_almacenajex"></div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Categoria:</label>
                <select class="form-control" aria-label="Default select example" name="categoria" id="categoria">
                    <option selected="true" disabled="disabled"></option>
                    <option value="1">Insumos</option>
                    <option value="2">Equipos Biomedicos</option>
                    <option value="3">Muebles y Enseres</option>
                    <option value="4">Reactivos</option>
                    <option value="5">No Aplica</option>
                </select>
                <div id="categoriax"></div>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Principio Activo:</label>
                <input type="input" class="form-control" name="pactivo" id="pactivo" value="<?php echo $principio_activo; ?>"></input>
                <div id="pactivox"></div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Forma Farmaceutica:</label>
                <input type="input" class="form-control" name="ffarmaceutica" id="ffarmaceutica" value="<?php echo $forma_farmaceutica; ?>"></input>
                <div id="ffarmaceuticax"></div>
            </div>
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Vida Util:</label>
                <input type="input" class="form-control" name="vida_util" id="vida_util" value="<?php echo $vida_util; ?>"></input>
                <div id="vida_utilx"></div>
            </div>
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Lote:</label>
                <input type="input" class="form-control" name="lote" id="lote" value="<?php echo $lote; ?>"></input>
                <div id="lotex"></div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Marca:</label>
                <input type="input" class="form-control" name="marca" id="marca" value="<?php echo $marca; ?>"></input>
                <div id="marcax"></div>
            </div>
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Serie:</label>
                <input type="input" class="form-control" name="serie" id="serie" value="<?php echo $serie; ?>"></input>
                <div id="seriex"></div>
            </div>
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Fecha Vencimiento:</label>
                <input type="date" class="form-control" name="fvence2" id="fvence2" value="<?php echo $fecha_vencimiento; ?>"></input>
                <div id="fvencex"></div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Concentracion:</label>
                <input type="input" class="form-control" name="concentracion" id="concentracion" value="<?php echo $concentracion; ?>"></input>
                <div id="concentracionx"></div>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Registro Invima:</label>
                <input type="input" class="form-control" name="reginvima" id="reginvima" value="<?php echo $reg_invima; ?>"></input>
                <div id="reginvimax"></div>
            </div>
        </div>
        <div class="row mb-2">




            <div class="col-md-6 col-lg-6 " style="display: none;">
                <label style="font-size: 12px;margin-left:15px;">
                    Fecha Creación 23/02/2023
                </label>
            </div>
        </div>


    </form>

   <!-- <div class="col-md-12" style="margin-top:15px; padding-top:3px;border-top:thin solid gray; display:none;" name="divproveedoresproducto" id="divproveedoresproducto">
        <div class="col-md-12" style="font-weight:bold;">Provedores del Producto</div>
        <table name="tblproveedor" id="tblproveedor" class="table table-striped table-hover table-head-fixed text-nowrap table-sm">
            <thead>
                <tr>
                    <th>Nit</th>
                    <th>Empresa</th>
                    <th>Referencia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php    //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
                $cadenaa = "SELECT P.referencia, PR.razon_social, PR.numero_identificacion, PR.id_proveedores
                                            FROM u116753122_cw3completa.productoproveedor P,
                                                u116753122_cw3completa.proveedores PR
                                        where P.id_proveedores=PR.id_proveedores
                                            and P.id_productos='" . $id . "'";
                //                                             echo $cadenaa;
                $resultadP2a = $conetar->query($cadenaa);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        $referencia = trim($filaP2a['referencia']);
                        $razon_social = trim($filaP2a['razon_social']);
                        $numero_identificacion = trim($filaP2a['numero_identificacion']);
                        $id_proveedor = trim($filaP2a['id_proveedor']);
                ?>

                        <tr style="font-size: 10px;">
                            <td><?php echo $numero_identificacion; ?></td>
                            <td><?php echo $razon_social; ?></td>
                            <td><?php echo $referencia; ?></td>
                            <td><a class="btn btn-small btn-primary" name="btnelimproveedor" id="btnelimproveedor" href="elimina.php?id=" <?php echo $id; ?>>Eliminar</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
                <tr style="font-size: 10px;border-top:thin solid gray;" class="bg-light">
                    <td style=" padding-top:5px;">
                        Asignar Proveedor
                    </td>
                    <td style=" padding-top:5px;">
                        <select class="form-control" aria-label="Default select example" name="proveedorlist" id="proveedorlist">
                            <?php
                            $cadenaa = "SELECT id_proveedores,razon_social
                                                                FROM u116753122_cw3completa.proveedores
                                                                where estado='1'
                                                                order by 2";
                            $resultadP2a = $conetar->query($cadenaa);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";
                                    echo '>' . $filaP2a['razon_social'];
                                    echo "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td style=" padding-top:5px;"><input type="text" class="form-control" name=referencia id=referencia></td>
                    <td style=" padding-top:5px;"><a class="btn btn-xs btn-success" name="btnagregaprov" id="btnagregaprov" href="agregaproveedor.php?id=" <?php echo $id; ?>>Agregar</a></td>
                </tr>
            </tbody>
        </table>


    </div><?php //del div de proveedores rtelaciondos 
            ?>-->


<?php
}
?>

<script>
    $(document).ready(function() {
        $('#successbtn').click(function() {
            var referencia = $('#referencia').val();
            var nombre = $('#nombre').val();
            var id_departamento = $('#id_departamento').val();
            var cantidad_unidadmedida = $('#cantidad_unidadmedida').val();
            var id_unidadmedida = $('#id_unidadmedida').val();
            var cantidad_presentacion = $('#cantidad_presentacion').val();
            var id_presentacion = $('#id_presentacion').val();
          //  var stckmin = $('#stckmin').val();
            //var stckpntoreorden = $('#stckpntoreorden').val();
          //  var stckmax = $('#stckmax').val();
            var id_clasificacion_riesgo = $('#id_clasificacion_riesgo').val();
            var id_condicion_almacenaje = $('#id_condicion_almacenaje').val();
            var categoria = $('#categoria').val();
            var pactivo = $('#pactivo').val();
            var ffarmaceutica = $('#ffarmaceutica').val();
            var vida_util = $('#vida_util').val();
            var lote = $('#lote').val();
            var marca = $('#marca').val();
            var serie = $('#serie').val();
            var fvence2 = $('#fvence2').val();
            var concentracion = $('#concentracion').val();
            var reginvima = $('#reginvima').val();

            if (id_departamento == null) {
                id_departamento = '';
            }
            if (id_unidadmedida == null) {
                id_unidadmedida = '';
            }
            if (id_presentacion == null) {
                id_presentacion = '';
            }
            if (id_clasificacion_riesgo == null) {
                id_clasificacion_riesgo = '';
            }
            if (id_condicion_almacenaje == null) {
                id_condicion_almacenaje = '';
            }
            if (categoria == null) {
                categoria = '';
            }
            if (referencia.trim() === '') {
                $("#referencia").css("border", "thin solid red");
                $("#referenciax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#referencia").css("border", "thin solid rgb(233,236,239)");
                $("#referenciax").empty();
            }
            if (nombre.trim() === '') {
                $("#nombre").css("border", "thin solid red");
                $("#nombrex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#nombre").css("border", "thin solid rgb(233,236,239)");
                $("#nombrex").empty();
            }

            if (id_departamento.trim() === '') {
                $("#id_departamento").css("border", "thin solid red");
                $("#id_departamentox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#id_departamento").css("border", "thin solid rgb(233,236,239)");
                $("#id_departamentox").empty();
            }

            if (cantidad_unidadmedida.trim() === '') {
                $("#cantidad_unidadmedida").css("border", "thin solid red");
                $("#cantidad_unidadmedidax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#cantidad_unidadmedida").css("border", "thin solid rgb(233,236,239)");
                $("#cantidad_unidadmedidax").empty();
            }

            if (id_unidadmedida.trim() === '') {
                $("#id_unidadmedida").css("border", "thin solid red");
                $("#id_unidadmedidax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#id_unidadmedida").css("border", "thin solid rgb(233,236,239)");
                $("#id_unidadmedidax").empty();
            }

            if (cantidad_presentacion.trim() === '') {
                $("#cantidad_presentacion").css("border", "thin solid red");
                $("#cantidad_presentacionx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#cantidad_presentacion").css("border", "thin solid rgb(233,236,239)");
                $("#cantidad_presentacionx").empty();
            }
            if (id_presentacion.trim() === '') {
                $("#id_presentacion").css("border", "thin solid red");
                $("#id_presentacionx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#id_presentacion").css("border", "thin solid rgb(233,236,239)");
                $("#id_presentacionx").empty();
            }

            /*if (stckmin.trim() === '') {
                $("#stckmin").css("border", "thin solid red");
                $("#stckminx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#stckmin").css("border", "thin solid rgb(233,236,239)");
                $("#stckminx").empty();
            }

            if (stckpntoreorden.trim() === '') {
                $("#stckpntoreorden").css("border", "thin solid red");
                $("#stckpntoreordenx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#stckpntoreorden").css("border", "thin solid rgb(233,236,239)");
                $("#stckpntoreordenx").empty();
            }
            if (stckmax.trim() === '') {
                $("#stckmax").css("border", "thin solid red");
                $("#stckmaxx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#stckmax").css("border", "thin solid rgb(233,236,239)");
                $("#stckmaxx").empty();
            }*/

            if (id_clasificacion_riesgo.trim() === '') {
                $("#id_clasificacion_riesgo").css("border", "thin solid red");
                $("#id_clasificacion_riesgox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#id_clasificacion_riesgo").css("border", "thin solid rgb(233,236,239)");
                $("#id_clasificacion_riesgox").empty();
            }
            if (id_condicion_almacenaje.trim() === '') {
                $("#id_condicion_almacenaje").css("border", "thin solid red");
                $("#id_condicion_almacenajex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#id_condicion_almacenaje").css("border", "thin solid rgb(233,236,239)");
                $("#id_condicion_almacenajex").empty();
            }
            if (categoria.trim() === '') {
                $("#categoria").css("border", "thin solid red");
                $("#categoriax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#categoria").css("border", "thin solid rgb(233,236,239)");
                $("#categoriax").empty();
            }
            if (pactivo.trim() === '') {
                $("#pactivo").css("border", "thin solid red");
                $("#pactivox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#pactivo").css("border", "thin solid rgb(233,236,239)");
                $("#pactivox").empty();
            }
            if (ffarmaceutica.trim() === '') {
                $("#ffarmaceutica").css("border", "thin solid red");
                $("#ffarmaceuticax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#ffarmaceutica").css("border", "thin solid rgb(233,236,239)");
                $("#ffarmaceuticax").empty();
            }
            if (vida_util.trim() === '') {
                $("#vida_util").css("border", "thin solid red");
                $("#vida_utilx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#vida_util").css("border", "thin solid rgb(233,236,239)");
                $("#vida_utilx").empty();
            }
            if (lote.trim() === '') {
                $("#lote").css("border", "thin solid red");
                $("#lotex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#lote").css("border", "thin solid rgb(233,236,239)");
                $("#lotex").empty();
            }
            if (marca.trim() === '') {
                $("#marca").css("border", "thin solid red");
                $("#marcax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#marca").css("border", "thin solid rgb(233,236,239)");
                $("#marcax").empty();
            }
            if (serie.trim() === '') {
                $("#serie").css("border", "thin solid red");
                $("#seriex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#serie").css("border", "thin solid rgb(233,236,239)");
                $("#seriex").empty();
            }
            if (fvence2.trim() === '') {
                $("#fvence2").css("border", "thin solid red");
                $("#fvencex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#fvence2").css("border", "thin solid rgb(233,236,239)");
                $("#fvencex").empty();
            }
            if (concentracion.trim() === '') {
                $("#concentracion").css("border", "thin solid red");
                $("#concentracionx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#concentracion").css("border", "thin solid rgb(233,236,239)");
                $("#concentracionx").empty();
            }
            if (reginvima.trim() === '') {
                $("#reginvima").css("border", "thin solid red");
                $("#reginvimax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#reginvima").css("border", "thin solid rgb(233,236,239)");
                $("#reginvimax").empty();
            }
            collapseanshow('A');
        });

    });

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
     /*       $("#stckmin").css("border", "thin solid rgb(233,236,239)");
            $("#stckminx").empty();
            $("#stckpntoreorden").css("border", "thin solid rgb(233,236,239)");
            $("#stckpntoreordenx").empty();
            $("#stckmax").css("border", "thin solid rgb(233,236,239)");
            $("#stckmaxx").empty();*/
            $("#id_clasificacion_riesgo").css("border", "thin solid rgb(233,236,239)");
            $("#id_clasificacion_riesgox").empty();
            $("#id_condicion_almacenaje").css("border", "thin solid rgb(233,236,239)");
            $("#id_condicion_almacenajex").empty();
            $("#categoria").css("border", "thin solid rgb(233,236,239)");
            $("#categoriax").empty();
            $("#pactivo").css("border", "thin solid rgb(233,236,239)");
            $("#pactivox").empty();
            $("#ffarmaceutica").css("border", "thin solid rgb(233,236,239)");
            $("#ffarmaceuticax").empty();
            $("#vida_util").css("border", "thin solid rgb(233,236,239)");
            $("#vida_utilx").empty();
            $("#lote").css("border", "thin solid rgb(233,236,239)");
            $("#lotex").empty();
            $("#marca").css("border", "thin solid rgb(233,236,239)");
            $("#marcax").empty();
            $("#serie").css("border", "thin solid rgb(233,236,239)");
            $("#seriex").empty();
            $("#fvence2").css("border", "thin solid rgb(233,236,239)");
            $("#fvencex").empty();
            $("#concentracion").css("border", "thin solid rgb(233,236,239)");
            $("#concentracionx").empty();
            $("#reginvima").css("border", "thin solid rgb(233,236,239)");
            $("#reginvimax").empty();
        });
    });
</script>