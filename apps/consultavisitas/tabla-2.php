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
}
?>

<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

<div class="content-filters mt-2 mb-2">
    <div class="row">
        <div class="col-md-2">
            <label for="">Estado:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="" selected disabled>SELECCIONA:</option>
                <option value="1">En proceso</option>
                <option value="2">Cancelado</option>
            </select>
        </div>
        <!--<div class="col-md-2">
            <label for="">Vendedor:</label>
            <select name="vendedor" id="vendedor" class="form-control">
                <option value="" selected disabled>SELECCIONA:</option>
            </select>
        </div>-->
        <div class="col-md-2">
            <label for="">Fecha de inicial:</label>
            <input type="date" name="fecha_i" id="fecha_i" class="form-control">
        </div>
        <div class="col-md-2">
            <label for="">Fecha de realización:</label>
            <input type="date" name="fecha_f" id="fecha_f" class="form-control">
        </div>
        <div class="col-md-2" style="margin-top: 30px;">
            <button type="button" class="btn btn-primary btn-sm" id="btnFilter3"><i class="fa-solid fa-filter"></i> Filtrar</button>
        </div>
    </div>
</div>

<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" style="margin-top: 2%;" id="tableNeg">
    <thead>
        <tr>
            <th>Id</th>
            <th>Empresa/Médico/Persona Natural</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Estado</th>
            <!--<th>Vendedor</th>-->
            <th></th>
        </tr>
    </thead>

    </tbody>
</table>

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {

        miDataTableVisitasNeg = $('#tableNeg').DataTable({
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
                url: 'https://cw3.tierramontemariana.org/apps/consultavisitas/mostrar-1.php?aux=6', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '',
                data: function(d) {
                    d.fecha1 = $('#fecha_i').val();
                    d.fecha2 = $('#fecha_f').val();
                    d.estado = $('#estado').val();
                },
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "celular"
                },
                {
                    "data": "estado",
                    "render": function(data, type, full, meta) {
                        if(full.estado == 1){
                            return '<span class="badge badge-warning">En proceso</span>';
                        }else if(full.estado == 1){
                            return '<span class="badge badge-danger">Cancelado</span>';
                        }
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '&nbsp;&nbsp;<button class="btn btn-secondary btn-sm" onclick="getComments2('+full.id+')" data-toggle="modal" data-target="#exampleNotasNeg">Revisar <i class="fa-solid fa-paperclip"></i></button>'
                    }
                }

            ],

        })
        
        $('#btnFilter3').click(function() {
            miDataTableVisitasNeg.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        });

    });
    
    function getComments2(id) {

        //alert(id)

        $('#id_tarea2').val(id);

        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/consultavisitas/mostrar-2.php?aux=7&id=' + id,
            success: function(res) {
                data = JSON.parse(res);

                // Limpiar contenido existente
                $('#comentario2').empty();

                data.forEach((element, index) => {
                    // Crear elementos de comentario con formato similar a Facebook
                    var commentItem = $('<div class="comment-item">');
                    var commentAvatar = $('<img class="comment-avatar" src="https://cw3.tierramontemariana.org/assets/image/user2-160x160.jpg" alt="User Avatar" style="width: 40px; height: 40px; display: inline-block; border-radius: 65%;">');
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
                    $('#comentario2').append(commentItem);

                    // Agregar hr entre comentarios, excepto después del último
                    if (index < data.length - 1) {
                        $('#comentario2').append('<hr>');
                    }

                    // Actualizar otros elementos según sea necesario
                    $('#idcom2').val(element.id);
                    // $('#fechacoment').html(element.fecha);
                    // $('#nomuser').html(element.usuario);
                });
            }
        });
    }
    
</script>