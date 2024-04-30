<?php

if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    ?>


    <form name="formAddProvider" id="formAddProvider" action="" method="POST" enctype="multipart/form-data"
        style="width: 100%; padding: 0px 30px 0px 30px;">


        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

        <div class="row">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label style="font-size: 12px;">Tipo Identificacion:</label>
                            <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion" required>
                                <option selected="true" disabled="disabled"></option>
                                <?php
                                $cadena33 = "SELECT id, nombre FROM tipo_identificacion where estado='1'";
                                $resultadP2a33 = $conetar->query($cadena33);
                                $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                                if ($numerfiles2a33 >= 1) {
                                    while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                        echo "<option value='" . trim($filaP2a33['id']) . "'";
                                        if (trim($filaP2a33['id']) == $id_tipo_identificacion) {
                                            echo ' selected';
                                        }
                                        echo '>' . $filaP2a33['nombre'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label style="font-size: 12px;">Numero:</label>
                            <input type="text" class="form-control" name="documento" id="documento" required
                                value="<?php echo $numero_identificacion; ?>">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label style="font-size: 12px;">DV</label>
                        <input type="text" class="form-control" name="digverificacion" id="digverificacion"
                            value="<?php echo $dv; ?>"></input>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label style="font-size: 12px;">Razon Social:</label>
                            <input type="text" class="form-control" name="razon_social" id="razon_social" required
                                value="<?php echo $razon_social; ?>">
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Nombre Comercial</label>
                            <input type="text" class="form-control" name="nombre_comercial" id="nombre_comercial" required
                                value="<?php echo $nombre_comercial; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label style="font-size: 12px;">País:</label>
                            <select class="form-control" name="pais" id="pais" required>
                                <option selected="true" disabled="disabled"></option>
                                <?php
                                $cadena33 = "SELECT id, name FROM countries";
                                $resultadP2a33 = $conetar->query($cadena33);

                                if ($resultadP2a33->num_rows > 0) {
                                    while ($row = $resultadP2a33->fetch_assoc()) {
                                        $value = $row['id'];
                                        $pais_nombre = $row['name'];
                                        $selected = ($pais == $value) ? 'selected' : '';
                                        echo "<option value='$value' $selected>$pais_nombre</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label style="font-size: 12px;">Departamento:</label>

                            <select class="form-control" name="dep" id="dep" required>
                                <option selected="true" disabled="disabled"></option>
                                <?php
                                $cadena33 = "SELECT id, nombre FROM departamento";
                                $resultadP2a33 = $conetar->query($cadena33);

                                if ($resultadP2a33->num_rows > 0) {
                                    while ($row = $resultadP2a33->fetch_assoc()) {
                                        $value = $row['id'];
                                        $dep_nombre = $row['nombre'];
                                        $selected = ($id_departamento == $value) ? 'selected' : '';
                                        echo "<option value='$value' $selected>$dep_nombre</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label style="font-size: 12px;">Ciudad</label>
                            <select class="form-control" name="ciudad" id="ciudad" required>
                                <option selected="true" disabled="disabled"></option>
                                <?php
                                $cadena33 = "SELECT id, nombre FROM ciudades";
                                $resultadP2a33 = $conetar->query($cadena33);
                                if ($resultadP2a33->num_rows > 0) {
                                    while ($row = $resultadP2a33->fetch_assoc()) {
                                        $value = $row['id'];
                                        $ciudad_nombre = $row['nombre'];
                                        $selected = ($ciudad == $value) ? 'selected' : '';
                                        echo "<option value='$value' $selected>$ciudad_nombre</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label style="font-size: 12px;">Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" required
                                value="<?php echo $direccion; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Telefono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" required
                                value="<?php echo $telefono; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Email Corporativo:</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Condiciones de Pago:</label> <br>
                            <select class="form-control" id="id_pago" name="id_pago" required>
                                <option value=""></option>
                                <?php
                                $cadena33 = "SELECT id, nombre, numero FROM condicion_pago where estado='1'";
                                $resultadP2a33 = $conetar->query($cadena33);
                                $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                                if ($numerfiles2a33 >= 1) {
                                    while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                        if ($nombre == "1") {
                                            $nombrecr = "Pago de Contado";
                                        } else {
                                            $nombrecr = "Credito";
                                        }
                                        echo "<option value='" . trim($filaP2a33['id']) . "'";
                                        if (trim($filaP2a33['id']) == $id_pago) {
                                            echo ' selected';
                                        }
                                        echo '>' . $nombrecr . " " . $filaP2a33['numero'] . " días" . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="font-size: 12px;">Descripcion:</label>
                            <textarea class="form-control" name="descripcion"
                                id="descripcion"><?php echo $descripcion; ?></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="text-align:center">
                            <label style="font-size: 12px;text-align:center">Persona de Contacto:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Nombre:</label>
                            <input type="text" class="form-control" name="nombrec" id="nombrec"
                                value="<?php echo $nombrec; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Telefono Contacto:</label>
                            <input type="text" class="form-control" name="telefonoc" id="telefonoc"
                                value="<?php echo $telefonoc; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Email:</label>
                            <input type="email" class="form-control" name="emailc" id="emailc"
                                value="<?php echo $emailc; ?>">
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="text-align:center">
                            <label style="font-size: 12px;text-align:center">Informacion Tributaria:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Tipo de Contribuyente:</label>
                            <select class="form-control" name="id_tipo_contribuyente" id="id_tipo_contribuyente">
                                <option selected="true" disabled="disabled"></option>
                                <option value="1" <?php if ($id_tipo_contribuyente == "1") {
                                    echo " selected";
                                } ?>>Persona Natural</option>
                                <option value="2" <?php if ($id_tipo_contribuyente == "2") {
                                    echo " selected";
                                } ?>>Persona Juridica</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Representante Legal:</label>
                            <input type="input" class="form-control" name="representante_legal" id="representante_legal"
                                value="<?php echo $representante_legal; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Retencion de Fuente(%):</label>
                            <select class="form-control" id="retenfuente" name="retenfuente">
                                <option value=""></option>
                                <?php
                                $cadena33 = "SELECT id_config_imp, codigo_cuenta, nombre_cuenta, porcentaje_uvt FROM config_impuestos WHERE tipo_cuenta = 'RF'";
                                $resultadP2a33 = $conetar->query($cadena33);
                                $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                                if ($numerfiles2a33 >= 1) {
                                    while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                        echo "<option value='" . trim($filaP2a33['id_config_imp']) . "' ";
                                        if (trim($filaP2a33['id_config_imp']) == $retenfuente) {
                                            echo ' selected';
                                        }
                                        echo '>';

                                        echo $filaP2a33['codigo_cuenta'] . " - " . $filaP2a33['nombre_cuenta'] . " - " . $filaP2a33['porcentaje_uvt'] . "%";
                                        echo "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Reteica (%):</label>
                            <select class="form-control" id="reteica" name="reteica">
                                <option value=""></option>
                                <?php
                                $cadena33 = "SELECT id_config_imp, codigo_cuenta, nombre_cuenta, porcentaje_uvt FROM config_impuestos WHERE tipo_cuenta = 'RI'";
                                $resultadP2a33 = $conetar->query($cadena33);
                                $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                                if ($numerfiles2a33 >= 1) {
                                    while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                        echo "<option value='" . trim($filaP2a33['id_config_imp']) . "'";
                                        if (trim($filaP2a33['id_config_imp']) == $reteica) {
                                            echo ' selected';
                                        }
                                        echo '>';
                                        echo $filaP2a33['codigo_cuenta'] . " - " . $filaP2a33['nombre_cuenta'] . " - " . $filaP2a33['porcentaje_uvt'] . "%";
                                        echo "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="font-size: 12px;">Cuentas por Pagar:</label>
                            <select class="form-control" id="cuentapagar" name="cuentapagar">
                                <option value=""></option>
                                <?php
                                $cadena33 = "SELECT id_ctapagar, codigo_ctapagar, descripcion FROM config_ctaxpagar";
                                $resultadP2a33 = $conetar->query($cadena33);
                                $numerfiles2a33 = mysqli_num_rows($resultadP2a33);


                                if ($numerfiles2a33 >= 1) {
                                    while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                        echo "<option value='" . trim($filaP2a33['id_ctapagar']) . "'";
                                        if (trim($filaP2a33['id_ctapagar']) == $cuenta_pagar) {
                                            echo ' selected';
                                        }
                                        echo '>';
                                        echo $filaP2a33['codigo_ctapagar'] . " - " . $filaP2a33['descripcion'];
                                        echo "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div id="cuentapagarx"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="categoria" style="font-size: 12px;">Categoria:</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value=""></option>
                                <?php
                                $cadena33 = "SELECT id_categoria_producto, nombre FROM categoria_producto";
                                $resultadP2a33 = $conetar->query($cadena33);
                                $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                                if ($numerfiles2a33 >= 1) {
                                    while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                        echo "<option value='" . trim($filaP2a33['id_categoria_producto']) . "'";
                                        if (trim($filaP2a33['id_categoria_producto']) == $categoria) {
                                            echo ' selected';
                                        }
                                        echo '>' . $filaP2a33['nombre'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div id="categoriax"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="regimen" style="font-size: 12px;">Regimen Fiscal</label>
                            <?php
                            $cadena33 = "SELECT idreg, descripcion FROM regimen_fiscal_config";
                            $resultadP2a33 = $conetar->query($cadena33);
                            $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                            $idsGuardados = explode(',', $id_regimen);
                            if ($numerfiles2a33 >= 1) {
                                while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                    $idreg = trim($filaP2a33['idreg']);
                                    $descripcion = $filaP2a33['descripcion'];

                                    $checked = in_array($idreg, $idsGuardados) ? 'checked' : '';
                                    ?>
                                    <div class="form-check">
                                        <input type="checkbox" style="font-size: 12px;" class="form-check-input" name="regimen[]"
                                            value="<?= $idreg ?>" id="checkreg<?= $idreg ?>" <?= $checked ?>>
                                        <label style="font-size: 12px;" class="form-check-label" for="checkreg<?= $idreg ?>">
                                            <?= $descripcion ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <input type="hidden" name="regfiscal" id="regfiscal">
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigo_act_eco_1" style="font-size: 12px;">Actividad Económica:</label>
                            <input type="text" class="form-control" name="codigo_act_eco_1" id="codigo_act_eco_1"
                                value="<?php echo $codigo_act_eco_1; ?>">
                            <div id="codigo_act_eco_1x"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigo_act_ind_comer" style="font-size: 12px;">Actividad Industria y
                                Comercio:</label>
                            <input type="text" class="form-control" name="codigo_act_ind_comer" id="codigo_act_ind_comer"
                                value="<?php echo $codigo_act_ind_comer; ?>">
                            <div id="codigo_act_ind_comerx"></div>
                        </div>
                    </div>
                </div>

                <div class="row">



                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="observaciones" style="font-size: 12px;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones"
                                id="observaciones"><?php echo $observaciones; ?></textarea>
                            <div id="observacionesx"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-5 text-right" style="border-radius: 5px;">
            <button type="submit" class="btn btn-sm btn-success " style="font-size:12px;width:90px;">
                Grabar
            </button>
            <button type="button" class="btn btn-sm btn-danger " name="btncancel" id="btncancel" data-dismiss="modal"
                style="font-size:12px;width:90px;">
                Cancelar
            </button>
        </div>

    </form>
    <script src="/cw3/conlabweb3.0/apps/proveedor/assets/datacase.js"></script>
    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="/cw3/conlabweb3.0/apps/dig_verificacion/dig_verificacion.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
     
    </script>
    <?php
}
?>