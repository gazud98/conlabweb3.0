<style>
    .dt-buttons .dt-button {
        border: none !important;
        background: #17AB00 !important;
        color: #fff !important;
    }
</style>

<table class="table table-bordered" id="tableListaProveedores">
    <thead>
        <tr>
            <th>Departamento</th>
            <th>Nombre Comercial</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Persona de contacto</th>
            <th>Teléfono de contacto</th>
            <th>Email de contacto</th>
            <th>Categoría</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<!-- DataTables Buttons JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>
    $(document).ready(function() {

        miDataTableReporte1 = $('#tableListaProveedores').DataTable({
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
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: 'Exportar PDF',
                    title: 'Reporte de de activos fijos',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    customize: function(doc) {
                        for (var row = 0; row < doc.content[1].table.headerRows; row++) {
                        var header = doc.content[1].table.body[row];
                        for (var col = 0; col < header.length; col++) {
                            header[col].fillColor = 'white';
                            header[col].color = 'black';
                            }
                        }
                        doc.content[1].layout = "borders";
                        doc.content.splice(1, 0, {
                            margin: [0, -38, 0, 15],
                            alignment: 'left',
                            width: 100,
                            heigth: 50,
                            image: 'data:image/png;base64,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'
                        });

                        var now = new Date();
                        var formattedDate = now.toLocaleString();
                        doc.content.unshift({
                            text: 'Fecha: ' + formattedDate,
                            alignment: 'right',
                            margin: [0, 0, 10, 10],
                            fontSize: 10
                        });

                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        orthogonal: 'export'
                    },
                    text: 'Exportar Excel',
                    title: 'Reporte de activos fijos',
                    autoFilter: true,
                },
            ],
            "ajax": {
                url: '/cw3/conlabweb3.0/apps/reporteproveedores/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '',
                data: function(d) {

                    d.dep = $('#dep').val();
                    d.cat = $('#cat').val();

                } 
            },
            "columns": [{
                    "data": "nombre_dep"
                },
                {
                    "data": "nombre_comercial"
                },
                {
                    "data": "direccion"
                },
                {
                    "data": "telefono"
                },
                {
                    "data": "email"
                },
                {
                    "data": "nombrec"
                },
                {
                    "data": "telefonoc"
                },
                {
                    "data": "emailc"
                },
                {
                    "data": "nombre_cat"
                },
                {
                    "data": "estado",
                    "render": function(data, type, full, meta) {
                        if (full.estado == 1) {
                            return '<span class="badge badge-success">Activo</span>';
                        } else if (full.estado == 2) {
                            return '<span class="badge badge-danger">Inactivo</span>';
                        }
                    }
                },
            ],

        });

        $('#btnSearh').click(function() {
            miDataTableReporte1.ajax.reload(); 
        });

    })
</script>