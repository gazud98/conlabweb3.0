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

    $ide = $_REQUEST['id'];
    $cadena23 = "SELECT count(id) as max
    FROM u116753122_cw3completa.orden_compradetalle where id_ordencompra =" . $ide;

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max1 = trim($filaP23['max']);
        }
    }


    //   $fechaActual = date("d/m/Y");
    //  echo  $fechaActual;
    $cadena = "SELECT a.id, a.fecha, a.hora, a.id_proveedor, b.nombre_comercial,b.numero_identificacion
    FROM  u116753122_cw3completa.orden_compra a, u116753122_cw3completa.proveedores b
    where a.id_proveedor=b.id_proveedores
    and a.id =" . $ide;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $thefile = 0;
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id = trim($filaP2['id']);
            $fecha = $filaP2['fecha'];
            $hora = $filaP2['hora'];
            $id_proveedor = $filaP2['id_proveedor'];
            $nombre_comercial = $filaP2['nombre_comercial'];
            $numero_identificacion = $filaP2['numero_identificacion'];
            $fecha = $filaP2['fecha'];
        }
?>
        <div class="row">
            <div class="col-md-12 col-lg-12" style="background-color:rgb(1,103,183);color:white;text-align:center;">
                <label style="margin-top: 4px;">Información Orden de Compra</label>
            </div>
        </div>
        <div class="row mt-2" style="width:100%;">
            <div class="col-md-2 col-lg-2">
                <label>Numero</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo  $id ?>" disabled></input>
            </div>
            <div class="col-md-2 col-lg-2 ">
                <label>Recibida</label>
                <input type="checkbox" class="form-control" name="descripcion" id="descripcion" value=" " disabled></input>
            </div>
            <div class="col-md-2 col-lg-2">
                <label>Fecha:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo  $fecha ?>" disabled>

            </div>
            <div class="col-md-2 col-lg-2">
                <label>Hora:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo  $hora ?>" disabled>

            </div>
            <div class="col-md-2 col-lg-2">
                <label>Plazo:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled>
            </div>
        </div>
        <div class="row mt-2" style="width:100%;">
            <div class="col-md-3 col-lg-3" id="tbd">
                <label>NIT Proveedor</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo  $numero_identificacion ?>" disabled>
            </div>
            <div class="col-md-6 col-lg-6" id="tbd">
                <label>Proveedor</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo  $nombre_comercial ?>" disabled>
            </div>


        </div>


    <?php }
    ?>
    <div class="row">
        <div class="col-md-12 col-lg-12 mt-2" style="background-color:rgb(1,103,183);color:white; text-align:center;">
            <label style="margin-top: 4px;">DETALLE DE ORDEN COMPRA</label>
        </div>
    </div>

    <div style=" overflow-x: hidden;
  overflow-y: scroll;" class="table-container">
        <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="tb">
            <thead>
                <tr>
                    <th>Cod</th>
                    <th>Descripción</th>
                    <th>Cant. Ordenada</th>
                    <th>Valor Unitario</th>
                    <th>Cant. Recibida</th>
                    <th>Valor Cant Recibida</th>
                    <th>Cant. Faltante</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $cadenax = "SELECT a.id_ordencompra,a.id_producto,a.cant_ordenada,b.nombre,a.valor_total
              FROM  u116753122_cw3completa.orden_compradetalle a, u116753122_cw3completa.producto b
             where b.id_producto=a.id_producto and  a.id_ordencompra =" . $ide;
                $resultadP2x = $conetar->query($cadenax);
                $numerfiles2x = mysqli_num_rows($resultadP2x);

                if ($numerfiles2x >= 1) {
                    $thefile = 0;
                    $saldo_total = 0;
                    while ($filaP2x = mysqli_fetch_array($resultadP2x)) {
                        $id_pro = trim($filaP2x['id_producto']);
                        $id_ordencompra = trim($filaP2x['id_ordencompra']);                             //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                        $nombre = $filaP2x['nombre'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                        $cant_ordenada = $filaP2x['cant_ordenada'];
                        $valor_total = $filaP2x['valor_total'];


                        $thefile = $thefile + 1;



                        $cadenay = "SELECT SUM(c.cant_recibida) as cant_recibida FROM u116753122_cw3completa.bodegaubcproducto c where c.id_orden = '" . $ide . "' and idproducto =" . $id_pro;
                        $resultadP2y = $conetar->query($cadenay);
                        $numerfiles2y = mysqli_num_rows($resultadP2y);

                        if ($numerfiles2y >= 1) {
                            while ($filaP2y = mysqli_fetch_array($resultadP2y)) {
                                $cant_recibida = trim($filaP2y['cant_recibida']);
                            }
                        }
                        $valorreci = intval($cant_recibida) * intval($valor_total);
                        $result =  intval($cant_ordenada) - intval($cant_recibida);

                        echo '<tr id="col1' . $thefile . '"';
                        echo ' name="thefileselected1' . trim($thefile) . '" id="thefileselected1' . trim($thefile) . '" ';
                        echo '>';

                        echo '<td style="font-size:0.8rem; "';
                        echo ' onclick=" selectthefile2('  . trim($thefile) . ')"';
                        echo '>';
                        echo '<input type="radio"  name="fileselect1' . $thefile . '" id="fileselect1' . $thefile . '"
                         nom="' . $nombre . '"  id_orde="' . $id . '" max1="' . $max1 . '" vtotal="' . $valor_total . '"   value="' . $id_pro . '" style="display:none;" >';
                        echo $id_pro;
                        echo '</td>';

                        echo '<td style="font-size:0.8rem; "';

                        echo ' onclick=" selectthefile2(' . trim($thefile)  . ')"  ';
                        echo '>';
                        echo $nombre;
                        echo '</td>';

                        echo '<td style="font-size:0.8rem; "';
                        echo ' onclick=" selectthefile2(' . trim($thefile) .  ')"  ';
                        echo '>';
                        echo $cant_ordenada;
                        echo '</td>';

                        echo '<td style="font-size:0.8rem;"';
                        echo ' onclick=" selectthefile2(' . trim($thefile) .  ')"  ';
                        echo '>';
                        echo number_format($valor_total);
                        echo '</td>';

                        echo '<td style="font-size:0.8rem; "';
                        echo ' onclick=" selectthefile2(' . trim($thefile) .  ')"  ';
                        echo '>';
                        echo $cant_recibida;
                        echo '</td>';

                        echo '<td style="font-size:0.8rem;"';
                        echo ' onclick=" selectthefile2(' . trim($thefile) .  ')"  ';
                        echo '>';
                        echo number_format($valorreci);
                        echo '</td>';

                        echo '<td style="font-size:0.8rem;color:red;"';
                        echo ' onclick=" selectthefile2(' . trim($thefile) .  ')"  ';
                        echo '>';
                        echo $result;
                        echo '</td>';

                        echo '</tr>';
                        $saldo_total =   $saldo_total + $valorreci;
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th  ><label>Total:</label></th>
                    <th  >
                      
                        <?php echo  number_format($saldo_total); ?>
                     
                    </th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>



    <style>
        .table-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            /* Alinea los elementos a la derecha */
            position: relative;
        }

        .total-div {
            background-color: #f5f5f5;
            /* Cambia el color de fondo si es necesario */
            padding: 10px;
            /* Ajusta el relleno según tus preferencias */
            border: 1px solid #ccc;
            /* Añade un borde si es necesario */
            margin-top: 10px;
            /* Ajusta el espacio superior según tus preferencias */
            align-self: flex-end;
            /* Alinea este elemento a la derecha dentro del contenedor flex */
        }
    </style>
    <script>
        function recibir() {

            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/recibirordenes.php',
                data: {
                    idc: <?php echo $id ?>,
                    fun: 'R'
                },
                success: function(data) {
                    $("#thetable").load("https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/thedatatable.php");
                }
            });
        }

        function parcialRecibida() {




            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/recibirordenes.php',
                data: {
                    idc: <?php echo $id ?>,
                    fun: 'PR'
                },
                success: function(data) {
                    $("#thetable").load("https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/thedatatable.php");
                }
            });
        }


        function selectthefile2(thefile) {
            var theobject = "fileselect1" + thefile;
            //elementoActivo.checked = true;

            //  id = elementoActivo.value;

            var idpr = $('input[name="' + theobject + '"]').attr('value');
            var nom = $('input[name="' + theobject + '"]').attr('nom');
            var id = $('input[name="' + theobject + '"]').attr('id_orde');
            var vtotal = $('input[name="' + theobject + '"]').attr('vtotal');
            var cant = $('input[name="' + theobject + '"]').attr('cant');
            var max1 = $('input[name="' + theobject + '"]').attr('max1');

            for (let i = 1; i <= max1; i++) {
                $('#col1' + [i]).css("border", "thin solid  transparent");
            }
            $('#col1' + thefile).css("border", "2px groove #dc3545");




            $("#btnedt").load("https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/editar.php", {
                idpr: idpr,
                id: id,
                vtotal: vtotal

            });

            $("#btndele").load("https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/borrar.php", {
                idpr: idpr,
                nom: nom,
                id: id
            });


        }
    </script>


<?php } ?>