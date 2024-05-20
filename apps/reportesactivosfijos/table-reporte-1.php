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

?>

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <style>
        .table-bordes-d {
            border: 1px solid #d2d2d2;
            border-radius: 10px;
            font-size: 14px;
            text-align: center;
            padding: 2px;
        }

        table.table tr td {
            border-top: 1px solid #d2d2d2;
            padding: 2px !important;
        }

        .dt-buttons .dt-button {
            border: none !important;
            background: #17AB00 !important;
            color: #fff !important;
        }
    </style>

    <div  id="contentFiters">

    </div>

    <table class="table table-striped table responsive  table-hover table-head-fixed text-nowrap table-sm" id="tableReporte">
        <thead>
            <tr>
                <th style="width: 55%;text-align:center;">Nombre</th>
                <th style="text-align:center;">Referencia</th>
                <th style="text-align:center;">Sede</th>
                <th style="text-align:center;">Estado</th>
                <th style="text-align:center;">Ver</th>
            </tr>
        </thead>
        <tbody>



        </tbody>
        <tfoot>

        </tfoot>
    </table>


    

    <script>
        $(document).ready(function() {

            $('#contentFiters').load('https://conlabweb3.tierramontemariana.org/apps/reportesactivosfijos/filters.php');

            miDataTableReporte1 = $('#tableReporte').DataTable({
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
                    url: 'https://conlabweb3.tierramontemariana.org/apps/reportesactivosfijos/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {

                        d.sede = $('#sedefiltro').val();
                        d.estado = $('#estadofiltro').val();
                        //d.cat = $('#cat').val();

                    }
                },
                "columns": [{
                        "data": "nombre"
                    },
                    {
                        "data": "referencia"
                    },
                    {
                        "data": "nombresede"
                    },
                    {
                        "data": "estado",
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

                            return '<a href="#" onclick="loadModalView(' + full.id + ')" data-toggle="modal" style="color:#E8A200;" data-target="#modalViewActivoFijo"><i class="fa-solid fa-eye" style="font-size:13px !important;"></i></a>';

                        }
                    },
                ],

            });


        })

        function loadModalView(id){
            $('#contentFormsModal').load('https://conlabweb3.tierramontemariana.org/apps/reportesactivosfijos/modal-view.php', {
                id: id
            });
        }
    </script>

<?php
} /**/
?>