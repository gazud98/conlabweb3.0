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

    //$user = $_SESSION['id_users'];
}

?>
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />




<table class="table table-tareas-f" style="width: 100%;">
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


<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {
        miDataTablef = $('.table-tareas-f').DataTable({
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
                url: '/cw3/conlabweb3.0/apps/gestiontareas/mostrar-6.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                data: function(d) {
                    d.id = $('#responsableh').val();
                }
            },
            "columns": [

                {
                    "data": "id_tarea"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {

                        if (full.estado == 2) {
                            estado = '<span class="badge badge-warning">En Proceso</span>'
                        } else if (full.estado == 3) {
                            estado = '<span class="badge badge-dark">Cerrado</span>'
                        } else if (full.estado == 1) {
                            estado = '<span class="badge badge-danger">Vencida</span>'
                        }

                        return '<div class="row">' +
                            '<div class="col-md-7" style="font-size: 15px;">' +
                            '<label for="">Tarea:</label>' +
                            '<p>' + full.tarea + '</p>' +
                            '<span><strong>Fecha inicio:</strong> <span>' + full.fecha_inicio + '</span></span>&nbsp;&nbsp;' +
                            '<span><strong>Fecha Vencimiento:</strong> <span>' + full.fecha_fin + '</span></span>&nbsp;&nbsp;' +
                            '<span><strong>Responsable:</strong> <span>' + full.responsable + '</span></span>&nbsp;&nbsp;<br>' +
                            '<span><strong>Estado:</strong>***</span>' +
                            '</div>' +
                            '<div class="col-md-5" style="font-size: 15px; text-align:right;">' +
                            '<span><strong>Fecha de Creación:</strong> <span>' + full.fecha_creacion + '</span></span>&nbsp;&nbsp;' +
                            '<span><strong>Usuario:</strong> <span>' + full.usuario + '</span></span>&nbsp;&nbsp;<br>' +
                            '<span><strong>Prioridad:</strong> <span class="badge badge-danger">Alta</span></span>' +
                            '</div>' +
                            '</div>'
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<button type="button" onclick="getComments(' + full.id_tarea + ')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleNotas"><i class="fa-solid fa-comment">&nbsp;&nbsp;<span class="badge badge-light">0</span></i></button>' +
                            '&nbsp;&nbsp;<button type="button" onclick="getEstado(' + full.id_tarea + ')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEditEstado"><i class="fa-solid fa-pen-to-square"></i></button>';
                    }
                }
            ]
        });
        $('#btnSearchh').click(function() {
            miDataTablef.ajax.reload();
        })
    });


    function cargarDatosf() {
        $.ajax({
            url: '/cw3/conlabweb3.0/apps/gestiontareas/mostrar-6.php', // Página PHP que devuelve los datos en formato JSON
            type: 'GET', // Método de la petición (GET o POST según corresponda)
            dataType: 'json', // Tipo de datos esperado en la respuesta
            success: function(data) {
                // Limpiar el DataTable y cargar los nuevos datos
                miDataTablef.clear().rows.add(data).draw();
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error('Error al obtener datos:', status, error);
            }
        });
    }
</script>