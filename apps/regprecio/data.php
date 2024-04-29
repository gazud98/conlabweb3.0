<?php

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $cadena = "SELECT id_proveedor,
    FROM  u116753122_cw3completa.registro_precios
    where 1=1";
// echo $cadena;
/**/
$resultadP2 = $conetar->query($cadena);
$numerfiles2 = mysqli_num_rows($resultadP2);
$id_proveedor = trim($filaP2['id_proveedor']);

?>
    <form id="formcontrol" action="" method="post" style="width:100%" enctype="multipart/form-data">
        <div class="row" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label>Proveedor</label>
                <select class="form-control" name="id_empleado" id="id_empleado">
                    <?php
                    $cadena = "SELECT id_proveedores, nombre_comercial
                                                    FROM u116753122_cw3completa.proveedores
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";
                            if (trim($filaP2a['id_proveedores']) == $id_proveedor) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre_comercial'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 col-lg-4 ">
                <label>Insumo</label>
                <input type="input" class="form-control" name="insumo" id="insumo" required></input>
            </div>

        </div>
        <div class="row" style="width:100%;">
            <div class="col-md-2 col-lg-2 ">
                <label>Cantidad</label>
                <input type="input" class="form-control" name="cantidad" id="cantidad" required></input>
            </div>
            <div class="col-md-2 col-lg-2 ">
                <label>Fecha</label>
                <input type="date" class="form-control" name="fecha" id="fecha" required></input>
            </div>
            <div class=" col-md-3 col-lg-3">
                <button type="submit" value="Enviar" class="btn btn-outline-primary" id="envio" style="margin:15% 0% 0% 0%;">Agregar Insumo</button>
            </div>
        </div>

    </form>

<?php } ?>