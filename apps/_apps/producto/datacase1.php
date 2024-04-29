<?php
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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
    $referencia = "";
    $id_departamento = "";
    $estado = "";
    $valor = "";
    $modelo = "";
    $serie = "";
    $fchinstalacion = "";
    $seguro = "";
    $seguroprima = "";
    $garantia = "";
    $fchexpgarantia = "";
    $vidautilmes = "";
    $metdepreciacion = "";
    $id_sede = "";
    $id_tipo_activo = "";
    $id_responsable = "";
    $id_proveegarantia = "";
    if ($id != "") {
        $cadena = "select P.id_producto,P.referencia,P.id_categoria_producto,P.nombre,P.id_departamento,P.estado,
                        PA.valor,PA.modelo,PA.serie,PA.fchinstalacion,
                        PA.seguro,PA.seguroprima,PA.garantia,PA.fchexpgarantia,
                        PA.vidautilmes,PA.metdepreciacion,P.id_sede,P.id_tipo_activo, PA.id_proveegarantia,PA.id_responsable
                    from u116753122_cw3completa.producto P,
                         u116753122_cw3completa.producto_activofijo PA
                    where P.id_producto=PA.id_producto
                        and P.id_producto='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = "1"; //esa ctivo fijo
            $nombre = trim($filaP2['nombre']);
            $referencia = trim($filaP2['referencia']);
            $id_departamento = trim($filaP2['id_departamento']);
            $id_sede = trim($filaP2['id_sede']);
            $id_tipo_activo = trim($filaP2['id_tipo_activo']);
            $estado = trim($filaP2['estado']);
            $valor = trim($filaP2['valor']);;
            $modelo = trim($filaP2['modelo']);
            $serie = trim($filaP2['serie']);
            $fchinstalacion = trim($filaP2['fchinstalacion']);
            $seguro = trim($filaP2['seguro']);
            $seguroprima = trim($filaP2['seguroprima']);
            $garantia = trim($filaP2['garantia']);
            $id_proveegarantia = trim($filaP2['id_proveegarantia']);
            $id_responsable = trim($filaP2['id_responsable']);
            $fchexpgarantia = trim($filaP2['fchexpgarantia']);
            $vidautilmes = trim($filaP2['vidautilmes']);
            $metdepreciacion = trim($filaP2['metdepreciacion']);
        }
    }

?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="1">
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
                <label style="font-size: 12px;">Sede</label>
                <select class="form-control" name="id_sedes" id="id_sedes">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_sedes, nombre
                                                    FROM u116753122_cw3completa.sedes
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                            if (trim($filaP2a['id_sedes']) == $id_sede) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
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
            </div>

        </div>
        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Tipo de Activo Fijo</label>
                <select class="form-control" name="id_tipo_activo" id="id_tipo_activo">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.tipo_activo_fijos
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_tipo_activo) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Responsable</label>
                <select class="form-control" name="responsable" id="responsable">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT b.nombre_1, b.nombre_2,b.apellido_1,b.apellido_2, b.id_persona
                                                    FROM u116753122_cw3completa.persona_empleados a, u116753122_cw3completa.persona b
                                                    where a.id_persona = b.id_persona";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_persona']) . "'";
                            if (trim($filaP2a['id_persona']) == $id_responsable) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre_1'] . " " . $filaP2a['nombre_2'] . " " . $filaP2a['apellido_1'] . " " . $filaP2a['apellido_2'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Modelo:</label>
                <input type="input" class="form-control" name="modelo" id="modelo" value="<?php echo $modelo; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Serie:</label>
                <input type="input" class="form-control" name="serie" id="serie" value="<?php echo $serie; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Fecha de Instalación:</label>
                <input type="date" class="form-control" name="fchinstalacion" id="fchinstalacion" value="<?php echo $fchinstalacion; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Valor:</label>
                <input type="number" class="form-control" name="valor" id="valor" value="<?php echo $valor; ?>"></input>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Seguro:</label>
                <select class="form-control" aria-label="Default select example" name="seguro" id="seguro">
                    <option selected="true" disabled="disabled"></option>
                    <option value='S' <?php if ('S' == $seguro) {
                                            echo ' selected';
                                        } ?>>SI</option>
                    <option value='N' <?php if ('N' == $seguro) {
                                            echo ' selected';
                                        } ?>>NO</option>
                </select>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Valor Prima:</label>
                <input type="number" class="form-control" name="seguroprima" id="seguroprima" value="<?php echo $seguroprima; ?>"></input>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Garantia:</label>
                <select class="form-control" aria-label="Default select example" name="garantia" id="garantia">
                    <option selected="true" disabled="disabled"></option>
                    <option value='S' <?php if ('S' == $garantia) {
                                            echo ' selected';
                                        } ?>>SI</option>
                    <option value='N' <?php if ('N' == $garantia) {
                                            echo ' selected';
                                        } ?>>NO</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Fecha expiracion Garantia:</label>
                <input type="date" class="form-control" name="fchexpgarantia" id="fchexpgarantia" value="<?php echo $fchexpgarantia; ?>"></input>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Proveedor Responsable Garantia:</label>
                <select class="form-control" name="proveegarantia" id="proveegarantia">
                    <option selected="true" disabled="disabled" required></option>
                    <?php
                    $cadena = "SELECT id_proveedores, nombre_comercial
                                                    FROM u116753122_cw3completa.proveedores
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            $id_productox = trim($filaP2['id_producto']);
                            echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";
                            if (trim($filaP2a['id_proveedores']) == $id_proveegarantia) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre_comercial'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Vida útil del Activo en meses:</label>
                <input type="number" class="form-control" name="vidautilmes" id="vidautilmes" value="<?php echo $vidautilmes; ?>"></input>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Metodo de Depreciación:</label>
                <select class="form-control" aria-label="Default select example" name="metdepreciacion" id="metdepreciacion">
                    <option selected="true" disabled="disabled"></option>
                    <option value='1' <?php if ($metdepreciacion == "1") {
                                            echo "selected";
                                        } ?>>Metodo de la Linea Recta</option>
                    <option value='2' <?php if ($metdepreciacion == "2") {
                                            echo "selected";
                                        } ?>>Método de la suma de los dígitos del año</option>
                    <option value='3' <?php if ($metdepreciacion == "3") {
                                            echo "selected";
                                        } ?>>Método de depreciación por unidades de producción</option>
                    <option value='4' <?php if ($metdepreciacion == "4") {
                                            echo "selected";
                                        } ?>>Método de depreciación por reducción de saldos</option>
                </select>
            </div>
        </div>



    </form>

   <!-- <div class="col-md-12" style="margin-top:15px; padding-top:3px;border-top:thin solid gray; display:none;" name="divproveedoresproducto" id="divproveedoresproducto">
        <div class="col-md-12" style="font-weight:bold;">Provedores del Activo</div>
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
        $("#successbtn").click(function() {
            
            collapseanshow('A');
        });

    });
</script>