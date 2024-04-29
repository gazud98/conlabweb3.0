function loadFormAddProvider(){
    $('#contenFormAddProvider').load('https://cw3.tierramontemariana.org/apps/proveedor/datacase1.php');
}

$(document).ready(function() {

    $('#thetable').load('https://cw3.tierramontemariana.org/apps/proveedor/thedatatable.php');

});

function loadFormUpdateProvider(id) {
    $('#contenFormEditProvider').load('https://cw3.tierramontemariana.org/apps/proveedor/modal-edit.php', {
        id: id
    });
}

function cargarDatos() {
    $.ajax({
        url: 'https://cw3.tierramontemariana.org/apps/proveedor/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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

function deleteProvider(id, nombre) {
    Swal.fire({
        title: '¿Estas Seguro de borrar el Proveedor ' + nombre + '?',
        text: "¡Esto es irreversible!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Borralo!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'https://cw3.tierramontemariana.org/apps/proveedor/crud.php',
                data: {
                    id: id,
                    aux: 4
                },
                success: function() {
                    Swal.fire(
                        '¡Borrado!',
                        'El Proveedor ha sido borrado.',
                        'success'
                    )
                    cargarDatos();
                    $("#iddatas").css("pointer-events", "none");
                    $("#iddatas").css("background-color", "#ededed");
                    $("#accionejec").css("display", "none");
                    $("#accionejec").html("");
                }
            })
        }
    })


}

function disableProvider(id, estado) {
    if (estado == 1) {
        Swal.fire({
            title: '¿Desea deshabilitar este Proveedor?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, Deshabilitar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'https://cw3.tierramontemariana.org/apps/proveedor/crud.php',
                    data: {
                        id: id,
                        aux: 3
                    },
                    success: function() {
                        Swal.fire(
                            '¡Deshabilitado!',
                            'El Proveedor ha sido deshabilitado.',
                            'success'
                        )
                        cargarDatos();
                        $("#iddatas").css("pointer-events", "none");
                        $("#iddatas").css("background-color", "#ededed");
                        $("#accionejec").css("display", "none");
                        $("#accionejec").html("");
                    }
                })
            }
        })
    } else {
        Swal.fire({
            title: '¿Desea habilitar este Proveedor?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, Habilitar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'https://cw3.tierramontemariana.org/apps/proveedor/crud.php',
                    data: {
                        id: id,
                        aux: 3
                    },
                    success: function() {
                        Swal.fire(
                            '¡Habilitado!',
                            'El Proveedor ha sido habilitado.',
                            'success'
                        )
                        cargarDatos()
                        $("#iddatas").css("pointer-events", "none");
                        $("#iddatas").css("background-color", "#ededed");
                        $("#accionejec").css("display", "none");
                        $("#accionejec").html("");
                    }
                })
            }
        })
    }
}


function cargarForm(thefile, id) {
    collapseanshow('E');

    // Usar la función de carga con un callback
    $("#casoesperado").load("https://cw3.tierramontemariana.org/apps/proveedor/datacase1.php", {
        id: id,
        p: "proveedor",
        status: 'E'
    }, function(response, status, xhr) {
        // Este código se ejecutará después de que la carga esté completa
        if (status === "success") {
            // Código adicional que deseas ejecutar después de cargar
            $("#btones").css("display", "block");
        } else {
            // Manejar errores si es necesario
            console.log("Error cargando contenido.");
        }
    });
}