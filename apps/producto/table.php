
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-striped table-hover table-head-fixed text-nowrap table responsive  table-sm table-producto" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Referencia</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
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
    miDataTable = $('.table-producto').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
        },
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        ajax: {
            url: 'https://conlabweb3.tierramontemariana.org/producto/mostrar.php',
            type: 'GET',
            dataType: 'json',
            dataSrc: '',
            error: function(xhr, status, error) {
                console.error("Error en la carga de datos: ", error);
                console.error("Detalles del error: ", xhr.responseText);
            }
        },
        columns: [
            { data: 'nombre' },
            { data: 'referencia' },
            {
                data: 'estado',
                render: function(data, type, full, meta) {
                    if (data === "0") {
                        return '<span class="badge badge-danger">Inhabilitado</span>';
                    } else if (data === "1") {
                        return '<span class="badge badge-success">Habilitado</span>';
                    } else {
                        return '<span class="badge badge-secondary">Desconocido</span>';
                    }
                }
            },
            {
                data: null,
                render: function(data, type, full, meta) {
                    return '<a href="#" style="color:#E8A200;" onclick="cargarForm(\'' + full.thefile + '\', ' + full.id_producto + ',\'' + full.tipo_prod + '\')" data-toggle="modal" data-target="#modaEditEquipo"><i class="fa-solid fa-eye" style="font-size:13px;"></i></a>' +
                           '<a href="#" style="color:#D62121;" onclick="deleteProduct(' + full.id_producto + ')"><i class="fa-solid fa-trash-can" style="font-size:13px;"></i></a>' +
                           '<a href="#" style="color:#323D66;" onclick="disableProduct(' + full.id_producto + ',' + full.estado + ')"><i class="fa-solid fa-power-off" style="font-size:13px;"></i></a>';
                }
            }
        ]
    });
});


        function deleteProduct(id) {
            Swal.fire({
                title: 'Desea eliminar este producto?',
                text: "¡Esto es irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'https://conlabweb3.tierramontemariana.org/producto/delete.php?id=' + id,
                        success: function() {
                            Swal.fire(
                                '¡Eliminado!',
                                'El producto ha sido eliminado.',
                                'success'
                            )
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
                    confirmButtonText: 'Si, Deshabilitar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'https://conlabweb3.tierramontemariana.org/producto/crud-2.php',
                            data: {
                                id: id,
                                aux: 2
                            },
                            success: function() {
                                Swal.fire(
                                    '¡Deshabilitado!',
                                    'El producto ha sido deshabilitado.',
                                    'success'
                                )
                                miDataTable.ajax.reload();
                            }
                        })
                    }
                })
            } else {
                Swal.fire({
                    title: '¿Desea habilitar este producto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, Habilitar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'https://conlabweb3.tierramontemariana.org/producto/crud-2.php',
                            data: {
                                id: id,
                                aux: 2
                            },
                            success: function() {
                                Swal.fire(
                                    '¡Habilitado!',
                                    'El producto ha sido habilitado.',
                                    'success'
                                )
                                miDataTable.ajax.reload();
                            }
                        })
                    }
                })
            }
        }

        function cargarForm(thefile, id, tp) {
            if (tp == 'I') {
                $("#contentFormEditEquipo").load("https://conlabweb3.tierramontemariana.org/producto/productos.php", {
                    id: id
                });

            } else {
                $("#contentFormEditEquipo").load("https://conlabweb3.tierramontemariana.org/producto/equipos.php", {
                    id: id
                });
            }
        }
    </script>
