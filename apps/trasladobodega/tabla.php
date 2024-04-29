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
    if (isset($_REQUEST['id_prodc'])) {
        $id_prodc = $_REQUEST['id_prodc'];
        if ($id_prodc == "-1") {
            $id_prodc = "";
        }
    } else {
        $id_prodc = 0;
    }

    $cadena23 = "SELECT count(idbodegaentrapanio) as max 
    FROM u116753122_cw3completa.bodegaubcproducto where idproducto='" . $id_prodc . "' and identrepanio<>0;";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }
    $cadena = "SELECT a.idbodegaentrapanio,a.idproducto,a.identrepanio,d.id as idstand,e.id as idbodega,c.nombre as entrepanio,d.nombre as stand,e.nombre as bodega,a.fchvence, SUM(a.cant_recibida) as cant,b.nombre 
    FROM u116753122_cw3completa.bodegaubcproducto a JOIN u116753122_cw3completa.producto b ON a.idproducto = b.id_producto JOIN u116753122_cw3completa.bodegaentrepanio c 
    ON a.identrepanio = c.id JOIN u116753122_cw3completa.bodegastand d ON c.idstand = d.id JOIN u116753122_cw3completa.bodegas e ON d.idbodega = e.id 
    WHERE a.identrepanio <> 0 AND a.cant_recibida <> 0 AND a.idproducto = " . $id_prodc . " GROUP BY a.fchvence,a.identrepanio ORDER BY a.fchvence ASC;";


    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);

?>

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />


    

    <table class="table table-striped table responsive  table-hover table-head-fixed text-nowrap table-sm table-bodega" style="margin-top: 2%;width:100%;">
        <thead>
            <tr>
                <th><i class="fa-solid fa-user-check"></i></th>
                <th style="text-align:center;">Codigo</th>
                <th style="text-align:center;">Referencia</th>
                <th style="text-align:center;">Insumo</th>
                <th style="text-align:center;">Bodega</th>
                <th style="text-align:center;">Estante</th>
                <th style="text-align:center;">Entrepaño</th>
                <th style="text-align:center;">Cantidad</th>
                <th style="text-align:center;">Fecha Vencimiento</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#id_producto').select2({
                language: "es"
            });
        });
        $(document).ready(function() {
            var miDataTable; // Declara la variable del DataTable fuera de $(document).ready

            // Agrega un listener de eventos para el cambio en el campo <select>



            miDataTable = $('.table-bodega').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "destroy": true,
                "searching": false,
                // ... Otras opciones ...
                "ajax": {
                    url: 'https://cw3.tierramontemariana.org/apps/trasladobodega/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                    data: function(d) {

                        d.id_prodc = $('#id_producto2').val();
                    },
                },

                "columns": [{
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<input type="radio" onclick="selectthefile3(' + full.thefile + ')"  name="fileselect3" id="fileselect3' + full.thefile + '" value="' + full.idproducto + '"  nom_insumo="' + full.nombre + '"     cant="' + full.cant + '" fchvence="' + full.fchvence + '"  max="' + <?php echo $max ?> + '"  identrepanio="' + full.identrepanio + '"  >';
                        }
                    },
                    {
                        "data": "idproducto"
                    },
                    {
                        "data": "referencia"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "bodega"
                    },
                    {
                        "data": "stand"
                    },
                    {
                        "data": "entrepanio"
                    },
                    {
                        "data": "cant"
                    },
                    {
                        "data": "fchvence"
                    },
                ]
            });
            $('#id_producto2').keyup(function() {
                miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
            });
        });



        function selectthefile3(thefile) {

            var theobject = "fileselect3" + thefile;
            var id_produ = $('#' + theobject).val();
            var nom_insumo = $('#' + theobject).attr('nom_insumo');
            var cant = $('#' + theobject).attr('cant');
            var fchvence = $('#' + theobject).attr('fchvence');
            var max = $('#' + theobject).attr('max');
            var identrepanio = $('#' + theobject).attr('identrepanio');

            for (let i = 1; i <= thefile; i++) {
                $('#' + [i]).prop('checked', false);
            }
            $('#' + theobject).prop('checked', true);


            $("#btntrl").load("https://cw3.tierramontemariana.org/apps/trasladobodega/trasladobodega.php", {
                id_produ: id_produ,
                nom_insumo: nom_insumo,
                cant: cant,
                fchvence: fchvence,
                identrepanio: identrepanio
            });
        }
    </script>

<?php } ?>