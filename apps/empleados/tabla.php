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

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <button class="btn btn-secondary btn-sm" style="background-color:rgb(0,69,165);font-size:13px;display: none" data-toggle="modal" data-target="#modalPrint" id="btnExport"><i class="fa-solid fa-file-export"></i>&nbsp; Exportar Excel</button><br><br>

    <table class="table table-striped table-hover table responsive  table-head-fixed text-nowrap table-sm table-producto" style="width:100%">
        <thead>
            <tr>
             
                <th>Nombre</th>
                <th>Valor</th>
                <th>Depresiación</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url: '/cw3/conlabweb3.0/apps/producto/mostrar.php',
                data: {
                    sctrl1: <?php echo $sctrl1 ?>
                },
                success: function(respuesta) {

                }
            });

            miDataTable = $('.table-producto').DataTable({
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
                // ... Otras opciones ...
                "ajax": {
                    url: '/cw3/conlabweb3.0/apps/activofijo/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                },
                "columns": [
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "valor"
                    },
                    {
                        "data": "dpr"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            // Aquí puedes aplicar estilos o clases CSS según el valor de la propiedad "estado"
                            if (full.estado === "2") {
                                return '<span style="font-size: 12px; color: red;" id=""estado><span class="badge badge-danger">Inhabilitado</span></span>';
                            } else if (full.estado === "1") {
                                return '<span style="font-size: 12px; color: green;" id=""estado><span class="badge badge-success">Habilitado</span></span>';
                            }
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {

                            return '<a href="#" title="Editar" style="color:#213FD6;" onclick="loadTextFieldsEdit(' + full.id_producto + ')" data-toggle="modal" data-target="#modalEditActivoFijo"><i class="fa-solid fa-eye" style="font-size:13px;"></i></a>' +
                                '<a href="#" title="Borrar" style="color:#D62121;" onclick="deleteProduct(' + full.id_producto + ')"><i class="fa-solid fa-trash-can" style="font-size:13px;"></i></a>' +
                                '<a href="#" title="Desactivar" style="color:#323D66;" onclick="disableProduct(' + full.id_producto + ',' + full.estado + ')"><i class="fa-solid fa-power-off" style="font-size:13px;"></i></a>' +
                                '<a href="#addEmployeeModal" onclick="loadHistorial(' + full.id_producto + ')" title="Historial de mantenimientos" data-toggle="modal" style="color:#1D9F00;"><i class="fa-solid fa-clock-rotate-left" style="font-size:13px;"></i></a>' +
                                '<input type="hidden" name="fileselect' + full.thefile + '" id="fileselect' + full.thefile + '"" value="' + full.tipo_prod + '" max="' + full.max + '">';
                        }
                    }
                ]
            });
        });


        function deleteProduct(id) {
            Swal.fire({
                title: 'Desea eliminar este producto?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/cw3/conlabweb3.0/apps/activofijo/crud-2.php?aux=3&id=' + id,
                        success: function() {
                            Swal.fire(
                                'Eliminado!',
                                'El producto has sido eliminado.',
                                'success'
                            )
                            miDataTable.ajax.reload();
                            $("#iddatas").css("pointer-events", "none");
                            $("#iddatas").css("background-color", "#ededed");
                            $("#accionejec").css("display", "none");
                            $("#accionejec").html("");
                        }
                    })
                }
            })
        }

        function disableProduct(id, estado) {
            if (estado == 1) {
                Swal.fire({
                    title: 'Desea deshabilitar este producto?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Deshabilitar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/cw3/conlabweb3.0/apps/activofijo/crud-2.php?id=' + id + '&aux=4&estado=' + estado,
                            success: function() {
                                Swal.fire(
                                    'Deshabilitado!',
                                    'El producto has sido deshabilitado.',
                                    'success'
                                )
                                miDataTable.ajax.reload();
                                $("#iddatas").css("pointer-events", "none");
                                $("#iddatas").css("background-color", "#ededed");
                                $("#accionejec").css("display", "none");
                                $("#accionejec").html("");
                            }
                        })
                    }
                })
            } else {
                Swal.fire({
                    title: 'Desea habilitar este producto?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Habilitar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/cw3/conlabweb3.0/apps/activofijo/crud-2.php?id=' + id + '&aux=4&estado=' + estado,
                            success: function() {
                                Swal.fire(
                                    'Habilitado!',
                                    'El producto has sido habilitado.',
                                    'success'
                                )
                                miDataTable.ajax.reload();
                                $("#iddatas").css("pointer-events", "none");
                                $("#iddatas").css("background-color", "#ededed");
                                $("#accionejec").css("display", "none");
                                $("#accionejec").html("");
                            }
                        })
                    }
                })
            }
        }

    </script>
<?php
} /**/
?>