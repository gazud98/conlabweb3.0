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
} else {

    if (isset($_REQUEST['user'])) {
        $user = $_REQUEST['user'];
    }
}
?>

<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<style>
    #tableVisitas {
        border: 1px solid #d2d2d2;
        border-radius: 10px;
        font-size: 14px;
        text-align: center;
    }

    table.table tr td {
        border-top: 1px solid #d2d2d2;
        padding: 2px !important;
    }
</style>

<table class="table table-borderless table-hover" style="margin-top: 2%;" id="tableVisitas">
    <thead>
        <tr>
            <th style="text-align: center;">Ejecutivo (a) comercial</th>
            <th style="text-align: center;">Fecha y Hora</th>
            <!--<th>Empresa/Médico/Persona Natural</th>-->
            <th style="text-align: center;">Medico</th>
            <th style="text-align: center;">Acciones</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>


<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>


<script>
    $(document).ready(function() {

        $('#filterAsesorx').load('/cw3/conlabweb3.0/apps/consultavisitas/filter-asesorx.php');

        miDataTableVisitas = $('#tableVisitas').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                url: '/cw3/conlabweb3.0/apps/consultavisitas/mostrar-1.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '',
                data: function(d) {

                    d.fecha1 = $('#fecha1').val();
                    d.fecha2 = $('#fecha2').val();
                    d.aseco = $('#aseco').val();

                }
            },
            "columns": [{
                    "data": "vendedor"
                },
                {
                    "data": "fechainicio"
                },
                {
                    "data": "medico"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<button type="button" class="btn btn-secondary btn-sm" onclick="getMap('+full.id+')" data-toggle="modal" data-target="#modalMap">Revisar <i class="fa-solid fa-paperclip" style="font-size: 13px"></i></button>'
                    }
                }
            ],

        })

        $('#btnFilter2').click(function() {
            //alert($('#fecha_f').val());
            miDataTableVisitas.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        });

    });
</script>