<?php

if (isset($_REQUEST['fecha'])) {
    $fecha = $_REQUEST['fecha'];
    if ($fecha == "-1") {
        $fecha = "";
    }
} else {
    $fecha = 0;
}
if (isset($_REQUEST['hora'])) {
    $hora = $_REQUEST['hora'];
    if ($hora == "-1") {
        $hora = "";
    }
} else {
    $hora = 0;
}
?>
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<table class="table table-striped table-hover table-head-fixed table responsive  text-nowrap table-sm table-reportes-detalle">

    <thead>
        <tr>
            <th style="width:25%;">Descripcion</th>
            <th style="width:15%;">Valor</th>
            <th style="width:15%;">Tipo Costo</th>

        </tr>
    </thead>

    <tbody>

    </tbody>

</table>

<input type="hidden" id="variable1" value="<?php echo $fecha ?>">
<input type="hidden" id="variable2" value="<?php echo $hora ?>">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<!-- DataTables Buttons JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {

        miDataTable2 = $('.table-reportes-detalle').DataTable({
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
                url: '/cw3/conlabweb3.0/apps/costostotales/modal.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                "data": function(d) {
                    // Puedes agregar parámetros adicionales aquí si es necesario
                    d.fecha = $("#variable1").val();
                    d.hora = $("#variable2").val();

                }
            },
            "columns": [

                {
                    "data": "descripcion"
                },
                {
                    "data": "valor",
                },
                {
                    "data": "tipo_calculo"
                }

            ],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    orthogonal: 'export'
                },
                text: 'Exportar Excel',
                title: 'Reporte de Costos',
                autoFilter: true,
            }, ]
        })

    });
</script>