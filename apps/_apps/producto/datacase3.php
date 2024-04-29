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



    if ($id != "") {
        $cadena = "select P.id_producto,P.referencia,P.id_categoria_producto,P.nombre,id_departamento,P.estado,
                        P.cantidad_presentacion,P.id_presentacion,P.cantidad_unidadmedida,P.id_unidadmedida,
                        P.id_clasificacion_riesgo,P.nombre_imagen,P.id_bodegas,P.id_departamento,
                        P.stckmin,P.stckpntoreorden,P.stckmax,P.csmoprommes,P.id_condicion_almacenaje
                    from u116753122_cw3completa.producto P
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
        }
    }


?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="3">
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
                            if (trim($filaP2a['id']) == $id_departamento) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_departamentox"></div>
            </div>

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
                                    if (trim($filaP2a['id_unidad_medida']) == $id_unidadmedida) {
                                        echo ' selected';
                                    }
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
                                    if (trim($filaP2a['id_unidad_medida']) == $id_presentacion) {
                                        echo ' selected';
                                    }
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

        <div class="row mb-2">
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
            </div>

            <div class="col-md-6 col-lg-6">
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
            </div>
        </div>




    </form>

<?php
}
?>



<script>
    $(document).ready(function() {
        $("#successbtn").click(function() {
            referencia = $('#referencia').val();
            nombre = $('#nombre').val();
            id_departamento = $('#id_departamento').val();
            cantidad_unidadmedida = $('#cantidad_unidadmedida').val();
            id_unidadmedida = $('#id_unidadmedida').val();
            cantidad_presentacion = $('#cantidad_presentacion').val();
            id_presentacion = $('#id_presentacion').val();
        /*    stckmin = $('#stckmin').val();
            stckpntoreorden = $('#stckpntoreorden').val();
            stckmax = $('#stckmax').val();*/
            id_clasificacion_riesgo = $('#id_clasificacion_riesgo').val();
            id_condicion_almacenaje = $('#id_condicion_almacenaje').val();

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

   /*         if (stckmin.trim() === '') {
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