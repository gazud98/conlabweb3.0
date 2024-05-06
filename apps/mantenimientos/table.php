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



// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');

    // echo '..............................';

?>
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/mantenimientos/assets/style.css">


    <style>
        .table-bordes-d {
            border: 1px solid #d2d2d2;
            border-radius: 10px;
            font-size: 14px;
            text-align: center;
        }

        table.table tr td {
            border-top: 1px solid #d2d2d2;
            padding: 2px !important;
        }
    </style>

    <table class="table table-borderless table-bordes-d table-hover" id="table-mantenimiento" style="width: 100%;font-size:15px;">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Equipo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Confirmar Mant.</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="modal fade" id="confirmMant" tabindex="-1" aria-labelledby="confirmMantLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmMantLabel">Confirmar Mantenimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Fecha de realización:</label>
                            <input type="date" name="fechamant" id="fechamant" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="confirmMant()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
<?php
} /**/
?>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {
        miDataTable = $('#table-mantenimiento').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            // ... Otras opciones ...
            "ajax": {
                url: 'https://conlabweb3.tierramontemariana.org/apps/mantenimientos/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [{
                    "data": "codigo"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        // Aquí puedes aplicar estilos o clases CSS según el valor de la propiedad "estado"
                        if (full.estado === "P") {
                            return '<span class="badge badge-warning">Pendiente</span>';
                        } else if (full.estado === "F") {
                            return '<span class="badge badge-primary">Finalizado</span>';
                        } else if (full.estado === "V") {
                            return '<span class="badge badge-danger">Vencido</span>';
                        }
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<a href="#" style="color:#213FD6;" onclick="cargarForm(' + full.thefile + ',' + full.id + ')" title="Editar" data-toggle="modal" data-target="#modalEditar"><i class="fa-solid fa-pen-to-square" style="font-size:13px;"></i></a>' +
                            '&nbsp;&nbsp;&nbsp;<a href="#" style="color:#D62121;" onclick="deleteProduct(' + full.thefile + ',' + full.id + ')" title="Eliminar"><i class="fa-solid fa-trash-can" style="font-size:13px;"></i></a>' +
                            '<input type="hidden" name="fileselect' + full.thefile + '" id="fileselect' + full.thefile + '"" value="' + full.tip_m + '" max="' + full.max + '">';

                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirmMant"><i class="fa-solid fa-check" style="font-size:13px;"></i> &nbsp; Confirmar</button>'
                    }
                }
            ]
        });
    });

    function deleteProduct(thefile, id) {

        var theobject = "fileselect" + thefile;
        var tpm = $('input[name="' + theobject + '"]').val();

        if (tpm == 'C') {
            Swal.fire({
                title: 'Desea eliminar este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'https://conlabweb3.tierramontemariana.org/apps/mantenimientos/delete.php?id=' + id,
                        success: function() {
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            )
                            miDataTable.ajax.reload();
                        }
                    })
                }
            })
        } else if (tpm == 'P') {
            Swal.fire({
                title: 'Desea eliminar este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'https://conlabweb3.tierramontemariana.org/apps/mantenimientos/delete-2.php?id=' + id,
                        success: function() {
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
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
            url: 'https://conlabweb3.tierramontemariana.org/apps/mantenimientos/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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

    function cargarForm(thefile, id) {
        var theobject = "fileselect" + thefile;
        var tm = $('input[name="' + theobject + '"]').val();

        var max = $('input[name="' + theobject + '"]').attr('max');

        for (let i = 1; i <= max; i++) {
            $("input[name=fileselect" + [i] + "]").prop("checked", false);

            //Cargo forma con valaores pa aedita o eliminar
            //$("#newbtn").css("display", "block");
            $("#successbtn").css("display", "none");
            $("#cancelbtn").css("display", "none");

            $("#modbtn").css("display", "block");
            $("#delbtn").css("display", "block");
        }
        $("input[name=fileselect" + thefile + "]").prop("checked", true);

        $("#tp").css("display", "none");



        if (tm == 'C') {
            $("#textFieldsEdit").load("https://conlabweb3.tierramontemariana.org/apps/mantenimientos/edit-correctivo.php", {
                id: id
            });
            $('#titleEdit').html('Mantenimiento Correctivo');
        } else {
            $("#textFieldsEdit").load("https://conlabweb3.tierramontemariana.org/apps/mantenimientos/edit-preventivo.php", {
                id: id
            });
            $('#titleEdit').html('Mantenimiento Preventivo');
        }

        $('#iddatas').css('pointer-events', 'auto');
        $('#iddatas').css('background-color', 'white');
        $("#successbtn").css("display", "block");
        $("#cancelbtn").css("display", "block");
        $("#modbtn").css("display", "none");
        $("#delbtn").css("display", "none");

    }

    function cargarTipoMant(thefile, id) {

        var theobject = "fileselect" + thefile;
        var tpm = $('input[name="' + theobject + '"]').val();

        $('#tipomant').val(tpm);
        $('#idmant').val(id);

    }

    function confirmMant() {

        tipomant = $('#tipomant').val();
        idmant = $('#idmant').val();
        fechamant = $('#fechamant').val();

        Swal.fire({
            title: 'Desea confirmar este mantenimiento?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'https://conlabweb3.tierramontemariana.org/apps/mantenimientos/confirm.php',
                    data: {
                        id: idmant,
                        tipomant: tipomant,
                        fechamant: fechamant
                    },
                    success: function() {
                        Swal.fire(
                            'Confirmado!',
                            'El mantenimiento ha sido confirmado.',
                            'success'
                        )
                        miDataTable.ajax.reload();
                        $('#confirmMant').modal('hide');
                    }
                })
            }
        })

    }
</script>