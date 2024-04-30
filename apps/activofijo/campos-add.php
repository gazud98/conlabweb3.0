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
}

?>
<input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="1">
<input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">

<div class="row">

    <div class="col-md-3">
        <label style="font-size: 11px;">Nombre:</label>
        <input type="input" class="form-control" name="nombre" id="nombre" value=""></input>

    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Modelo:</label>
        <input type="input" class="form-control" name="modelo" id="modelo" value=""></input>

    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Serie:</label>
        <input type="input" class="form-control" name="serie" id="serie" value=""></input>
    </div>

    <div class="col-md-3">
        <label style="font-size: 11px;">Descripción:</label>
        <input type="input" class="form-control" name="descp" id="descp" value="" required></input>

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
            ?>
                <option value="<?php echo $filaP2a['id_sedes']; ?>"><?php echo $filaP2a['nombre']; ?></option>
            <?php
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
            ?>
                <option value="<?php echo $filaP2a['id']; ?>"><?php echo $filaP2a['nombre']; ?></option>
            <?php
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
            ?>
                <option value="<?php echo $filaP2a['id']; ?>"><?php echo $filaP2a['nombre']; ?></option>
            <?php
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
            ?>
                <option value="<?php echo $filaP2a['id_proveedores']; ?>"><?php echo $filaP2a['nombre_comercial']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>

<div class="row mb-2">

    <div class="col-md-3">
        <label style="font-size: 11px;">Fecha de Instalación:</label>
        <input type="date" class="form-control" name="fchinstalacion" id="fchinstalacion" value=""></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Valor:</label>
        <input type="number" class="form-control" name="valor" id="valor" value=""></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Seguro:</label>
        <select class="form-control" aria-label="Default select example" name="seguro" id="seguro">
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
        <input type="number" class="form-control" name="valor_seguro" id="valor_seguro" value="">
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Garantia:</label>
        <select class="form-control" aria-label="Default select example" name="garantia" id="garantia">
            <option selected="true" disabled="disabled"></option>
            <option value="S">SI</option>
            <option value="N">NO</option>
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Fecha expiracion Garantia:</label>
        <input type="date" class="form-control" name="fchexpgarantia" id="fchexpgarantia" value=""></input>
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
            ?>
                <option value="<?php echo $filaP2a['id_proveedores']; ?>"><?php echo $filaP2a['nombre_comercial']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>


<div class="row">

    <div class="col-md-3">
        <label style="font-size: 11px;">Metodo de Depreciación:</label>
        <select class="form-control" aria-label="Default select example" name="metdepreciacion" id="metdepreciacion">
            <option selected="true" disabled="disabled"></option>
            <option value='1'>Metodo de la Linea Recta</option>
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size: 11px;">Vida útil en años:</label>
        <input type="number" class="form-control" name="vidautilmes" id="vidautilmes" value=""></input>
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
                    url: '/cw3/conlabweb3.0/apps/activofijo/crud-2.php?aux=1',
                    data: $('#formAddActivos').serialize(),
                    success: function(respuesta) {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Registro Exitoso",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.content-table').load('/cw3/conlabweb3.0/apps/activofijo/tabla.php');
                        $('#modalAddActivoFijo').modal('hide');
                    }
                });
            }
        });
        $('#formAddActivos').validate({
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