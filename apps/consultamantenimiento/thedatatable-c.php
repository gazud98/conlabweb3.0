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

    <style>
        .table-correctivo {
            border: none;
        }

        .table-correctivo tr th {
            color: #0F6495;
            text-align: center;
            margin-bottom: 10px !important;
            background-color: rgb(0,69,165);
            color: #C6CFD5;
        }

        .table-correctivo tr td {
            text-align: left;
            border: 1px solid #C6CFD5 !important;
        }
        .dt-buttons .buttons-print{
            border: none !important;
            background:#17AB00 !important;
            color:#fff !important;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css">

    <table class="table-correctivo" style="
                    font-size: 15px;
                    text-align: center;
                    margin-top: 150px;
                    width:100%;
                " id="tablecorrectivo">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Daño</th>
                <th>Fecha del correctivo</th>
                <th>Sede</th>
                <th>Estado</th>
                <th></th>
                <!--<th>Acciones</th>-->
            </tr>
        </thead>
        <tbody>


        </tbody>
        <tfoot>

        </tfoot>
    </table>

    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {

            aux = 'C';

            miDataTable = $('.table-correctivo').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ],
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                // ... Otras opciones ...
                "ajax": {
                    url: '/cw3/conlabweb3.0/apps/consultamantenimiento/mostrar-c.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {
                        // Agrega parámetros personalizados aquí
                        //d.nosolicitud = $('#nosolicitud').val();
                        //d.ccosto = $('#ccosto').val();
                        d.fecha1 = $('#fecha1').val();
                        d.fecha2 = $('#fecha2').val();
                        d.estado = $('#estado').val();
                        d.sede = $('#sede').val();
                        d.activo = $('#codactivo').val();
                        d.year = $('#sel1').val();
                    }, // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                },
                "columns": [{
                        "data": "nombre"
                    },
                    {
                        "data": "dan"
                    },
                    {
                        "data": "fecha_final",
                    },
                    {
                        "data": "sede"
                    },
                    {
                        "data": "estado_c",
                        "render": function(data, type, full, meta) {

                            if (full.estado_c === "P") {
                                return '<span class="badge badge-warning">Pendiente</span>';
                            } else if (full.estado_c === "F") {
                                return '<span class="badge badge-primary">Finalizado</span>';
                            } else if (full.estado_c === "V") {
                                return '<span class="badge badge-danger">Vencido</span>';
                            }

                        }
                    },
                    {
                        "data": "estado_c",
                        "render": function(data, type, full, meta) {

                            if (full.estado_c === "P") {
                                return '&nbsp;&nbsp;<a href="#" onclick="addValueIde(' + full.id + ')" title="Ingresar Resultados" data-toggle="modal"  data-target="#event"><i class="fa-solid fa-upload"></i></a>';
                            } else if (full.estado_c === "F") {
                                //return '<a href="#" onclick="desactivar1(' + full.id + ');" style="color: #061078;" title="Activar"><i class="fa-solid fa-circle-check" id="icon" style="font-size:18px;"></i><span></span></a>';
                                return '';
                            } else if (full.estado_c === "V") {
                                return '<a href="#" style="color:red;" onclick="loadModalRepC(' + full.id + ')" title="Reprogramar" data-toggle="modal" data-target="#modalReprogramar"><i class="fa-solid fa-clock-rotate-left" id="icon" style="font-size:18px;"></i><span></span></a>';
                            }

                        }
                    }
                ],
            });
            $('#button-fil').click(function() {
                miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
            });
        })

        function addValueIde(id) {
            $('#ide').val(id);
        }
        
        function loadModalRepC(id) {
            $('#contentModalRep').load('/cw3/conlabweb3.0/apps/consultamantenimiento/modal-rep.php', {
                id: id,
                aux: 'C'
            });
        }
        
    </script>

<?php
} /**/
?>