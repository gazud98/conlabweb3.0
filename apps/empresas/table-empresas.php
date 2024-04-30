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


?>

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <style>
        .table-empresas {
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

    <table class="table table-borderless table-empresas">
        <thead>
            <tr>
                <th style="text-align: center;">Seleccionar empresa</th>
                <th style="text-align: center;">N° Identificación</th>
                <th style="text-align: center;">Razón Social</th>
                <th style="text-align: center;">Nombre Comercial</th>
                <th style="text-align: center;">Acciones</th>
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
            miDataTableEmpresas = $('.table-empresas').DataTable({
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
                "ajax": {
                    url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/mostrar.php?aux=1', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {

                        d.fecha_f = $('#fecha_f').val();

                    }
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<input type="radio" name="selectempresa" id="selectempresa" onclick="activeButtons()" value="' + full.id_empresas + '">';
                        }
                    },
                    {
                        "data": "documento"
                    },
                    {
                        "data": "razon_social"
                    },
                    {
                        "data": "nombre_comercial"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<div class="btn-group" role="group" aria-label="Basic example">'+
                            '<button type="button" class="btn btn-primary btn-sm" title="Editar y Ver Info" onclick="loadModalEditEmpresa(' + full.id_empresas + ')" data-toggle="modal" data-target="#modalEditEmpresa"><i class="fa-solid fa-eye" style="font-size:13px;"></i></button>'+
                            '<button type="button" class="btn btn-danger btn-sm" title="Eliminar" onclick="deleteEmpresa(' + full.id_empresas + ')"><i class="fa-solid fa-trash-can" style="font-size:13px;"></i></button>'+
                            '<button type="button" class="btn btn-success btn-sm" title="Ver planes de la empresa" onclick="loadViewPlanesEmpresa(' + full.id_empresas + ')" data-toggle="modal" data-target="#modalViewPlanes">Ver planes</button>'+
                            '</div>'+
                            '<input type="hidden" id="idempresa" value="'+full.id_empresas+'"/>'+
                            '<input type="hidden" id="nombreEmpresa'+full.id_empresas+'" value="'+full.nombre_comercial+'"/>'
                        }
                    }
                ],

            })

        });
    </script>

<?php
}
?>