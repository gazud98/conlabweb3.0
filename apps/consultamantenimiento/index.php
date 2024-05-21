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

        .modal-xl {
            width: 1140px;
            margin-left: -92%;
        }
    </style>

    <!-- Modal Reporte 
    <div class="card modal-ing col-md-8 p-0">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    Reporte de mantenimiento
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4 text-right">
                    <i class="fa-solid fa-xmark" id="btnCloseModalIng" onclick="closeModalIng()"></i>
                </div>
            </div>
        </div>
        <div class="card-body" id="areaPDF">
            <div class="row">
                <div class="col-md-4">
                    <div style="text-align: left;">
                        <img style="width: 200px;margin-top:30px;" src="/cw3/conlabweb3.0/apps/consultamantenimiento/assets/logopasteur.png" alt="">
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <br><br>
                    <h5>Reporte de mantenimiento</h5>
                </div>
                <div class="col-md-4 text-right">
                    <p>
                        Código: GIN-FOR-003
                        <br>Versión: 1
                        <br>Fecha: 2023/07/21
                        <br>Página:1 de 1
                    </p>
                </div>
            </div>
            <div class="content-info-mant" id="inforMantPrint">

            </div>
        </div>
        <div class="card-footer text-right">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-danger btn-sm" onclick="closeModalIng()">Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="saveReport()">Guardar</button>
                <button type="button" class="btn btn-info btn-sm" onclick="convertirAPDF()"><i class="fa-solid fa-download"></i> Descargar</button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="imprimirArea(document.getElementById('areaPDF'))"><i class="fa-solid fa-print"></i> Imprimir</button>
            </div>
        </div>
    </div>
    <div class="modal-backdrop-ing">

    </div>-->

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
                    <h5 class="card-title card-title-rezise"><strong>Consulta de Mantenimientos</strong></h5>
                </div>
                <div class="col-md-4 col-lg-4">
                </div>
            </div>
        </div>


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

    <!-- Modal -->
    <div class="modal fade" id="modalReportAdd" tabindex="-1" aria-labelledby="modalReportAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-xl">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalReportAddLabel">Reporte de mantenimientos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="areaPDF">
                    <div class="row">
                        <div class="col-md-4">
                            <div style="text-align: left;">
                                <img style="width: 200px;margin-top:30px;" src="/cw3/conlabweb3.0/apps/consultamantenimiento/assets/logopasteur.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <br><br>
                            <h5>Reporte de mantenimiento</h5>
                        </div>
                        <div class="col-md-4 text-right">
                            <p>
                                Código: GIN-FOR-003
                                <br>Versión: 1
                                <br>Fecha: 2023/07/21
                                <br>Página:1 de 1
                            </p>
                        </div>
                    </div>
                    <div class="content-info-mant"></div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="saveReport()">Guardar</button>
                        <button type="button" class="btn btn-info btn-sm" onclick="convertirAPDF()"><i class="fa-solid fa-download"></i> Descargar</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="imprimirArea(document.getElementById('areaPDF'))"><i class="fa-solid fa-print"></i> Imprimir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script>
        function imprimirArea(elemento) {
            var contenido = elemento.innerHTML;
            var ventana = window.open('', '_blank');
            ventana.document.write('<html><head><title>Imprimir</title></head><body>');
            ventana.document.write(contenido);
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.print();
            ventana.close();
        }

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

        function convertirAPDF() {

            //window.location.href = '/cw3/conlabweb3.0/apps/consultamantenimiento/generar-pdf.php';

            const contenido = document.getElementById('areaPDF');
            html2pdf().from(contenido).save('mi_archivo.pdf');
        }

        function openModalIng(id) {
            $('.content-info-mant').load('/cw3/conlabweb3.0/apps/consultamantenimiento/generar-reporte.php', {
                id: id
            })
        }

        function closeModalIng() {
            $('.modal-ing').removeClass('show');
            $('.modal-ing').addClass('hide');
            $('.modal-backdrop-ing').hide();
        }

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
                url: '/cw3/conlabweb3.0/apps/consultamantenimiento/send-result.php',
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

                        window.open('/cw3/conlabweb3.0/apps/consultamantenimiento/generar-reporte.php?id=' +
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
                url: '/cw3/conlabweb3.0/apps/consultamantenimiento/crud.php?aux=1',
                data: $('#formAddMotivo').serialize(),
                success: function(respuesta) {
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#loadMotivo').load('/cw3/conlabweb3.0/apps/consultamantenimiento/load-motivo.php');
                }
            });
        }
    </script>
<?php
}
?>