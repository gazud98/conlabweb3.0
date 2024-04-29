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
    <link rel="stylesheet" href="https://cw3.tierramontemariana.org/apps/mantenimientos/assets/style.css">


    <style>
        
    </style>

    <table class="table table-striped table-head-fixed text-nowrap table-sm" id="table-mantenimiento" style="width: 100%;font-size:15px;">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Equipo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
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
                url: 'https://cw3.tierramontemariana.org/apps/mantenimientos/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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
                            '<a href="#" style="color:#D62121;" onclick="deleteProduct(' + full.thefile + ',' + full.id + ')" title="Eliminar"><i class="fa-solid fa-trash-can" style="font-size:13px;"></i></a>' +
                            '<input type="hidden" name="fileselect' + full.thefile + '" id="fileselect' + full.thefile + '"" value="' + full.tip_m + '" max="' + full.max + '">';

                    }
                }
            ]
        });
    });

    function deleteProduct(thefile, id) {

        var theobject = "fileselect" + thefile;
        var tpm = $('input[name="' + theobject + '"]').val();

        if(tpm == 'C'){
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
                        url: 'https://cw3.tierramontemariana.org/apps/mantenimientos/delete.php?id=' + id,
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
        }else if(tpm == 'P'){
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
                        url: 'https://cw3.tierramontemariana.org/apps/mantenimientos/delete-2.php?id=' + id,
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
            url: 'https://cw3.tierramontemariana.org/apps/mantenimientos/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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
            $("#textFieldsEdit").load("https://cw3.tierramontemariana.org/apps/mantenimientos/edit-correctivo.php", {
                id: id
            });
            $('#titleEdit').html('Mantenimiento Correctivo');
        } else {
            $("#textFieldsEdit").load("https://cw3.tierramontemariana.org/apps/mantenimientos/edit-preventivo.php", {
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
</script>