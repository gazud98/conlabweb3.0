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
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {
}
?>

<style>
    table.table tr td {
        border-top: 1px solid #d2d2d2;
        padding: 2px !important;
    }
</style>


<table class="table table-hover table-borderless table-bordes-d" style="margin-top: 2%;" id="tableNeg">
    <thead>
        <tr>
            <th>Empresa/Médico/Persona Natural</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    </tbody>
</table>

<script>
    $(document).ready(function() {

        miDataTableVisitasNeg = $('#tableNeg').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                url: 'https://conlabweb3.tierramontemariana.org/apps/consultavisitas/mostrar-2.php?aux=6', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '',
                data: function(d) {
                    d.fecha1 = $('#fecha_i').val();
                    d.fecha2 = $('#fecha_f').val();
                    d.estado = $('#estado').val();
                },
            },
            "columns": [{
                    "data": "objeto"
                },
                {
                    "data": "estado",
                    "render": function(data, type, full, meta) {
                        if (full.estado == 1) {
                            return '<span class="badge badge-warning">En proceso</span>';
                        } else if (full.estado == 2) {
                            return '<span class="badge badge-danger">Terminado</span>';
                        } else {
                            return '<span class="badge badge-info">Cita Programada</span>';
                        }
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '&nbsp;&nbsp;<button class="btn btn-secondary btn-sm" onclick="loadDetailsNeg(' + full.id + ')">Seleccionar <i class="fa-solid fa-arrow-right" style="font-size:13px;"></i></button>'
                    }
                }

            ],

        })

        $('#btnFilter3').click(function() {
            miDataTableVisitasNeg.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        });

    });

    function loadDetailsNeg(id) {
        $('#contentViewProcessNeg').load('/cw3/conlabweb3.0/apps/negociaciones/show-neg.php', {
            id: id
        });
    }

    function negFinalized(id) {
        Swal.fire({
            title: "¿Estás seguro(a)?",
            text: "¡Estás a punto de fiunalizar la negociación!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, finalizar!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'https://conlabweb3.tierramontemariana.org/apps/consultavisitas/crud.php?aux=1&lat=' + latitud + '&long=' + longitud,
                    url: '/cw3/conlabweb3.0/apps/negociaciones/crud.php?aux=4',
                    data: {
                        id: id
                    },
                    success: function() {
                        Swal.fire({
                            title: "¡Finalizada!",
                            text: "La negociación ha sido finalizada.",
                            icon: "success"
                        });
                    url: 'https://conlabweb3.tierramontemariana.org/apps/consultavisitas/crud.php?aux=2&lat=' + latitud + '&long=' + longitud,
                        miDataTableVisitasNeg.ajax.reload();
                        $('#contentViewProcessNeg').load('/cw3/conlabweb3.0/apps/negociaciones/show-neg.php', {
                            id: id
                        });
                    }
                })
            }
        });
    }
</script>