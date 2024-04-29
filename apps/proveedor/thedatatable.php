<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<button type="button" class="btn btn-light" onclick="exportarExcel()" title="Generar Excel">
    <i class="fa-solid fa-file-excel fa-2x" style="color:green;transition: color 0.3s;"></i>&nbsp;&nbsp;Generar Excel

</button>
<table class="table table-striped table-hover table-head-fixed text-nowrap    table-sm table-proveedor" id="table-proveedor"
    style="width:100% !important;">
    <thead>
        <tr>
            <th style="text-align:center;">Identificación</th>
            <th style="text-align:center;">Nombre</th>
            <th style="text-align:center;">Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>


<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

<script>
    function exportarExcel() {
        var nombreArchivo = 'reporte.xlsx';
        var tabla = document.getElementById('table-proveedor');
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
    $(document).ready(function () {
        miDataTable = $('.table-proveedor').DataTable({
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
                url: 'https://conlabweb3.tierramontemariana.org/apps/proveedor/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [{
                "data": "identificacion"
            },
            {
                "data": "nombre"
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {
                    // Aquí puedes aplicar estilos o clases CSS según el valor de la propiedad "estado"
                    if (full.estado === "0") {
                        return '<span class="badge badge-danger">Inhabilitado</span>';
                    } else if (full.estado === "1") {
                        return '<span class="badge badge-success">Habilitado</span>';
                    }
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<a href="#" style="color:#213FD6;"  title="Editar" data-toggle="modal" data-target="#modalEditProvider" onclick="loadFormUpdateProvider(' + full.codigo + ')"><i class="fa-solid fa-eye" style="font-size:13px;color: #E8A200;"></i></a>' +
                        '<a href="#" style="color:#D62121;" title="Eliminar"  onclick="deleteProvider(' + full.codigo + ', \'' + full.nombre + '\')"><i class="fa-solid fa-trash-can" style="font-size:13px;"></i></a>' +
                        '<a href="#" style="color:#323D66;"  title="Activar o Desativar"  onclick="disableProvider(' + full.codigo + ',' + full.estado + ')"><i class="fa-solid fa-power-off" style="font-size:13px;"></i></a>' +
                        '<input type="hidden" name="fileselect' + full.thefile + '" id="fileselect' + full.thefile + '"" value="' + full.codigo + '">';
                }
            }
            ]
        });
    });

</script>