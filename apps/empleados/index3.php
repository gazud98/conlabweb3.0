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


    if ($sctrl1 == "1") {
        $nmbapp = "ACTIVOS FIJOS";
    }


    //   echo $sctrl1 ;
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  cw3completa.producto" .
        $filterfrom .
        " where 1=1";
    if ($sctrl1 != "0") {
        $cadena = $cadena . " and id_categoria_producto='" . $sctrl1 . "'";
    }
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];
?>
    <style>
        #thetable::-webkit-scrollbar {
            width: 1px;
        }
    </style>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>

    </head>

    <body>
        <div class="card border-light">

            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <nav class="breadcrumbs">
                            <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                            <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong><?php echo $nmbapp; ?></strong></a>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h5 style="text-align: center; color: #0045A5;"><strong>CREACIÓN DE <?php echo $nmbapp; ?></strong></h5>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <button style="float: right;background-color:rgb(0,69,165);font-size:11px;" type="button" class="btn btn-primary btn-xs" onclick="collapseanshow('C')">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo
                        </button>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 col-lg-5" style="overflow:hidden; overflow-y:auto;">
                        <div id="thetable" name="thetable" style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                           height:50vh;width:100%;"></div><?php //aqui va thedatatable.php //tabla de la app 
                                                                            ?>

                    </div>
                    <div class="col-md-7 col-lg-7" style="overflow:hidden; overflow-y:auto;" name="divappshow" id="divappshow">
                        <?php include('thedatashow.php');  //campos de la app 
                        ?>
                    </div>

                    <!--<div class="col-md-12 text-center pt-2">
                        <a href="#addEmployeeModal" class="btn btn-primary" data-toggle="modal" style="background-color: rgb(0,69,165);"><i class="fa-solid fa-eye"></i> &nbsp; <span>Ver Historial de Mantenimientos</span></a>
                    </div>-->
                </div>
            </div>


            <div class="card-footer bg-light">
                <?php include('piepag.php'); //zoan de botornes
                ?>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="modalPrint" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: 900px; height:500px; margin-left: -250px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPrintLabel">Exportar Tabla Productos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow: scroll;">
                            <?php include('table-print.php'); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="exportarExcel();">Exportar a Excel</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php


        include('apps/thedata.php'); //scriops de control
        ?>

        <!-- use version 0.20.0 -->
        <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>

        <script>
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


                $('#thetable').load('https://cw3.tierramontemariana.org/apps/activofijo/thedatatable.php');

                miDataTable3 = $('.table-h-m').DataTable({
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
                })

            })



            function accionesespecificas(caso) {
                if (caso == "X") { //cancelar....
                    $("#divproveedoresproducto").css("display", "block");
                }
                if (caso == "A") { //aceptar...
                    $("#divproveedoresproducto").css("display", "block");
                }
                if (caso == "C") { //de crer
                    //desaparece la creacion de proveedores, solo sale en los demas casos
                    $("#divproveedoresproducto").css("display", "none");
                } //De crear
                if (caso == "E") {
                    $("#divproveedoresproducto").css("display", "block");
                } //Editar
                if (caso == "D") {
                    $("#divproveedoresproducto").css("display", "block");
                } //Es de habolita / inhablitar
            } //funcikjnes que hacen casos epeciales en


            function printAreaDiv() {

                var contenidoDiv = document.getElementById('content-table-print').innerHTML;
                var divTemporal = document.createElement('div');
                divTemporal.innerHTML = contenidoDiv;
                var iframe = document.createElement('iframe');
                iframe.style.display = 'none';
                document.body.appendChild(iframe);
                var doc = iframe.contentWindow.document;
                doc.body.appendChild(divTemporal);
                iframe.contentWindow.print();
                document.body.removeChild(iframe);
            }

            function exportarCVS() {
                var tabla = document.getElementById('tableproductoprint');
                var csv = [];
                var filas = tabla.getElementsByTagName('tr');
                for (var i = 0; i < filas.length; i++) {
                    var fila = [];
                    var celdas = filas[i].getElementsByTagName('td');
                    for (var j = 0; j < celdas.length; j++) {
                        fila.push(celdas[j].innerText);
                    }
                    csv.push(fila.join(''));
                }
                var contenidoCSV = csv.join('\n');
                var enlace = document.createElement('a');
                enlace.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(contenidoCSV);
                enlace.target = '_blank';
                enlace.download = 'mi_tabla.csv';
                enlace.click();
            }

            function exportarExcel() {
                var nombreArchivo = 'productos.xlsx';
                var tabla = document.getElementById('tableproductoprint');
                var tablaHTML = tabla.outerHTML;
                var workbook = XLSX.utils.table_to_book(tabla);
                var excelBuffer = XLSX.write(workbook, {
                    bookType: 'xlsx',
                    type: 'array'
                });
                var blob = new Blob([excelBuffer], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var url = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = nombreArchivo;
                a.click();
                URL.revokeObjectURL(url);

                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Archivo exportado con éxito!',
                    showConfirmButton: false,
                    timer: 1000
                })

                $('#modalPrint').hide();
                $('.modal-backdrop').remove();

            }
        </script>
    </body>

    </html>
<?php
}
?>