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

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $cadena = "SELECT id_empresas, nombre_comercial FROM empresas WHERE id_empresas = '$id'";

    $rest = mysqli_query($conetar, $cadena);

    $data =  mysqli_fetch_array($rest);

?>
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <style>
        .table-planes-empresa {
            border: 1px solid #d2d2d2;
            border-radius: 10px;
            font-size: 14px;
            text-align: center;
        }

        table.table tr td {
            border-top: 1px solid #d2d2d2;
            padding: 5px;
        }
    </style>

    <br><div>
        <h5 style="font-weight: bold;">Empresa: <?= $data['nombre_comercial'] ?></h5>
    </div>

    <br><table class="table table-borderless table-planes-empresa" style="text-align: center;">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Plan</th>
                <th>Lista Base</th>
                <th>Estado</th>
                <th></th>
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

            miDataTablePlanesEmpresa = $('.table-planes-empresa').DataTable({
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
                    url: '/cw3/apps/empresas/mostrar.php?aux=5&id=<?php echo $id; ?>', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {

                        //d.fecha_f = $('#fecha_f').val();

                    }
                },
                "columns": [{
                        "data": "nombre_comercial"
                    },
                    {
                        "data": "nombre_plan"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            if (full.estado == 1) {
                                return '<span class="badge badge-success">Activo</span>';
                            } else if (full.estado == 2) {
                                return '<span class="badge badge-danger">Inactivo</span>';
                            }
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<a href="#" title="Editar y Ver Info" onclick="loadModalEditPlan(' + full.id + ')" data-toggle="modal" data-target="#modalEditPlan"><i class="fa-solid fa-pen-to-square" style="color:#0853E0;font-size:15px;"></i></a>';
                        }
                    }
                ],

            })

        });
    </script>

<?php
}
?>