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
?>
    <div class="container">
        <div class="row border mb-2">
            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                <label style="font-size:13px">Tipo de Mantenimiento:</label>
                <select name="tipman" id="tipman" class="form-control" style="font-size:13px; width:100%;height: 43%">
                    <option value=""></option>
                    <option value="C">Correctivo</option>
                    <option value="P">Preventivo</option>
                    <option value="%">Todos</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                <label style="font-size:13px">Equipo:</label>
                <select name="activo" id="activo" class="form-control select2" style="width:100%;">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_producto, nombre, estado FROM  u116753122_cw3completa.producto WHERE id_categoria_producto = 1";
                    $resultadP2 = $conetar->query($cadena);
                    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                        echo "<option value='" . trim($filaP2['id_producto']) . "'";
                        echo '>' . $filaP2['nombre'] . "</option>";
                    }
                    ?>
                    <option value="%">Todos</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                <label for="" style="font-size:13px">Año:</label>
                <?php
                $cont = date('Y');
                ?>
                <select id="sel1" class="form-control select2" style="width:100%;">
                    <option value="" selected disabled></option>
                    <option value="%">Todos</option>
                    <?php while ($cont >= 2000) { ?>
                        <option value="<?php echo ($cont); ?>"><?php echo ($cont); ?></option>
                    <?php $cont = ($cont - 1);
                    } ?>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                <label for="filtro" style="font-size:13px">Estado:</label>
                <select class="form-control" id="estado" name="estado" style="font-size:13px; width:100%;height: 43%">
                    <option selected="true" disabled="disabled"></option>
                    <option value="1">Pendientes</option>
                    <option value="3">Reprogramados</option>
                    <option value="2">Vencidos</option>
                    <option value="%">Todos</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                <label for="filtro" style="font-size:13px">Sede:</label>
                <select class="form-control select2" id="sede" name="sede" style="width:100%;">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_sedes, nombre FROM u116753122_cw3completa.sedes WHERE estado='1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                        echo "<option value='" . trim($filaP2a33['id_sedes']) . "'";
                        echo '>' . $filaP2a33['nombre'] . "</option>";
                    }
                    ?>
                    <option value="%">Todos</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                <label for="filtro" style="font-size:13px">Fecha Inicio:</label>
                <input type="date" class="form-control" id="fecha1" name="fecha1" style="width:100%;height: 43%;font-size:13px;">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                <label for="filtro" style="font-size:13px">Fecha Fin:</label>
                <input type="date" class="form-control" id="fecha2" name="fecha2" style="width:100%;height: 43%;font-size:13px;">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 align-self-end">
                <button type="button" class="btn btn-primary btn-sm w-100" value="Filtrar" id="button-fil"><i class="fa-solid fa-filter"></i> Filtrar</button>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 align-self-end">
                <button type="button" class="btn btn-success btn-sm w-100" value="Filtrar" id="button-clear"><i class="fa-solid fa-eraser"></i> Limpiar</button>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#button-clear').click(function() {
                $('#sel1').val('').trigger('change'); // Para select2
                $('#tipman').val('');
                $('#activo').val('').trigger('change'); // Para select2
                $('#sel1').val('');
                $('#estado').val('');
                $('#sede').val('').trigger('change'); // Para select2
                $('#fecha1').val('');
                $('#fecha2').val('');
                miDataTable.ajax.reload();
            });
        })
    </script>

<?php } ?>