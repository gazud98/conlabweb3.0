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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = "";
    }

    include('reglasdenavegacion.php');

    // echo '..............................';

?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />


    <table class="table table-striped table-motivo-glosas col-md-12" style="
                    font-size: 15px;
                    text-align: center;
                    margin-top: 150px;
                ">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>


        </tbody>
    </table>
    <!-- jquery-validation -->
    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <!--<script src="assets/plugins/jquery/jquery.min.js"></script>-->

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            new DataTable('.table-motivo-glosas', {
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
                    url: '/cw3/apps/empresas/mostrar.php?aux=2', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {

                        //d.fecha_f = $('#fecha_f').val();

                    }
                },
                "columns": [
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            if(full.estado == 1){
                                return '<span class="badge badge-success">Activo</span>';
                            }else if(full.estado == 2){
                                return '<span class="badge badge-success">Inactivo</span>';
                            }
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<a href="#" onclick="loadMotivosGlosas('+full.id+')" data-toggle="modal" data-target="#modalMotivoGlosas"><i class="fa-solid fa-pen-to-square" style="font-size: 15px; color:#0853E0;"></i></a>'
                            +'<a href="#"><i class="fa-solid fa-trash-can" style="font-size: 15px; color:#F02424;"></i></a>';
                        }
                    }
                ],
            })
        });
    </script>

<?php
}
?>