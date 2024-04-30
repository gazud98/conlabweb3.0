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

    if (isset ($_REQUEST['idr'])) {
        $idr = $_REQUEST['idr'];
        if ($idr == "-1") {
            $idr = "";
        }
    } else {
        $idr = 0;
    }


    $cadena23 = "SELECT count(a.id) as max 
   FROM  u116753122_cw3completa.ordrequisicion_detalle a ,u116753122_cw3completa.producto b 
                    where a.id_producto = b.id_producto
                    and a.id_req = '" . $idr . "' order by 1";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }

    $cadenax = "SELECT b.nombre,a.cantidad,a.id_req,a.id_producto,a.id
                    FROM  u116753122_cw3completa.ordrequisicion_detalle a ,u116753122_cw3completa.producto b 
                    where a.id_producto = b.id_producto
                    and a.id_req = '" . $idr . "' order by 1";
    // echo $cadena;
    /**/

    $resultadP2x = $conetar->query($cadenax);
    $numerfiles2x = mysqli_num_rows($resultadP2x);
}
?>

<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" style="margin-top: 2%;">
    <thead>
        <tr style="font-size:0.9rem;">
            <th style="text-align:center;width:25%;">Insumo</th>
            <th style="text-align:center;width:35%;">Asignar Proveedor</th>
            <th style="text-align:center;">Cantidad</th>
            <th style="text-align:center;width:30%;">Precios</th>
            <th></th>
        </tr>
    </thead>
    <?php
    if ($numerfiles2x >= 1) {
        $thefile = 0;
        while ($filaP2x = mysqli_fetch_array($resultadP2x)) {
            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
            $nombre_producto = $filaP2x['nombre'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
            $id_req = $filaP2x['id_req'];
            $id_producto = $filaP2x['id_producto'];
            $cantidad = $filaP2x['cantidad'];
            $id = $filaP2x['id'];

            $thefile = $thefile + 1;

            echo '<tr id="col' . $thefile . '"';


            echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '" ';
            echo '>';

            echo '<td style="font-size:0.8rem;display:none"';
            echo ' onclick=" selectthefile1(' . trim($thefile) . ')"';
            echo '>';
            echo '<input type="radio"  name="fileselect1' . $thefile . '" id="fileselect1' . $thefile . '"
                         checked       max="' . $max . '" id_producto="' . $id_producto . '" cantidad="' . $cantidad . '" id_req="' . $id_req . '"   nom_insumo="' . $nombre_producto . '" style="display:none;" >';
            echo '</td>';

            echo '<td style="font-size:0.9rem; "';
            echo 'id="celda"';
            echo ' onclick=" selectthefile(' . trim($thefile) . ')" ';
            echo '>';
            echo $nombre_producto;
            echo '</td>';


            echo '<td style="font-size:0.9rem;"';
            echo ' onclick=" selectthefile(' . trim($thefile) . ')"  ';
            echo '>';
            echo '
            <select class="form-control id_proveedor"  name="id_proveedor' . trim($thefile) . '" id="id_proveedor' . trim($thefile) . '" style="background-color: #fff;
            border: 1px solid #aaa;width:300px;
             border-radius: 4px;height: 28px;" onchange="validarCampos()">
            <option value=""></option>';
            $cadena = "SELECT id_proveedores, nombre_comercial
                                    FROM u116753122_cw3completa.proveedores
                                    where estado='1'";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    $id_proveedor = trim($filaP2['id_proveedores']);
                    echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";

                    echo '>' . $filaP2a['nombre_comercial'] . "</option>";
                }
            }

            echo '</select>';
            echo '<div id="errorform' . trim($thefile) . '"></div>';
            echo '</td>';

            echo '<td style="font-size:0.9rem; text-align:center;"';
            echo ' onclick=" selectthefile(' . trim($thefile) . ')"';
            echo '>';
            echo '<input type="number" style="text-align:center;" id="cant1' . $thefile . '" value="' . $cantidad . '" onchange="updateCant(' . $thefile . ',' . $id_req . ',' . $id . ')">';
            echo '</td>';


            echo '<td style="font-size:0.9rem;"';
            echo '>';
            echo '
            <select class="form-control"  style="background-color: #fff;
            border: 1px solid #aaa;
             border-radius: 4px;height: 28px;font-size:0.9rem;"">
            <option value=""></option>';
            $cadena = "SELECT o.id, o.valor_total, p.nombre_comercial FROM orden_compradetalle o, proveedores p, orden_compra od WHERE o.id_ordencompra = od.id AND od.id_proveedor = p.id_proveedores AND id_producto = " . $id_producto . " ORDER BY id DESC";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {

                    echo "<option value='" . trim($filaP2a['id']) . "'";

                    echo '>' . $filaP2a['valor_total'] . ' -- ' . $filaP2a['nombre_comercial'] . "</option>";
                }
            }

            echo '</select>';
            echo '<div id="errorform' . trim($thefile) . '"></div>';
            echo '</td>';

            echo '<td style="font-size:0.9rem; text-align:center;"';
            echo '>';
            echo '<a href="#" onclick="borrar(' . $id . ', \'' . $nombre_producto . '\')" style="color: #CE2222;" title="Eliminar"><i id="icon" style="font-size:18px;" class="fa-solid fa-trash-can"></i></a>';
            echo '</td>';



            echo '</tr>';
        }
    }
    /**/
    ?>

    </tbody>
