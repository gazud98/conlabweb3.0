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
        .table-preventiva {
            border: none;
        }

        .table-preventiva tr th {
            color: #0F6495;
            text-align: center;
            margin-bottom: 10px !important;
            background-color: rgb(0,69,165);
            color: #C6CFD5;
        }

        .table-preventiva tr td {
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

    <table class="table-preventiva" style="
                    font-size: 15px;
                    text-align: center;
                    margin-top: 150px;
                    width:100%;
                ">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Descripción Mantenimiento</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Final</th>
                <th>Responsable</th>
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

    <div class="modal fade" id="event2">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->

                <div class="modal-header" style="background-color: rgb(22,64,133);color:white;">
                    <h5 style="text-align:center;"><strong>Terminar Evento</strong></h5>
                    <button type="button" class="close" style="color:white" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body" id="modalshow" name="modalshow">
                    <div id="mdlevent">

                        <form id="formresultado" action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <!--<div class="col-md-12 col-lg-12">
                                    <label>Daño:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color:rgb(97,100,103)"></span></label>
                                </div>-->
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 col-lg-12">
                                    <input type="hidden" name="tip" id="tip" value="P">
                                    <input type="hidden" name="ide" id="ide" value="">
                                    <label>Resultado:</label>
                                    <textarea class="form-control" name="observacion" id="observacion" required></textarea>

                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="acep" onclick="sendResultado();" data-dismiss="modal">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
           miDataTable2 = new DataTable('.table-preventiva', {
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                // ... Otras opciones ...
                "ajax": {
                    url: 'https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/mostrar-p.php', // Página PHP que devuelve los datos en formato JSON
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
                        "data": "desc_mantenimiento"
                    },
                    {
                        "data": "comienzo"
                    },
                    {
                        "data": "fecha_final"
                    },
                    {
                        "data": "responsable"
                    },
                    {
                        "data": "sede"
                    },
                    {
                        "data": "estado_mantenimiento",
                        "render": function(data, type, full, meta) {
                            if (full.estado_mantenimiento === "P") {
                                return '<span class="badge badge-warning">Pendiente</span>';
                            } else if (full.estado_mantenimiento === "F") {
                                return '<span class="badge badge-primary">Finalizado</span>';
                            } else if (full.estado_mantenimiento === "V") {
                                return '<span class="badge badge-danger">Vencido</span>';
                            }
                        }
                    },
                    {
                        "data": "estado_mantenimiento",
                        "render": function(data, type, full, meta) {

                            if (full.estado_mantenimiento === "P") {
                                return '&nbsp;&nbsp;<a href="#" onclick="addValueIde(' + full.id + ')" title="Ingresar Resultados" data-toggle="modal"  data-target="#event"><i class="fa-solid fa-upload"></i></a>';
                            } else if (full.estado_mantenimiento === "F") {
                                //return '<a href="#" onclick="desactivar1(' + full.id + ');" style="color: #061078;" title="Activar"><i class="fa-solid fa-circle-check" id="icon" style="font-size:18px;"></i><span></span></a>';
                                return '';
                            } else if (full.estado_mantenimiento === "V") {
                                return '<a href="#" style="color:red;" onclick="loadModalRepP(' + full.id + ')" title="Reprogramar" data-toggle="modal" data-target="#modalReprogramar"><i class="fa-solid fa-clock-rotate-left" id="icon" style="font-size:18px;"></i><span></span></a>';
                            }

                        }
                    }
                ],
                
            });
            $('#button-fil').click(function() {
                miDataTable2.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
            });
        })

        function addValueIde(id) {
            $('#ide').val(id);
        }
        
        function loadModalRepP(id) {
            $('#contentModalRep').load('https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/modal-rep.php', {
                id: id,
                aux: 'P'
            });
        }
        
    </script>

<?php
} /**/
?>