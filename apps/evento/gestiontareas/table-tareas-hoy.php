<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

<div class="row" style="width: 100%;">
    <table class="table table-tareas" style="width: 100%;">
        <thead>
            <tr id="theadtaraeas">
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function(){
        miDataTable = $('.table-tareas').DataTable({
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
                url: '/cw3/apps/gestiontareas/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [

                {
                    "data": "id_tarea"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<div class="row">'+
                        '<div class="col-md-7" style="font-size: 15px;">'+
                            '<label for="">Tarea:</label>'+
                            '<p>'+full.tarea+'</p>'+
                            '<span><strong>Fecha inicio:</strong> <span>'+full.fecha_inicio+'</span></span>&nbsp;&nbsp;'+
                            '<span><strong>Fecha Vencimiento:</strong> <span>'+full.fecha_fin+'</span></span>'+
                            '<span><strong>Responsable:</strong> <span>'+full.responsable+'</span></span>'+
                            '<span><strong>Estado:</strong> <span class="badge badge-warning">Pendiente</span></span>'+
                        '</div>'+
                        '<div class="col-md-5" style="font-size: 15px; text-align:right;">'+
                            '<span><strong>Fecha de Creación:</strong> <span>'+full.fecha_creacion+'</span></span>'+
                            '<span><strong>Usuario:</strong> <span>'+full.usuario+'</span></span>'+
                            '<span><strong>Prioridad:</strong> <span class="badge badge-danger">Alta</span></span>'+
                        '</div>'+
                    '</div>'
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleNotas"><i class="fa-solid fa-comment">&nbsp;&nbsp;<span class="badge badge-light">0</span></i></button>';
                    }
                }
            ]
        })
    })
</script>