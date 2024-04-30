<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<button type="button" class="btn btn-light" onclick="exportarExcel()" title="Generar Excel">
    <i class="fa-solid fa-file-excel fa-2x" style="color:green;transition: color 0.3s;"></i>&nbsp;&nbsp;Generar Excel

</button>
<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm table-empleados" id="table-empleados">
    <thead>
        <tr>
            <th style="width: 25%;text-align:center;">Cargo</th>
            <th style="width: 45%;text-align:center;">Nombre</th>
            <th style="text-align:center;">Estado</th>
            <th style="text-align:center;">Acciones</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- jquery-validation -->
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!--<script src="assets/plugins/jquery/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<script>
    function exportarExcel() {
        var nombreArchivo = 'reporte.xlsx';
        var tabla = document.getElementById('table-empleados');
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

    }
    $(document).ready(function() {
        miDataTable = $('.table-empleados').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            // ... Otras opciones ...
            "ajax": {
                url: '/cw3/conlabweb3.0/apps/empleados/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [

                {
                    "data": "nmbcargo"
                },
                {
                    "data": "nombre",
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        if (full.estado === "0") {
                            return '<span class="badge badge-danger">Inhabilitado</span>';
                        } else if (full.estado === "1") {
                            return '<span class="badge badge-success">Habilitado</span>';
                        }
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {

                        return '<a href="#" style="color:#213FD6;" onclick="loadModalView(' + full.codigo + ')" data-toggle="modal" data-target="#modalViewEmployee"><i class="fa-solid fa-eye" style="font-size:13px;color: #E8A200;"></i></a>' +
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
            title: '¿Desea eliminar este Empleado?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/cw3/conlabweb3.0/apps/empleados/crud.php',
                    data: {
                        id: id,
                        aux: 4
                    },
                    success: function() {
                        Swal.fire(
                            '¡Eliminado!',
                            'El Empleado ha sido eliminado.',
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
                title: '¿Desea deshabilitar este Empleado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deshabilitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/cw3/conlabweb3.0/apps/empleados/crud.php',
                        data: {
                            id: id,
                            aux: 3
                        },
                        success: function() {
                            Swal.fire(
                                'Deshabilitado!',
                                'El empleado ha sido deshabilitado.',
                                'success'
                            )
                            miDataTable.ajax.reload();
                        }
                    })
                }
            })
        } else {
            Swal.fire({
                title: 'Desea habilitar este Empleado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Habilitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/cw3/conlabweb3.0/apps/empleados/crud.php',
                        data: {
                            id: id,
                            aux: 3
                        },
                        success: function() {
                            Swal.fire(
                                'Habilitado!',
                                'El Empleado ha sido habilitado.',
                                'success'
                            )
                            miDataTable.ajax.reload();
                        }
                    })
                }
            })
        }
    }

    function cargarDatos() {
        $.ajax({
            url: '/cw3/conlabweb3.0/apps/empleados/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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

    function loadModalView(id) {
        $('#contentFormEmployeeView').load('/cw3/conlabweb3.0/apps/empleados/modal-view.php', {
            id: id
        });
    }
</script>