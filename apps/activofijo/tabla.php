<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<button type="button" class="btn btn-light" onclick="exportarExcel()" title="Generar Excel">
    <i class="fa-solid fa-file-excel fa-2x" style="color:green;transition: color 0.3s;"></i>&nbsp;&nbsp;Generar Excel

</button>

<style>
    .table-bordes-d {
        border: 1px solid #d2d2d2;
        border-radius: 10px;
        font-size: 14px;
        text-align: center;
        padding: 2px;
    }

    table.table tr td {
        border-top: 1px solid #d2d2d2;
        padding: 2px !important;
    }
</style>

<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm table-producto " style="width:100%" id="table-producto">
    <thead>
        <tr>

            <th style="width:55%;text-align:center;">Nombre</th>
            <th style="text-align:center;">Valor</th>
            <th style="text-align:center;">Depreciación</th>
            <th style="text-align:center;">Estado</th>
            <th style="width:15%;text-align:center">Acciones</th>

        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<script>
    function exportarExcel() {
        var nombreArchivo = 'reporte.xlsx';
        var tabla = document.getElementById('table-producto');
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


        miDataTable = $('.table-producto').DataTable({
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
                url: 'https://conlabweb3.tierramontemariana.org/apps/activofijo/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [{
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
                            return '<span style=" color: red;" id=""estado><span class="badge badge-danger">Inhabilitado</span></span>';
                        } else if (full.estado === "1") {
                            return '<span style=" color: green;" id=""estado><span class="badge badge-success">Habilitado</span></span>';
                        }
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {

                        return '<a href="#" title="Editar" class="ver-activo" style="color:#E8A200;" onclick="loadTextFieldsEdit(' + full.id_producto + ')" data-toggle="modal" data-target="#modalEditActivoFijo"><i class="fa-solid fa-eye" style="font-size:13px;"></i></a>' +
                            '<a href="#" class="eliminar-activo" title="Borrar" style="color:#D62121;" onclick="deleteProduct(' + full.id_producto + ')"><i class="fa-solid fa-trash-can" style="font-size:13px;"></i></a>' +
                            '<a href="#" class="desactivar-activo" title="Desactivar" style="color:#323D66;" onclick="disableProduct(' + full.id_producto + ',' + full.estado + ')"><i class="fa-solid fa-power-off" style="font-size:13px;"></i></a>' +
                            '<a href="#addEmployeeModal" class="ver-historial" onclick="loadHistorial(' + full.id_producto + ')" title="Historial de mantenimientos" data-toggle="modal" style="color:#1D9F00;"><i class="fa-solid fa-clock-rotate-left" style="font-size:13px;"></i></a>' +
                            '<input type="hidden" name="fileselect' + full.thefile + '" id="fileselect' + full.thefile + '"" value="' + full.tipo_prod + '" max="' + full.max + '">';
                    }
                }
            ]
        });
    });


    function deleteProduct(id) {
        Swal.fire({
            text: "¿Desea borrar el registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'https://conlabweb3.tierramontemariana.org/apps/activofijo/crud-2.php?aux=3&id=' + id,
                    success: function() {
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro borrado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        cargarDatos();
                    }
                })
            }
        })
    }

    function loadTextFieldsEdit(id) {
        $('#camposEdit').load('https://conlabweb3.tierramontemariana.org/apps/activofijo/campos-edit.php', {
            id: id
        });

    }

    function disableProduct(id, estado) {
        if (estado == 1) {
            Swal.fire({
                text: "¿Desea desactivar el registro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, desactivar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'https://conlabweb3.tierramontemariana.org/apps/activofijo/crud-2.php?id=' + id + '&aux=4&estado=' + estado,
                        success: function() {

                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro desactivado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            cargarDatos();
                        }
                    })
                }
            })
        } else {
            Swal.fire({
                text: "¿Desea activar el registro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, activar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'https://conlabweb3.tierramontemariana.org/apps/activofijo/crud-2.php?id=' + id + '&aux=4&estado=' + estado,
                        success: function() {
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro activado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            cargarDatos();

                        }
                    })
                }
            })
        }
    }

    function loadHistorial(id) {
        $('#tableHistorial').load('https://conlabweb3.tierramontemariana.org/apps/activofijo/historial.php', {
            id: id
        });
    }


    function cargarDatos() {
        $.ajax({
            url: 'https://conlabweb3.tierramontemariana.org/apps/activofijo/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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