</table>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.id_proveedor').select2({
            language: "es"
        });

    });

    function validarCampos() {
        $("#btnsave").removeAttr('disabled');

    }


    function updateCant(thefile, id, id_det) {
        var objeto = "#cant1" + thefile;
        var cantm = $(objeto).val();

        $.ajax({
            type: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/cotizacion/actualizarcant.php',
            data: {
                cantm: cantm,
                id: id_det
            },
            success: function (respuesta) {
                $("#table").load('https://conlabweb3.tierramontemariana.org/apps/cotizacion/tabla.php', {
                    idr: id
                });
                Swal.fire({
                    icon: 'success',
                    title: '¡Satisfactorio!',
                    text: '¡Cantidad Actualizada con Exito!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    timer: 1500,
                });
            }
        });
    }

    function borrar(id, nombre_producto) {
        Swal.fire({
            title: '¿Estas Seguro que quieres borrar el producto ' + nombre_producto + '?',
            text: "¡Esto es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borralo!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Borrado!',
                    'El Producto ' + nombre_producto + ' ha sido borrado con Exito!',
                    'success'
                )

                $.ajax({
                    type: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/cotizacion/eliminar.php',
                    data: {
                        id: id,
                        status: 'I'
                    },
                    success: function (data) {



                        $("#table").load("https://conlabweb3.tierramontemariana.org/apps/cotizacion/tabla.php", {
                            idr: <?php echo $idr ?>
                        });

                    }
                });
            }
        })
    }

    function selectthefile(thefile) {
        var theobject = "fileselect1" + thefile;
        //elementoActivo.checked = true;

        //  id = elementoActivo.value;


        var nombre_producto = $('input[name="' + theobject + '"]').attr('nom_insumo');


        /*   $("#btndtl").load("https://conlabweb3.tierramontemariana.org/apps/cotizacion/eliminar.php", {
               id_cot1: id_cot1,
               nombre_producto: nombre_producto
           });*/

    }

    function recorrer2() {
        var max = $('input[name="fileselect11"]').attr('max');

        for (let i = 1; i <= max; i++) {

            var id_producto = $('input[name="fileselect1' + i + '"]').attr('id_producto');
            var cantidad = $('input[name="fileselect1' + i + '"]').attr('cantidad');
            var id_req = $('input[name="fileselect1' + i + '"]').attr('id_req');
            var id_proveedor = $('#id_proveedor' + i).val();

            //ejecutar(id_producto, cantidad, id_req, id_proveedor);

        }

    }

    function previa() {
        var max = $('input[name="fileselect11"]').attr('max');

        var miArray = [];
        for (let i = 1; i <= max; i++) {

            var id_producto = $('input[name="fileselect1' + i + '"]').attr('id_producto');
            var cantidad = $('input[name="fileselect1' + i + '"]').attr('cantidad');
            var id_req = $('input[name="fileselect1' + i + '"]').attr('id_req');
            var id_proveedor = $('#id_proveedor' + i).val();




            miArray.push({
                id_producto: id_producto,
                idreq: id_req,
                id_proveedor: id_proveedor
            });
            // Mostrar los valores acumulados





        }

        var datosJSON = JSON.stringify(miArray);

        console.log(datosJSON);

        $("#modalshow").load("https://conlabweb3.tierramontemariana.org/apps/cotizacion/modal-2.php", {
            datos: datosJSON,
            id_req: id_req
        });



    }

    function recorrer() {
        var max = $('input[name="fileselect11"]').attr('max');

        for (let i = 1; i <= max; i++) {

            var id_producto = $('input[name="fileselect1' + i + '"]').attr('id_producto');
            var cantidad = $('input[name="fileselect1' + i + '"]').attr('cantidad');
            var id_req = $('input[name="fileselect1' + i + '"]').attr('id_req');
            var id_proveedor = $('#id_proveedor' + i).val();

            ejecutar(id_producto, cantidad, id_req, id_proveedor);


        }
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: '¡Cotizacion Generada Con Exito!',
            showConfirmButton: false,
            timer: 1500
        })

    }

    function ejecutarOrdenes(id_req, id_proveedor) {

        $.ajax({
            type: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/cotizacion/generadocotizacion.php',
            data: {
                id_req: id_req
            },
            success: function (data) {

                $("#table").load("https://conlabweb3.tierramontemariana.org/apps/cotizacion/tabla.php", {
                    idr: id_req
                });

                cargarDatos();


            }
        });
    }

    function sendMail() {
        $.ajax({
            method: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/cotizacion/send_mail.php',
            success: function (respuesta) {
                $('.loader-ajax').removeClass('active');
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: respuesta,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    }

    function ejecutar(id_producto, cantidad, id_req, id_proveedor) {

        var idusersend = $('#idusersend').val()

        $.ajax({
            type: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/cotizacion/crud.php',
            data: {
                id_producto: id_producto,
                cantidad: cantidad,
                id_req: id_req,
                id_proveedor: id_proveedor,
                idusersend: idusersend
            },
            success: function (data) {
                ejecutarOrdenes(id_req, id_proveedor);

            }
        })

    }
</script>