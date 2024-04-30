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
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }
}

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<table class="table table-h-m" id="table-historial">
    <thead>
        <tr>
            <th>Mantenimiento</th>
            <th>Responsable</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {

        miDataTable = $('table-historial').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "ajax": {
                url: '/cw3/conlabweb3.0/apps/activofijo/show-historial.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                data: function(d) {
                    d.id = <?php echo $id ?>
                },
            },
            "columns": [{
                    "data": "respuestos"
                }, {
                    "data": "tecnico"
                }, {
                    "data": "fecha_final"
                },
                {
                    "data": "estado_mantenimiento",
                    "render": function(data, type, full, meta) {
                        var estadoText = data === "P" ? '<span class="badge badge-danger" >Pendiente</span>' : '<span class="badge badge-success" >Realizado</span>';
                        return estadoText;
                    }
                }
            ]
        });
    });
</script>