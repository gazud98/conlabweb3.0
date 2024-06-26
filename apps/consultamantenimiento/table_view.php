<table class="table table-borderless table-hover table-bordes-d table-correctivo " id="tablecorrectivo">
    <thead>
        <tr>
            <th style="text-align: center; width:20%;">Equipo</th>
            <th style="text-align: center; width:20%;">Descripcion</th>
            <th style="text-align: center;">Sede</th>
            <th style="text-align: center;">Departamento</th>
            <th style="text-align: center;">Area</th>
            <th style="text-align: center;">Responsable</th>
            <th style="text-align: center;">Fecha Inicio</th>
            <th style="text-align: center;">Fecha Final</th>
            <th style="text-align: center;">Tipo Mantenimiento</th>
            <th style="text-align: center;">Estado</th>
        </tr>
    </thead>
    <tbody>


    </tbody>
    <tfoot>

    </tfoot>
</table>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {


        miDataTable = $('.table-correctivo').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                url: 'https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '',
                data: function(d) {

                    //d.nosolicitud = $('#nosolicitud').val();
                    d.tipman = $('#tipman').val();
                    d.fecha1 = $('#fecha1').val();
                    d.fecha2 = $('#fecha2').val();
                    d.estado = $('#estado').val();
                    d.sede = $('#sede').val();
                    d.activo = $('#activo').val();
                    d.year = $('#sel1').val();
                },
            },
            "columns": [{
                    "data": "nombre"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "nombre_sede",
                },
                {
                    "data": "nombre_departamento"
                },
                {
                    "data": "nombre_area"
                },
                {
                    "data": "responsable"
                },
                {
                    "data": "fecha_inicio"
                },
                {
                    "data": "fecha_final"
                },
                {
                    "data": "tipo_mantenimiento"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        // Aquí puedes aplicar estilos o clases CSS según el valor de la propiedad "estado"
                        if (full.estado === "2") {
                            return '<span style=" color: red;" id=""estado><span class="badge badge-danger">Vencido</span></span>';
                        } else if (full.estado === "1") {
                            return '<span style=" color: green;" id=""estado><span class="badge badge-success">Pendiente</span></span>';
                        } else if (full.estado === "3") {
                            return '<span style=" color: green;" id=""estado><span class="badge badge-warning">Reprogramado</span></span>';
                        }
                        else if (full.estado === "4") {
                            return '<span style=" color: green;" id=""estado><span class="badge badge-info">Finalizado</span></span>';
                        }
                    }
                },
            ],
        });
        $('#button-fil').click(function() {
            miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        });
    })
</script>