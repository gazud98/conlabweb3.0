<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<button type="button" class="btn btn-light" onclick="exportarExcel()" title="Generar Excel">
    <i class="fa-solid fa-file-excel fa-2x" style="color:green;transition: color 0.3s;"></i>&nbsp;&nbsp;Generar Excel

</button>

<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm table-cargos" id="table-cargos">
    <thead>
        <tr>

            <th style="width:55%;text-align:center;">Nombre</th>
            <th style="text-align:center;">Estado</th>
            <th style="width:15%;text-align:center">Acciones</th>
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
        var tabla = document.getElementById('table-cargos');
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
        miDataTable = $('.table-cargos').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "ajax": {
                url: '/cw3/conlabweb3.0/apps/cargos/show_data.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [{
                    "data": "nombre"
                },
                {
                    "data": "estado",
                    "render": function(data, type, full, meta) {
                        var estadoText = data === "0" ? '<span class="badge badge-danger" >Inhabilitado</span>' : data === "1" ? '<span class="badge badge-success" >Habilitado</span>' : '';
                        return estadoText;
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        var editarLink = '<a href="#" onclick="editar(' + full.codigo + ')" data-target="#editModal" data-toggle="modal" style="color: #E8A200;" title="Editar"><i style="font-size:13px;" id="icon" class="fa-solid fa-eye"></i><span></span></a>';
                        var borrarLink = '<a href="#" onclick="borrar(' + full.codigo + ');" data-toggle="modal" style="color: #CE2222;" title="Eliminar"><i id="icon" style="font-size:13px;" class="fa-solid fa-trash-can"></i><span></span></a>';
                        var desactivarLink = '<a href="#" onclick="desactivar(' + full.codigo + ',' + full.estado + ');" style="color: #061078;" title="Desactivar"><i id="icon" style="font-size:13px;" class="fa-solid fa-power-off"></i><span></span></a>';

                        return editarLink + ' ' + borrarLink + ' ' + desactivarLink;
                    }
                }
            ]
        });
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/cargos/crud.php',
                    data: $('#formcontrol').serialize(),
                    success: function(respuesta) {
                        if (respuesta == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '¡Este Cargo ya existe!',
                                footer: 'Crea un Cargo con un nuevo nombre'
                            })
                        } else {
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro Agregado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            cargarDatos();
                            $('#nombre').val('');
                        }
                    }
                });
                $("#addmodal").modal("hide");
            }
        });
        $('#formcontrol').validate({
            rules: {
                nombre: {
                    required: true
                }
            },
            messages: {
                nombre: {
                    required: "Este campo no puede estar vacío"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/condiciones_pagos/crud.php',
                    data: $('#formeditar').serialize(),
                    success: function(respuesta) {
                        cargarDatos();
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro Actualizado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }

                });
                $("#editModal").modal("hide");
            }
        });
        $('#formeditar').validate({
            rules: {
                nombre: {
                    required: true
                },
                numero: {
                    required: true
                },

            },
            messages: {
                nombre: {
                    required: "Este campo no puede estar vacío"
                },
                numero: {
                    required: "Este campo no puede estar vacío"
                },

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    function borrar(id) {
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
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/cargos/crud.php',
                    data: {
                        id: id,
                        modeeditstatus: 'B'
                    },
                    success: function(respuesta) {

                        cargarDatos();
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro borrado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                });
            }
        })

    }


    function editar(id) {




        $.ajax({
            type: 'GET',
            url: '/cw3/conlabweb3.0/apps/cargos/process_data.php',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // Alerta para depurar


                // Llenar los campos del formulario con los datos obtenidos
                $('#idedit').val(response.id);
                $('#nombredit').val(response.nombre);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                console.error(status);
                console.error(error);
            }
        });



    }

    function desactivar(id, estado) {

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
                        type: 'POST',
                        url: '/cw3/conlabweb3.0/apps/cargos/crud.php',
                        data: {
                            id: id,
                            modeeditstatus: 'D'
                        },
                        success: function(respuesta) {

                            cargarDatos();
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro desactivado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            })

                        }
                    });
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
                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/cargos/crud.php',
                    data: {
                        id: id,
                        modeeditstatus: 'D'
                    },
                    success: function(respuesta) {

                        cargarDatos();

                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro activado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                });
            })
        }
    }

    function cargarDatos() {
        $.ajax({
            url: '/cw3/conlabweb3.0/apps/cargos/show_data.php', // Página PHP que devuelve los datos en formato JSON
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