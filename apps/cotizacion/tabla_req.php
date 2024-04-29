<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm table responsive table-cotizacion" style="margin-top: 2%;width:100%;">
    <thead>
        <tr>
            <th></th>
            <th style="text-align:center;">No. Solicitud</th>
            <th style="width:auto;text-align:center;">Solicitante</th>
            <th style="text-align:center;">Fecha</th>
            <th style="text-align:center;">Estado</th>
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

        miDataTable = $('.table-cotizacion').DataTable({
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
            "ajax": {
                url: 'https://cw3.tierramontemariana.org/apps/cotizacion/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [{
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<a href="#" data-toggle="tooltip" data-placement="top" title="Click para ver el detalle de la solicitud" onclick="sending(' + full.thefile + ',' + full.codigo + ')"  value="' + full.codigo + '"><i class="fa-solid fa-eye" style="font-size:14px;"></i></a>';
                    }
                }, {
                    "data": "codigo"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "estado_solicitud"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<a href="#" onclick="borrarSol(' + full.codigo + ');" data-toggle="modal" style="color: #CE2222;" title="Eliminar"><i id="icon" style="font-size:18px;" class="fa-solid fa-trash-can"></i><span></span></a>';
                    }
                }
            ]
        });
    });

    function sending(thefile, id) {
        var theobject = "fileselect" + thefile;
    



        for (let i = 1; i <= thefile; i++) {
            $('#col2' + [i]).css("border", "thin solid  transparent");
        }
        $('#col2' + thefile).css("border", "2px solid #dc3545");
        $("#data").load("https://cw3.tierramontemariana.org/apps/cotizacion/data.php", {
            idr: id
        });
        $("#table").load("https://cw3.tierramontemariana.org/apps/cotizacion/tabla.php", {
            idr: id
        });

    }

    function cargarDatos() {
        $.ajax({
            url: 'https://cw3.tierramontemariana.org/apps/cotizacion/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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

    function borrarSol(id) {
        Swal.fire({
            title: '¿Estas Seguro de que quieres borrar la solicitud No. ' + id + '?',
            text: "¡Esto es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borralo!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Borrado!',
                    '¡La Solicitud No. ' + id + ' ha sido borrada con Exito!',
                    'success'
                )

                $.ajax({
                    type: 'POST',
                    url: 'https://cw3.tierramontemariana.org/apps/cotizacion/eliminar.php',
                    data: {
                        id: id
                    },
                    success: function(data) {

                        cargarDatos();

                        $("#table").load("https://cw3.tierramontemariana.org/apps/cotizacion/tabla.php");

                    }
                });
            }
        })
    }
</script>