<?php
//SI POSEE CONSUKTA

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
if (isset($_REQUEST['iduser'])) {
    $iduser = $_REQUEST['iduser'];

    if ($iduser == "-1") {
        $iduser = "";
    }
} else {
    $iduser = "0";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {
    $cadena23 = "SELECT count(id) as max
    FROM u116753122_cw3completa.ordrequisicion_temp";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }
    $cadena = "SELECT a.id,a.id_sede, a.id_producto,c.nombre_1,c.nombre_2,c.apellido_1,c.apellido_2,a.id_persona,a.cantidad,e.nombre
    FROM u116753122_cw3completa.ordrequisicion_temp a,u116753122_cw3completa.producto e, u116753122_cw3completa.persona c
     where a.id_producto = e.id_producto and a.id_persona = c.id_persona";
    // echo $cadena;
    /**/

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
}
?>

<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

<table id="table-solicitud" class="table table-striped table-hover table-head-fixed text-nowrap table responsive table-sm " style="width:100%;font-size:13px;">
    <thead>
        <tr>
            <th style="text-align: center;width:65%;">Producto</th>

            <th style="text-align: center;">Cantidad</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<div style="display: none;">
    <input type="input" id="id_user" value="<?php echo $iduser ?>"></input>
</div>




<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        miDataTable = $('#table-solicitud').DataTable({
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
                url: 'https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [{
                    "data": "nombre",
                },
                {
                    "data": "cantidad",
                    "render": function(data, type, full, meta) {
                        var html = '<input type="number" style="text-align:center;" id="cant1' + full.thefile + '" value="' + full.cantidad + '" onchange="aprobarOrden(' + full.thefile + ',' + full.codigo + ')">';
                        return html;
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        //   var html = '<a href="#" style="color: #E8A200;" title="Editar" data-target="#modalrevisar" data-toggle="modal" onclick="enviarDatos(' + full.codigo + ');"><i id="icon" style="font-size:18px;" class="fa-solid fa-pen-to-square"></i></a>';
                        var html = '<a  href="#" style="color: #CE2222;" title="Eliminar" onclick="eliminardatos(' + full.codigo + ',\'' + full.nombre + '\');"><i id="icon" style="font-size:18px;" class="fa-solid fa-trash-can"></i></a>';
                        return html;
                    }
                },
            ]
        });
    });

    function cargarDatos() {
        $.ajax({
            url: 'https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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



    var datos = $('input[name="fileselect1"]').attr('datos');
    if (datos == 1) {
        $("#btnreq").load('https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/orden.php');
    }





    function aprobarOrden(thefile, id) {
        var objeto = "#cant1" + thefile;
        var cantm = $(objeto).val();
        $.ajax({
            type: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/aprobarorden.php',
            data: {
                iduser: iduser,
                cantm: cantm,
                idsol: id
            },
            success: function(respuesta) {
                $("#table").load('https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/tabla.php', {
                    iduser: iduser
                });
                Swal.fire({
                    icon: 'success',
                    title: '¡Satisfactorio!',
                    text: '¡Cantidad Actualizada con Exito!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    timer: 1500,
                });
            }
        });
    }

    function eliminardatos(id, nombre) {
        Swal.fire({
            title: '¿Estas Seguro de Borrar el Producto ' + nombre + '?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, Borralo!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    '¡Eliminado!',
                    '¡Tu Producto ha sido Eliminado!',
                    'success'
                )
                $.ajax({
                    type: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/crud.php',
                    data: {
                        id: id,
                        status: 'D'
                    },
                    success: function(data) {

                        cargarDatos();

                    }
                })
            }
        })


    }

  
</script>