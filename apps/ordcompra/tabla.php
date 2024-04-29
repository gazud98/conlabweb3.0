<?php
//SI POSEE CONSUKTA

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
    if (isset($_REQUEST['ide'])) {
        $ide = $_REQUEST['ide'];
    } else {
        $ide = 0;
    }


    $cadena23 = "SELECT count(id) as max
    FROM u116753122_cw3completa.cotizacion_insumos 
    where id_producto='" . $ide . "' 
    and estado_cot='PO'";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }
?>
    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="tb">
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Referencia</th>
                <th>Valor</th>

            </tr>
        </thead>
        <tbody>

            <?php
            /* */
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT a.id,a.id_proveedor,a.id_producto,a.precio,b.nombre_comercial,a.estado,a.cantidad
            FROM  u116753122_cw3completa.cotizacion_insumos a, u116753122_cw3completa.proveedores b
            where b.id_proveedores=a.id_proveedor
            and a.id_producto=" . $ide . "
            and a.estado_cot='PO'
           ";
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id = trim($filaP2['id']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $nombre = $filaP2['nombre_comercial'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $precio = $filaP2['precio'];
                    $id_producto = $filaP2['id_producto'];
                    $id_proveedor = $filaP2['id_proveedor'];
                    $cantidad = $filaP2['cantidad'];
                    $estado = $filaP2['estado'];
                    $thefile = $thefile + 1;

                    echo '<tr  id="col' . $thefile . '"';
                    echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '"';
                    echo '>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick=" selectthefile('  . trim($thefile) . ',' . trim($id) . ')"  data-toggle="modal" data-target="#modalord"';
                    echo '>';
                    echo '<input type="radio" nombre_prov="' . $nombre . '" id_producto="' . $id_producto . '" cant="' . $cantidad . '" precio="' . $precio . '"name="fileselect' . $thefile . '" id="fileselect' . $thefile . '"
                             value="' . $id . '"" id_proveed="' . $id_proveedor . '" max="' . $max . '" style="display:none;" >';
                    echo $nombre;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo 'id="celda"';
                    echo ' onclick=" selectthefile('  . trim($thefile) . ',' . trim($id) . ')"   data-toggle="modal" data-target="#modalord"';
                    echo '>';
                    echo $id_producto;
                    echo '</td>';


                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick=" selectthefile('  . trim($thefile) . ',' . trim($id) . ')"  data-toggle="modal" data-target="#modalord"';
                    echo '>';
                    echo $precio;
                    echo '</td>';





                    echo '</tr>';
                }
            }
            /**/
            ?>

        </tbody>
    </table>
    <style>

    </style>


    <div class="modal modal-fullscreen fade" id="modalord">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!--  Header -->
                <div class="modal-header" style="text-align: center;">


                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modalshow" name="modalshow">

                    <div class="row" id="tbmodal" style="height: 500px">
                        <?php include("talbemodal.php") ?>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="agregarOrden()">Agregar Orden</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function selectthefile(thefile, id) {

            var theobject = "fileselect" + thefile;

            var id_prod = $('input[name="' + theobject + '"]').attr('id_producto');
            var precio = $('input[name="' + theobject + '"]').attr('precio');
            var id_proveed = $('input[name="' + theobject + '"]').attr('id_proveed');
            var nombre_prov = $('input[name="' + theobject + '"]').attr('nombre_prov');
            var max = $('input[name="' + theobject + '"]').attr('max');

            for (let i = 1; i <= max; i++) {
                $('#col' + [i]).css("border", "thin solid  transparent");
            }
            $('#col' + thefile).css("border", "4px groove #dc3545");



            $("#nom_proveed").text(nombre_prov);
            $("#id_prodc").text(id_prod);
            $("#prec").text(precio);

            $("#tbmodal").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/talbemodal.php", {
                id: id
            });
        }

        function agregarOrden() {


            var id = $('input[name="idcot"]').val();
            var id_prov = $('input[name="idcot"]').attr('id_prove');
            var id_prod = $('input[name="idcot"]').attr('id_prod');
            var cant = $('input[name="idcot"]').attr('can');
            var precio = $('input[name="idcot"]').attr('precio');


            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/ordcompra/crud.php',
                data: {
                    id: id,
                    id_prov: id_prov,
                    id_prod: id_prod,
                    cant: cant,
                    precio: precio
                },
                success: function(data) {
                    $("#table1").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/tabla_detalle.php", {
                        id_prov: id_prov,
                        id_prod: id_prod
                    })
                    $("#table").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/tabla.php", {
                        ide: id_prod
                    });
                    $("#dt").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/data.php");
                    alert('Se agrego correctamente');
                }
            })


        }

        function mostrarOrden(idorden) {

            $("#ord").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/verorden.php", {
                idorden: idorden
            });

        }
    </script>

<?php } ?>