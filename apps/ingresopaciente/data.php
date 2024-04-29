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
    <div class="row pb-3">

        <div class="col-md-3 col-lg-3">
            <label>Escanear etiqueta:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-barcode"></i></span>
                </div>
                <input type="text" class="form-control" name="id_producto2" id="id_producto2" autocomplete="off" autofocus>
            </div>
        </div>

        <!--<div class="col-md-3 col-lg-3">
            <label>Producto</label>
            <select class="form-control" name="id_producto" id="id_producto">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT distinct a.idproducto, b.nombre
                       FROM u116753122_cw3completa.bodegaubcproducto a , u116753122_cw3completa.producto b
                       where a.idproducto=b.id_producto and a.identrepanio<>0 and a.cant_recibida<>0";

                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {

                        echo "<option value='" . trim($filaP2a['idproducto']) . "' ";

                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-1 col-lg-1" style="margin-top:5px;">
            <label></label>
            <button type="button" value="Filtrar" style="
                 border: 1px solid #aaa;
                  border-radius: 4px;height: 28px; background-color: rgb(0,69,165);color:white;font-size: 13px;" id="button-fil"><i class="fa-solid fa-filter"></i> Buscar Productos</button>
        </div>-->

    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_producto').select2({
                language: "es"
            });
        });

        function agregarx() {

            id_prodc = $('#numfactura').val();

            if (id_prodc == '') {
                $("#table").load("https://conlabweb3.tierramontemariana.org/apps/trasladodepartamento/tabla.php", {
                    id_prodc: ''
                });
            } else {
                $("#table").load("https://conlabweb3.tierramontemariana.org/apps/trasladodepartamento/tabla.php", {
                    id_prodc: id_prodc
                });
            }

        };
    </script>
<?php } ?>