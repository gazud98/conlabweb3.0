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

$id_users = $_SESSION['id_users'];

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {



    //   echo $sctrl1 ;
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);

   $nmbapp= "Listado de Productos e Insumos";
?>
    <style>
        #thetable::-webkit-scrollbar {
            width: 1px;
        }
        
        .content-wrapper {
            background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/producto/assets/style.css">

    </head>

    <body>
        <div class="card" style="width:85%;margin:auto;">

            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <nav class="breadcrumbs">
                            <a href="#" class="breadcrumbs__item" style="text-decoration: none;">Compras e Inventario</a>
                            <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><?php echo $nmbapp; ?></a>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h5 style="text-align: center; color: #0045A5;"><strong><?php echo $nmbapp; ?></strong></h5>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <!--<button style="float: right;background-color:rgb(0,69,165);font-size:11px;" type="button" class="btn btn-primary btn-xs" onclick="collapseanshow('C')">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo
                        </button>-->
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm" onclick="loadFormProdcut()" data-toggle="modal" data-target="#modalAddProducto">Crear Producto</button>
                        <button class="btn btn-primary btn-sm" onclick="loadFormEquipo()" data-toggle="modal" data-target="#modalAddEquipo">Crear Equipo</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 col-lg-12" id="contentTableProdcutos">

                    </div>
                </div>
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

            <!-- Modal Add Producto -->
            <div class="modal fade" id="modalAddProducto" tabindex="-1" aria-labelledby="modalAddProductoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddProductoLabel">Crear Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="contentFormProduct">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Equipo -->
            <div class="modal fade" id="modalAddEquipo" tabindex="-1" aria-labelledby="modalAddEquipoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddEquipoLabel">Crear Equipo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="contentFormEquipo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Equipo -->
            <div class="modal fade" id="modaEditEquipo" tabindex="-1" aria-labelledby="modaEditEquipoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modaEditEquipoLabel">Editar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="contentFormEditEquipo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>

        <script>
            $(document).ready(function() {

                $('#contentTableProdcutos').load('https://conlabweb3.tierramontemariana.org/apps/producto/table.php');

            });

            function loadFormProdcut() {
                $('#contentFormProduct').load('https://conlabweb3.tierramontemariana.org/apps/producto/productos.php');
            }

            function loadFormEquipo() {
                $('#contentFormEquipo').load('https://conlabweb3.tierramontemariana.org/apps/producto/equipos.php');
            }

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