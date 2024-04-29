<?php

if (file_exists("../config/accesosystems.php")) {
    include("../config/accesosystems.php");
} else {
    if (file_exists("../../config/accesosystems.php")) {
        include("../../config/accesosystems.php");
    }
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    } else {
        $id = 0;
    }

    $id_proveedor = "";
    $id_producto = "";
    $cantidad = "";
    $precio = "";
    $nombre_comercial = "";

    if ($id != "") {
        $cadena = "SELECT a.id,a.id_proveedor,a.id_producto,a.precio,b.nombre_comercial,a.estado,a.cantidad
    FROM  u116753122_cw3completa.cotizacion_insumos a, u116753122_cw3completa.proveedores b
    where b.id_proveedores=a.id_proveedor
    and a.id=" . $id;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id_proveedor = $filaP2['id_proveedor'];
            $id_producto = $filaP2['id_producto'];
            $cantidad = $filaP2['cantidad'];
            $nombre_comercial = $filaP2['nombre_comercial'];
            $precio = $filaP2['precio'];
        }
    }
?>
    <div class="col-md-7 col-lg-7">
        <table class="table">
            <thead>
                <tr>

                    <th>Proveedor</th>
                    <th>Referencia</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $nombre_comercial ?><input type="input" style="display: none;" id="idcot" name="idcot" value="<?php echo $id ?>" id_prove="<?php echo $id_proveedor ?>" id_prod="<?php echo $id_producto ?>" can="<?php echo $cantidad ?>" precio="<?php echo $precio ?>"></input></td>
                    <td><?php echo $id_producto   ?></td>
                    <td><?php echo $precio   ?></td>
                </tr>

            </tbody>
        </table>

        <div style="text-align: center;padding-top:8%;" >
            <label class="modal-title">Ordenes Anteriores</label>
        </div>
        <div style="max-height:80vh;  overflow-y:auto; ">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. Orden</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $nombre = "";
                     $fecha = "";
                     $idorden = "";
                     $hora = "";
                    $cadena3 = "SELECT a.id_proveedor,b.nombre_comercial,a.id ,a.fecha ,a.hora
                                               FROM u116753122_cw3completa.orden_compra a, u116753122_cw3completa.proveedores b 
                                               where b.id_proveedores=a.id_proveedor
                                               and a.id_proveedor='" . $id_proveedor . "'";

                    $resultadP23 = $conetar->query($cadena3);
                    $numerfiles23 = mysqli_num_rows($resultadP23);
                    if ($numerfiles23 >= 1) {
                        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
                            $nombre = $filaP23['nombre_comercial'];
                            $fecha = $filaP23['fecha'];
                            $idorden = $filaP23['id'];
                            $hora = $filaP23['hora'];
                            //$id_proveedor = $filaP23['id_proveedor'];

                    ?>
                            <tr>
                                <td><?php echo $idorden ?> </td>
                                <td><?php echo $nombre ?></td>
                                <td><?php echo $fecha ?></td>
                                <td><?php echo $hora ?></td>

                                <td><button class="btn btn-primary btn-xs" onclick="mostrarOrden(<?php echo $idorden ?>)">Ver Orden</button></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>

            </table>


        </div>
    </div>
    <div class="col-md-5 col-lg-5" id="ord" style="max-height: 500px; overflow-x: hidden; overflow-y: scroll;">
    </div>
<?php } ?>