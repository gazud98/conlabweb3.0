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
    $id = $_REQUEST['id'];
}
?>

<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

<div class="content-filters mt-2 mb-2">
    <div class="row">
        <div class="col-md-3">
            <label for="">Fecha de realización:</label>
            <input type="date" name="fecha_f" id="fecha_f" class="form-control">
        </div>
        <div class="col-md-2" style="margin-top: 30px;">
            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-filter"></i> Filtrar</button>
        </div>
    </div>
</div>

<table class="table table-striped table-head-fixed text-nowrap table-sm" style="margin-top: 2%;" id="tableCoemmentsVisitas">
    <thead>
        <tr>
            <th>Id</th>
            <th>Fecha y Hora</th>
            <th></th>
        </tr>
    </thead>

    </tbody>
</table>

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {

        miDataTableVisitas2 = $('#tableCoemmentsVisitas').DataTable({
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
                url: 'https://cw3.tierramontemariana.org/apps/consultavisitas/mostrar-2.php?aux=5&id=<?php echo $id; ?>', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '',
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '&nbsp;&nbsp;<button class="btn btn-info btn-sm" onclick="getMap(' + full.id + ')">Revisar <i class="fa-solid fa-location-dot"></i></button>'
                    }
                }
            ],

        })

    });


</script>