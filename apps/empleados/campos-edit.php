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

    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = "";
    }

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
    //$referencia = "";
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
    $aseguradora = "";
    $valor_asegurado = "";
    $descp = "";
    if ($id != "") {
        $cadena = "select P.id_producto,P.id_categoria_producto,P.nombre,P.id_departamento,P.estado,P.descripcion,
                        PA.valor,PA.modelo,PA.serie,PA.fchinstalacion,
                        PA.seguro,PA.seguroprima,PA.garantia,PA.fchexpgarantia,
                        PA.vidautilmes,PA.metdepreciacion,P.id_sede,P.id_tipo_activo, PA.id_proveegarantia,PA.id_responsable,PA.aseguradora,PA.valor_asegurado
                    from producto P,
                         producto_activofijo PA
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
            //$referencia = trim($filaP2['referencia']);
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
            $aseguradora = trim($filaP2['aseguradora']);
            $valor_asegurado = trim($filaP2['valor_asegurado']);
            $descp = trim($filaP2['descripcion']);
        }
    }
}

?>
<input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="1">
<input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id; ?>">
<input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">

<div class="row">

    <div class="col-md-3">
        <label style="font-size: 11px;">Nombre:</label>
        <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>"></input>

    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Modelo:</label>
        <input type="input" class="form-control" name="modelo" id="modelo" value="<?php echo $modelo ?>"></input>

    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Serie:</label>
        <input type="input" class="form-control" name="serie" id="serie" value="<?php echo $serie ?>"></input>
    </div>

    <div class="col-md-3">
        <label style="font-size: 11px;">Descripción:</label>
        <input type="input" class="form-control" name="descp" id="descp" value="<?php echo $descp ?>" required></input>

    </div>

</div>


<div class="row">

    <div class="col-md-3">
        <label style="font-size: 11px;">Sede</label>
        <select class="form-control" name="id_sedes" id="id_sedes" required>
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id_sedes, nombre FROM sedes where estado='1'";
            $resultadP2a = $conetar->query($cadena);

            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                if (trim($filaP2a['id_sedes']) == $id_sede) {
                    echo ' selected';
                }
                echo '>' . $filaP2a['nombre'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Departamento</label>
        <select class="form-control" name="id_departamento" id="id_departamento">
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id, nombre FROM departamentos where estado='1'";
            $resultadP2a = $conetar->query($cadena);

            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                echo "<option value='" . trim($filaP2a['id']) . "'";
                if (trim($filaP2a['id']) == $id_departamento) {
                    echo ' selected';
                }
                echo '>' . $filaP2a['nombre'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Tipo de Activo Fijo</label>
        <select class="form-control" name="id_tipo_activo" id="id_tipo_activo">
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id, nombre FROM tipo_activo_fijos where estado='1'";
            $resultadP2a = $conetar->query($cadena);
            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                echo "<option value='" . trim($filaP2a['id']) . "'";
                if (trim($filaP2a['id']) == $id_tipo_activo) {
                    echo ' selected';
                }
                echo '>' . $filaP2a['nombre'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Responsable</label>
        <select class="form-control" name="responsable" id="responsable">
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id_proveedores, nombre_comercial
                                                    FROM proveedores
                                                    where estado='1'";
            $resultadP2a = $conetar->query($cadena);

            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";
                if (trim($filaP2a['id_proveedores']) == $id_responsable) {
                    echo ' selected';
                }
                echo '>' . $filaP2a['nombre_comercial'] . "</option>";
            }
            ?>
        </select>
    </div>
</div>

<div class="row mb-2">

    <div class="col-md-3">
        <label style="font-size: 11px;">Fecha de Instalación:</label>
        <input type="date" class="form-control" name="fchinstalacion" id="fchinstalacion" value="<?php echo $fchinstalacion; ?>"></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Valor:</label>
        <input type="number" class="form-control" name="valor" id="valor" value="<?php echo $valor; ?>"></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Seguro:</label>
        <select class="form-control" aria-label="Default select example" name="seguro" id="seguro" required>
            <option selected="true" disabled="disabled"></option>
            <option value="S">SI</option>
            <option value="N">NO</option>
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Aseguradora:</label>
        <input type="text" class="form-control" name="aseguradora" id="aseguradora" value="">
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label style="font-size: 11px;">Valor Asegurado:</label>
        <input type="number" class="form-control" name="valor_seguro" id="valor_seguro" value="<?php echo $valor_asegurado; ?>">
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Garantia:</label>
        <select class="form-control" aria-label="Default select example" name="garantia" id="garantia" required>
            <option selected="true" disabled="disabled"></option>
            <option value="S">SI</option>
            <option value="N">NO</option>
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Fecha expiracion Garantia:</label>
        <input type="date" class="form-control" name="fchexpgarantia" id="fchexpgarantia" value="<?php echo $fchexpgarantia; ?>"></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Proveedor Responsable Garantia:</label>
        <select class="form-control" name="proveegarantia" id="proveegarantia">
            <option selected="true" disabled="disabled" required></option>
            <?php
            $cadena = "SELECT id_proveedores, nombre_comercial
                                                    FROM proveedores
                                                    where estado='1'";
            $resultadP2a = $conetar->query($cadena);

            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";
                if (trim($filaP2a['id_proveedores']) == $id_responsable) {
                    echo ' selected';
                }
                echo '>' . $filaP2a['nombre_comercial'] . "</option>";
            }
            ?>
        </select>
    </div>
</div>


<div class="row">

    <div class="col-md-3">
        <label style="font-size: 11px;">Metodo de Depreciación:</label>
        <select class="form-control" aria-label="Default select example" name="metdepreciacion" id="metdepreciacion">
            <option disabled="disabled"></option>
            <option value='1' selected>Metodo de la Linea Recta</option>
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Vida útil en años:</label>
        <input type="number" class="form-control" name="vidautilmes" id="vidautilmes" value="<?php echo $vidautilmes; ?>"></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">¿Necesita mantenimiento?</label>
        <select class="form-control" name="optmante" id="optmante" required>
            <option value=""></option>
            <option value="1">SI</option>
            <option value="2">NO</option>
        </select>
    </div>
    <!--<div class="col-md-3" style="margin-top: 28px;">
        <a href="#addEmployeeModal" class="btn btn-sm btn-primary" data-toggle="modal" style="background-color: rgb(0,69,165);font-size:12px;"><i class="fa-solid fa-eye"></i> &nbsp; <span>Ver Historial de Mantenimientos</span></a>
    </div>-->
    <!--<div class="col-md-3">
                <label style="font-size: 11px;">Codigo:</label>
                <input type="hidden" class="form-control" style="border:thin solid transparent; background: #EEEEEE;" readonly value="<?php echo $id; ?>" disabled></input>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <?php if ($estado == '0') {
                    echo "<span style='color:red;'> Inhabilitado</span>";
                } ?>
            </div>-->
</div>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: 'https://cw3.tierramontemariana.org/apps/activofijo/crud-2.php?aux=2',
                    data: $('#formEditActivos').serialize(),
                    success: function(respuesta) {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Registro Exitoso",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.content-table').load('https://cw3.tierramontemariana.org/apps/activofijo/tabla.php');
                        $('#modalEditActivoFijo').modal('hide');
                    }
                });
            }
        });
        $('#formEditActivos').validate({
            rules: {
                optmante: {
                    required: true
                },
                id_sedes: {
                    required: true
                },
                descp: {
                    required: true
                }
            },
            messages: {
                optmante: {
                    required: ""
                },
                id_sedes: {
                    required: ""
                },
                descp: {
                    required: ""
                }
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

    })
</script>