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

?>
   
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
   
    <table class="table table-striped table-hover table responsive  table-head-fixed text-nowrap table-sm" id="tb" style="width:100%;
                ">
        <thead>
            <tr>
                <th style="text-align:center;"><i class="fa-solid fa-user-check"></i></th>
                <th style="text-align:center;">No. Solicitud</th>
                <th style="text-align:center;width:60%;">Proveedor</th>
                <th style="text-align:center;">Fecha</th>

            </tr>
        </thead>
        <tbody>



        </tbody>
    </table>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            miDataTable = $('#tb').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": {
                    url: 'https://cw3.tierramontemariana.org/apps/consulcotizacion/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                },
                "columnDefs": [
            {
                "targets": [2], // Índice de la columna a la que aplicarás el ajuste
                "width": "100px" // Ancho personalizado para la columna
            },
            // Puedes agregar más definiciones de columnas aquí si es necesario
        ],
                "columns": [{
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<input type="radio" onclick="selectthefile1(' + full.thefile + ')" name="fileselect" id="fileselect' + full.thefile + '" value="' + full.codigo + '">';
                        }
                    }, {
                        "data": "norequisicion"
                    },
                    {
                        "data": "nombre",
                    },
                    {
                        "data": "fecha"
                    }
                ]
            });
        });

        function cargarDatos() {
            $.ajax({
                url: 'https://cw3.tierramontemariana.org/apps/consulcotizacion/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                success: function(data) {
                    // Limpiar el DataTable y cargar los nuevos datos
                    miDataTable.clear().rows.add(data).draw();
                },
                error: function(xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error('Error al obtener datos:', status, error);
                }
            });
        }

        function selectthefile1(thefile) {
            var theobject = "fileselect" + thefile;
            //elementoActivo.checked = true;

            //  id = elementoActivo.value;

            var id = $('#' + theobject).attr('value');
            var max = $('#' + theobject).attr('max');

            var numorden = $('#' + theobject).attr('numorden');

            for (let i = 1; i <= thefile; i++) {
                $('#' + theobject).prop('checked', false);
            }
            $('#' + theobject).prop('checked', true);

            $("#data1").load("https://cw3.tierramontemariana.org/apps/consulcotizacion/data.php", {
                id: id
            });
            $('#ordeccomp').attr('disabled', false);
        }
    </script>

<?php } ?>