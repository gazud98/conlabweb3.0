$(document).ready(function() {

    $('#contentTableNegociaciones').load('https://cw3.tierramontemariana.org/apps/negociaciones/tabla.php');

});

function guardarDatos2() {
    data = $('#formcontrolNeg').serialize();
    $.ajax({
        method: 'POST',
        url: 'https://cw3.tierramontemariana.org/apps/negociaciones/agregar-neg.php',
        data: data,
        success: function(response) {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Registro exitoso",
                showConfirmButton: false,
                timer: 1500
            });
            $('#addNegociaciones').modal('hide');
        },
        error: function(error) {
            console.error('Error al guardar datos:', error);
        }
    });
}

