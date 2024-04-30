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

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        $("#search-tarea").load("/cw3/conlabweb3.0/apps/gestiontareas/search.php");

        $('#responsable').select2({
            language: "es"
        });

        miDataTableh = $('.table-tareas').DataTable({
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
                url: '/cw3/conlabweb3.0/apps/gestiontareas/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '',
                data: function(d) {
                    d.id = $('#responsableh').val();
                },
            },
            "columns": [

                {
                    "data": "id_tarea"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {

                        if (full.estado == 2) {
                            estado = '<span class="badge badge-success">En Proceso</span>'
                        } else if (full.estado == 3) {
                            estado = '<span class="badge badge-dark">Cerrado</span>'
                        } else {
                            estado = '<span class="badge badge-success">En Proceso</span>'
                        }

                        return '<div class="row">' +
                            '<div class="col-md-7" style="font-size: 15px;">' +
                            '<label for="">Tarea:</label>' +
                            '<p>' + full.tarea + '</p>' +
                            '<span><strong>Fecha inicio:</strong> <span>' + full.fecha_inicio + '</span></span>&nbsp;&nbsp;' +
                            '<span><strong>Fecha Vencimiento:</strong> <span>' + full.fecha_fin + '</span></span>&nbsp;&nbsp;' +
                            '<span><strong>Responsable:</strong> <span>' + full.responsable + '</span></span>&nbsp;&nbsp;<br>' +
                            '<span><strong>Estado:</strong>' + estado + '</span>' +
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

                        var rows = getRowsComments(full.id_tarea);

                        return '<button type="button" onclick="getComments(' + full.id_tarea + ')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleNotas"><i class="fa-solid fa-comment">&nbsp;&nbsp;<span class="badge badge-light" id="rows"></span></i></button><br>' +
                            '&nbsp;&nbsp;<button type="button" onclick="getEstado(' + full.id_tarea + ')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEditEstado"><i class="fa-solid fa-pen-to-square"></i></button>';
                    }
                }
            ]
        })

        $('#btnSearchh').click(function() {

            miDataTableh.ajax.reload();
        })

    })

   

    function updateEstado() {
        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/gestiontareas/crud.php?aux=2',
            data: $('#formcontrol2').serialize(),
            success: function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "¡Registro guardado exitosamente!",
                    showConfirmButton: false,
                    timer: 1500
                });
                cargarDatosh();
                cargarDatosc();
                cargarDatosf();
                cargarDatosp();
                cargarDatosv();
          
            }
        });
    }

    function setComments() {
        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/gestiontareas/crud.php?aux=3',
            data: $('#formcontrol3').serialize(),
            success: function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "¡Registro guardado exitosamente!",
                    showConfirmButton: false,
                    timer: 1500
                });
                cargarDatosh();
                cargarDatosc();
                cargarDatosf();
                cargarDatosp();
                cargarDatosv();
            }
        });
    }


    function getEstado(id) {
        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/gestiontareas/mostrar-2.php?aux=2&id=' + id,
            success: function(res) {

                data = JSON.parse(res);

                data.forEach(element => {
                    $('#iden2').val(element.id);
                    $('#ide2').val(element.id);
                });

            }
        });
    }

    function getComments(id) {
        $('#id_tarea').val(id);

        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/gestiontareas/mostrar-2.php?aux=3&id=' + id,
            success: function(res) {
                data = JSON.parse(res);

                // Limpiar contenido existente
                $('#comentario').empty();

                data.forEach((element, index) => {
                    // Crear elementos de comentario con formato similar a Facebook
                    var commentItem = $('<div class="comment-item">');
                    var commentAvatar = $('<img class="comment-avatar" src="/cw3/conlabweb3.0/assets/image/user2-160x160.jpg" alt="User Avatar" style="width: 40px; height: 40px; display: inline-block; border-radius: 65%;">');
                    var commentContent = $('<div class="comment-content" style="display: inline-block; vertical-align: top; max-width: 400px;">');
                    var commentHeader = $('<div class="comment-header" style="display: inline-block; margin-left: 10px; vertical-align: top;">');
                    var commentUserName = $('<strong>').text(element.usuario);
                    var commentTime = $('<span class="comment-time" style="font-size: 0.8em;">').text(calcularTiempoTranscurrido(element.fecha));
                    var commentText = $('<p>').text(element.descripcion);

                    // Agregar elementos al comentario
                    commentHeader.append(commentUserName, '&nbsp;', commentTime);
                    commentContent.append(commentHeader, commentText);
                    commentItem.append(commentAvatar, commentContent);

                    // Agregar comentario al contenedor
                    $('#comentario').append(commentItem);

                    // Agregar hr entre comentarios, excepto después del último
                    if (index < data.length - 1) {
                        $('#comentario').append('<hr>');
                    }

                    // Actualizar otros elementos según sea necesario
                    $('#idcom').val(element.id);
                    // $('#fechacoment').html(element.fecha);
                    // $('#nomuser').html(element.usuario);
                });
            }
        });
    }

    function calcularTiempoTranscurrido(fechaPublicacion) {
        var fechaActual = new Date();
        var fechaComentario = new Date(fechaPublicacion);
        var diferencia = fechaActual - fechaComentario;
        var segundos = Math.floor(diferencia / 1000);
        var minutos = Math.floor(segundos / 60);
        var horas = Math.floor(minutos / 60);
        var dias = Math.floor(horas / 24);

        if (dias > 0) {
            return dias + (dias === 1 ? ' día' : ' días') + ' atrás';
        } else if (horas > 0) {
            return horas + (horas === 1 ? ' hora' : ' horas') + ' atrás';
        } else if (minutos > 0) {
            return minutos + (minutos === 1 ? ' minuto' : ' minutos') + ' atrás';
        } else {
            return 'Hace unos segundos';
        }
    }



    function cargarDatosh() {
        $.ajax({
            url: '/cw3/conlabweb3.0/apps/gestiontareas/mostrar.php', // Página PHP que devuelve los datos en formato JSON
            type: 'GET', // Método de la petición (GET o POST según corresponda)
            dataType: 'json', // Tipo de datos esperado en la respuesta
            success: function(data) {
                // Limpiar el DataTable y cargar los nuevos datos
                miDataTableh.clear().rows.add(data).draw();
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error('Error al obtener datos:', status, error);
            }
        });
    }



    function getRowsComments(id) {

        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/gestiontareas/mostrar-2.php?aux=4&id=' + id,
            success: function(res) {
                $('#rows').html(res);
            }
        });
    }

    function clearNotes() {
        $('#comentario').html('');
        $('#fechacoment').html('');
        $('#nomuser').html('');
    }
</script>