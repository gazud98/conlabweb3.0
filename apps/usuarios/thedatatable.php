<?php
//SI POOSEE CONSULTA

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

    include('reglasdenavegacion.php');

?>

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm  table responsive table-usuarios" style="width:100%">
        <thead>
            <tr>

                <th>Nombre</th>
                <th>Estado</th>
                <th style="width: 15%;"></th>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            miDataTable = $('.table-usuarios').DataTable({
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
                    url: 'https://cw3.tierramontemariana.org/apps/usuarios/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                },
                "columns": [{
                        "data": "nombre"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            if (full.estado === "0") {
                                return '<span font-size: 12px; style="color: red;" id=""estado><span class="badge badge-danger">Inhabilitado</span></span>';
                            } else if (full.estado === "1") {
                                return '<span font-size: 12px; style=" color: green;" id=""estado><span class="badge badge-success">Habilitado</span></span>';
                            }
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {

                            return '<a href="#" style="color:#213FD6;" onclick="loadFormEditUsers(' + full.codigo + ',' + full.id_rol + ')" data-toggle="modal" data-target="#modalEditUsers"><i class="fa-solid fa-eye" style="font-size:13px;"></i></a>' +
                                '<a href="#" style="color:#D62121;" onclick="deleteProduct(' + full.codigo + ')"><i class="fa-solid fa-trash-can" style="font-size:13px;"></i></a>' +
                                '<a href="#" style="color:#323D66;" onclick="disableProduct(' + full.codigo + ',' + full.estado + ')"><i class="fa-solid fa-power-off" style="font-size:13px;"></i></a>' +
                                '<input type="hidden" name="fileselect" id="fileselect' + full.thefile + '" value="' + full.codigo + '" max="' + full.max + '">';

                        }
                    }
                ]
            });
        });

        function deleteProduct(id) {
            Swal.fire({
                title: '¿Desea eliminar este usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '!Si, Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'https://cw3.tierramontemariana.org/apps/usuarios/delete.php',
                        data: {
                            id: id
                        },
                        success: function() {
                            Swal.fire(
                                '¡Eliminado!',
                                'El Usuario ha sido eliminado.',
                                'success'
                            )
                            $("#divappshow").load("https://cw3.tierramontemariana.org/apps/usuarios/thedatashow.php");

                            miDataTable.ajax.reload();
                        }
                    })
                }
            })
        }

        function disableProduct(id, estado) {
            if (estado == 1) {
                Swal.fire({
                    title: 'Desea deshabilitar este producto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Deshabilitar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'https://cw3.tierramontemariana.org/apps/empleados/crud.php',
                            data: {
                                id: id,
                                aux: 3
                            },
                            success: function() {
                                Swal.fire(
                                    'Deshabilitado!',
                                    'El producto has sido deshabilitado.',
                                    'success'
                                )
                                miDataTable.ajax.reload();
                            }
                        })
                    }
                })
            } else {
                Swal.fire({
                    title: 'Desea habilitar este producto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Habilitar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'https://cw3.tierramontemariana.org/apps/empleados/crud.php',
                            data: {
                                id: id,
                                aux: 3
                            },
                            success: function() {
                                Swal.fire(
                                    'Habilitado!',
                                    'El producto has sido habilitado.',
                                    'success'
                                )
                                miDataTable.ajax.reload();
                            }
                        })
                    }
                })
            }
        }

        function cargarForm(thefile, id, idrol) {
            collapseanshow('E');
            var theobject = "fileselect" + thefile;




            $("#casoesperado").load("https://cw3.tierramontemariana.org/apps/usuarios/datacase1.php", {
                id: id,
                p: "usuarios",
                status: 'E'
            }, function(response, status, xhr) {
                // Este código se ejecutará después de que la carga esté completa
                if (status === "success") {
                    // Código adicional que deseas ejecutar después de cargar
                    $("#btones").css("display", "block");

                    $("#modulos").load('https://cw3.tierramontemariana.org/apps/usuarios/opciones.php', {
                        id: idrol
                    })

                } else {
                    // Manejar errores si es necesario
                    console.log("Error cargando contenido.");
                }
            });


        }

        function cargarDatos() {
            $.ajax({
                url: 'https://cw3.tierramontemariana.org/apps/usuarios/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                success: function(data) {
                    // Limpiar el DataTable y cargar los nuevos datos
                    miDataTable.clear().rows.add(data).draw();
                },
                error: function(xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error('Error al obtener datos:', status, error);
                }
            });
        }
    </script>
<?php
} /**/
?>