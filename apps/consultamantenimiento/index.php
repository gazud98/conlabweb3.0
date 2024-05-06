<?php


// echo __FILE__.'>dd.....<br>';
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

$id_users = $_SESSION['id_users'];
//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    include('reglasdenavegacion.php');


    $nmbapp = "MANTENIMIENTOS";
    //   echo $sctrl1 ;
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
?>

    <link rel="stylesheet" href="/assets/bootstrap-multiselect.css">
    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/consultamantenimiento/assets/style.css">

    <style>
        * {
            font-size: 14px;
        }

        .form-control {
            font-size: 14px;
        }

        .card-title-rezise {
            width: 100%;
            color: #164085;
            text-align: center;
            position: relative;
            margin-top: 9px;
        }

    </style>

    <div class="card border-light">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong>Consultar Mantenimientos</strong></a>
                    </nav>
                </div>
                <div class="col-md-4 col-lg-4">
                    <h5 class="card-title card-title-rezise"><strong>Creación de Mantenimientos</strong></h5>
                </div>
                <div class="col-md-4 col-lg-4">
                </div>
            </div>
        </div>

        <!--<br><div class="col-md-3 p-2" style="margin-left:10px;">
            <div class="input-group mb-3">
                <input type="text" class="form-control btnsearch" placeholder="Buscar" aria-label="Buscar" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" disabled><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>-->

        <div class="row p-3">
            <div class="col-md-2">
                <label>Tipo de Mantenimiento:</label>
                <select name="tipman" id="tipman" class="form-control">
                    <option value=""></option>
                    <option value="1">Correctivo</option>
                    <option value="2">Preventivo</option>
                    <option value="3">Todos</option>
                </select>
            </div><br>
            <div class="col-md-1">
                <label for="">Equipo:</label>
                <input type="text" class="form-control" name="codactivo" id="codactivo">
                <!--<select name="activo" id="activo" class="bbactivo">
                    <option selected="true" disabled="disabled"></option>
                    <?php

                    $cadena = "SELECT id_producto, nombre,estado
                    FROM  u116753122_cw3completa.producto where id_categoria_producto = 1";

                    //echo $cadena;
                    /* */
                    $thefile = 0;
                    $resultadP2 = $conetar->query($cadena);
                    $datos = array();
                    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                        $thefile = $thefile + 1;
                        echo "<option value='" . trim($filaP2['id_producto']) . "'";
                        echo '>' . $filaP2['nombre'] . "</option>";
                    }

                    ?>
                    <option value="%">Todos</option>
                </select>-->
            </div>
            <div class="col-md-1">
                <label for="">Año:</label>
                <?php
                $cont = date('Y');
                ?>
                <select id="sel1" class="form-control sel-1">
                    <option value="" selected disabled></option>
                    <option value="%">Todos</option>
                    <?php while ($cont >= 2000) { ?>
                        <option value="<?php echo ($cont); ?>"><?php echo ($cont); ?></option>
                    <?php $cont = ($cont - 1);
                    } ?>
                </select>
            </div>
            <div class="col-md-1">
                <label for="filtro">Estado:</label>
                <select class="form-control" id="estado" name="estado">
                    <option selected="true" disabled="disabled"></option>
                    <option value="P">Pendiente</option>
                    <option value="F">Finalizado</option>
                    <option value="V">Vencido</option>
                    <option value="%">Todos</option>
                </select>
            </div>
            <div class="col-md-1">
                <label for="filtro">Sede:</label>
                <select class="form-control" id="sede" name="sede">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_sedes, nombre
                                                    FROM u116753122_cw3completa.sedes
                                                    where estado='1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                    if ($numerfiles2a33 >= 1) {
                        while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                            echo "<option value='" . trim($filaP2a33['id_sedes']) . "'";
                            echo '>' . $filaP2a33['nombre'] . "</option>";
                        }
                    }
                    ?>
                    <option value="%">Todos</option>
                </select>
            </div>
            <div class="col-md-1">
                <label for="filtro">Fecha Inicio:</label>
                <input type="date" class="form-control" id="fecha1" name="fecha1">
            </div>
            <div class="col-md-1">
                <label for="filtro">Fecha Fin:</label>
                <input type="date" class="form-control" id="fecha2" name="fecha2">
            </div>
            <div class="col-md-1" style="margin-top: 32px;">
                <button type="button" class="btn btn-primary btn-sm" value="Filtrar" id="button-fil"><i class="fa-solid fa-filter"></i> Filtrar</button>
            </div>

        </div>
        <hr>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12" style="overflow:hidden; overflow-y:auto;">


                    <div id="thetable" name="thetable" style=" 
                    margin-bottom:5px; 
                    border-bottom:thin dotted #d3d3d3;
                    height:450px;width:100%;"></div><?php //aqui va thedatatable.php //tabla de la app 
                                                    ?>
                    <?php // aqui ca la navegacion y filtro btn 
                    ?>
                </div>
            </div>
        </div>


    </div>

    <div class="modal fade" id="event">
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
                                    <input type="hidden" id="tip" name="tip" value="C">
                                    <input type="hidden" name="ide" id="ide" value="">
                                    <label>Resultado:</label>
                                    <textarea class="form-control" name="observacion" id="observacion" required></textarea>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="acep" onclick="sendResultado();" data-dismiss="modal">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Reprogramar -->
    <div class="modal fade" id="modalReprogramar" tabindex="-1" aria-labelledby="modalReprogramarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalReprogramarLabel">Reprogramar Mantenimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="formEditDatosBasicos" name="formEditDatosBasicos" method="POST" enctype="multipart/form-data">
                    <div class="modal-body" id="contentModalRep">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal add motivo -->
    <div class="modal fade" id="modalAddMotivo" tabindex="-1" aria-labelledby="modalAddMotivoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddMotivoLabel">Crear Motivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="formAddMotivo" name="formAddMotivo" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="motivo" id="motivo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" onclick="setMotivo()" class="btn btn-success">Grabar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="/assets/bootstrap-multiselect.css"></script>

    <script>
        $(document).ready(function() {

            $('.sel-1').multiselect();

            $("#datepicker").datepicker({
                changeMonth: false,
                changeYear: true,
                dateFormat: 'yy',
                navigationAsDateFormat: false
            });

            $('.table-producto').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true
            });
        })

        $('#tipman').change(function() {
            $aux = $('#tipman').val();
            if ($aux == '1') {
                $("#thetable").load("/cw3/conlabweb3.0/apps/consultamantenimiento/thedatatable-c.php");
            } else if ($aux == '2') {
                $("#thetable").load("/cw3/conlabweb3.0/apps/consultamantenimiento/thedatatable-p.php");
            } else if ($aux == '3') {
                $("#thetable").load("/cw3/conlabweb3.0/apps/consultamantenimiento/all-1.php");
            }
        })

        function habilitacmpos() {
            $("#iddatas").css("pointer-events", "auto");
            $("#iddatas").css("background-color", "white");
        }

        function inhabilitacmpos() {
            $("#iddatas").css("pointer-events", "none");
            $("#iddatas").css("background-color", "#ededed");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }
        $(document).ready(function() {

            $("#thetable").html("Escoge el tipo de mantenimiento.");

            $('.btnsearch').keyup(function() {

                var bcar = $('.btnsearch').val();

                if (bcar != '') {
                    $("#thetable").load("<?php echo base_url . 'apps/' . $p . '/thedatatable3.php'; ?>", {
                        bcar: bcar
                    });
                } else {
                    $("#thetable").load("<?php echo base_url . 'apps/' . $p . '/thedatatable.php'; ?>");
                }
            })

        });


        function sendResultado() {
            //data = $('#formresultadoc').serialize();

            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/send-result.php',
                data: $('#formresultado').serialize(),
                success: function(rest) {
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    data = JSON.parse(rest)

                    data.forEach(element => {

                        if (element.tip == 'C') {
                            desactivar1(element.id)
                        } else if (element.tip == 'P') {
                            desactivar2(element.id)
                        }

                        window.open('https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/generar-reporte.php?id=' +
                            element.id + '&tip=' + element.tip);

                    });

                }
            });
        }

        function desactivar1(id) {

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url . 'apps/' . $p . '/desactivar.php'; ?>?id=' + id + '&tip=C',
                success: function(respuesta) {
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Actualizado con Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })


                    $("#thetable").load("<?php echo base_url . 'apps/' . $p . '/thedatatable-c.php'; ?>");
                    cargarDatos();


                }
            });
        } //de alvar datos

        function desactivar2(id) {

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url . 'apps/' . $p . '/desactivar.php'; ?>?id=' + id + '&tip=P',
                success: function(respuesta) {
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Actualizado con Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })


                    $("#thetable").load("<?php echo base_url . 'apps/' . $p . '/thedatatable-p.php'; ?>");
                    cargarDatos();


                }
            });
        }

        function setMotivo() {
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/crud.php?aux=1',
                data: $('#formAddMotivo').serialize(),
                success: function(respuesta) {
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#loadMotivo').load('https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/load-motivo.php');
                }
            });
        }
    </script>
<?php
}
?>