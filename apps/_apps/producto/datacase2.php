<?php
//     presntadio n par todos lod produtos tipo REACTIVOS

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

    $id_categoria_producto = "2"; //es un producto
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
    $costo = "";
    $estante = "";

    if ($id != "") {
        $cadena = "select P.id_producto,P.referencia,P.id_categoria_producto,P.nombre,id_departamento,P.estado,
                        P.cantidad_presentacion,P.id_presentacion,P.cantidad_unidadmedida,P.id_unidadmedida,
                        P.id_clasificacion_riesgo,P.nombre_imagen,P.id_bodegas,P.id_departamento,
                        P.stckmin,P.stckpntoreorden,P.stckmax,P.csmoprommes,P.id_condicion_almacenaje,
                        PR.costo,PR.estante
                    from u116753122_cw3completa.producto P,
                        u116753122_cw3completa.producto_reactivo PR
                    where PR.id_producto=P.id_producto
                        and P.id_producto='" . $id . "'";
        //echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = "2";
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
            $costo = trim($filaP2['costo']);
            $estante = trim($filaP2['estante']);
        }
    }


?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="2">
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
                        <label style="font-size: 12px;">Referencia Fabricante:</label>
                        <input type="input" class="form-control" name="referencia" name="referencia" id="referencia" value="<?php echo $referencia; ?>"></input>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <label style="font-size: 12px;">Nombre:</label>
                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Departamento</label>
                <select class="form-control" name="id_departamento" id="id_departamento">
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
            </div>

        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-md-12"><label style="font-size: 12px;">Unidad:</label></div>
                    <div class="col-md-3">
                        <input type="input" class="form-control" name="cantidad_unidadmedida" id="cantidad_unidadmedida" value="<?php echo $cantidad_unidadmedida; ?>"></input>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control" name="id_unidadmedida" id="id_unidad_medida">
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
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-md-12"><label style="font-size: 12px;">Presentacion:</label></div>
                    <div class="col-md-3">
                        <input type="input" class="form-control" name="cantidad_presentacion" id="cantidad_presentacion" value="<?php echo $cantidad_presentacion; ?>"></input>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control" name="id_presentacion" id="id_presentacion">
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
                    </div>
                </div>
            </div>

        </div>


        <div class="row m-2 p-2" style="border:thin dotted gray">
            <div class="col-md-3 col-lg-3 mb-3">
                <label style="font-size: 12px;">Stock Minimo:</label>
                <input type="input" class="form-control" name="stckmin" id="stckmin" value="<?php echo $stckmin; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3 mb-3">
                <label style="font-size: 12px;">Punto de Reorden:</label>
                <input type="input" class="form-control" name="stckpntoreorden" id="stckpntoreorden" value="<?php echo $stckpntoreorden; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3 mb-3">
                <label style="font-size: 12px;">Stock Maximo:</label>
                <input type="input" class="form-control" name="stckmax" id="stckmax" value="<?php echo $stckmax; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3 mb-3">
                <label style="font-size: 12px;">Consumo :</label>
                <input type="input" class="form-control" name="csmoprommes" id="csmoprommes" readonly value="<?php echo $csmoprommes; ?>"></input>
            </div>

            <div class="col-md-3 col-lg-3 mb-3">
                <label style="font-size: 12px;">Costo</label>
                <input type="input" class="form-control" name="costo" id="costo" value="<?php echo $costo; ?>"></input>
            </div>

        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Nivel de Riesgo:</label>
                <select class="form-control" aria-label="Default select example" name="id_clasificacion_riesgo" id="id_clasificacion_riesgo">
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
            </div>

            <div class="col-md-6 col-lg-6 ">
                <label style="font-size: 12px;">Condiciones de Almacenamiento:</label>
                <select class="form-control" aria-label="Default select example" name="id_condicion_almacenaje" id="id_condicion_almacenaje">
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
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Ubicación Bodega</label>
                <select class="form-control" aria-label="Default select example" name="id_bodegas" id="id_bodegas">
                    <?php
                    $cadena = "SELECT id_bodegas, bodega,predeterminada
                                                    FROM u116753122_cw3completa.bodegas
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_bodegas']) . "'";
                            if (trim($filaP2a['id_bodegas']) == $id_bodegas) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['bodega'];
                            if ($filaP2a['predeterminada'] == '1') {
                                echo ' (Predeterminada)';
                            }
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Estante</label>
                <input type="input" class="form-control" name="estante" id="estante" value="<?php echo $estante; ?>"></input>
            </div>

            <div class="col-md-6 col-lg-6 ">
                <label style="font-size: 12px;margin-left:15px;">
                    Fecha Creación 23/02/2023
                </label>
            </div>
        </div>


    </form>

    <div class="col-md-12" style="margin-top:15px; padding-top:3px;border-top:thin solid gray; display:none;" name="divproveedoresproducto" id="divproveedoresproducto">
        <div class="col-md-12" style="font-weight:bold;">Provedores del Reactivo</div>
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
                                            and P.id_producto='" . $id . "'";
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
            ?>


<?php
}
?>