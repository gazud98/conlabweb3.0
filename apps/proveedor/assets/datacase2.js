$(document).ready(function () {
    $('#id_tipo_identificacion').select2({
        language: "es"
    });


    $('#pais').select2({
        language: "es"
    });


    $('#dep').select2({
        language: "es"
    });


    $('#ciudad').select2({
        language: "es"
    });


    $('#id_pago').select2({
        language: "es"
    });

    $('#id_tipo_contribuyente').select2({
        language: "es"
    });


    $('#retenfuente').select2({
        language: "es"
    });


    $('#reteica').select2({
        language: "es"
    });


    $('#cuentapagar').select2({
        language: "es"
    });


    $('#categoria').select2({
        language: "es"
    });

    $.validator.setDefaults({
        submitHandler: function () {
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/proveedor/crud.php?aux=2',
                data: $('#formEditProvider').serialize(),
                success: function (respuesta) {

                    if (respuesta == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '¡Este proveedor ya existe!',
                            footer: 'Cree un proveedor con un nuevo nombre'
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
                        $("#iddatas").css("pointer-events", "none");
                        $("#iddatas").css("background-color", "#ededed");
                        $("#accionejec").css("display", "none");
                        $("#accionejec").html("");
                        $("#btones").css("display", "none");
                        $('input[type="input"]').val('');
                        $('input[type="text"]').val('');
                        $('input[type="number"]').val('');
                        $('input[type="date"]').val('');
                        $('select').val('');
                        $('input[type="email"]').val('');
                        $('textarea').val('');
                    }

                    $('#modalEditProvider').modal('hide');

                }
            });



        }
    });
    $('#formEditProvider').validate({
        rules: {
            id_tipo_identificacion: {
                required: true
            },
            documento: {
                required: true
            },
            razon_social: {
                required: true
            },
            nombre_comercial: {
                required: true
            },
            dep: {
                required: true
            },
            ciudad: {
                required: true
            },
            direccion: {
                required: true
            },
            telefono: {
                required: true
            },
            email: {
                required: true
            },
            id_pago: {
                required: true
            }
        },
        messages: {
            id_tipo_identificacion: {
                required: ""
            },
            documento: {
                required: ""
            },
            razon_social: {
                required: ""
            },
            nombre_comercial: {
                required: ""
            },
            dep: {
                required: ""
            },
            ciudad: {
                required: ""
            },
            direccion: {
                required: ""
            },
            telefono: {
                required: ""
            },
            email: {
                required: ""
            },
            id_pago: {
                required: ""
            }


        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
$(document).ready(function () {

    var opcionesSeleccionadas = [];

    // Escucha el evento change de los checkboxes
    $('input[type="checkbox"]').change(function () {
        opcionesSeleccionadas = [];

        // Recorre los checkboxes marcados y agrega sus valores al array
        $('input[type="checkbox"]:checked').each(function () {
            opcionesSeleccionadas.push($(this).val());
        });

        // Puedes usar el array opcionesSeleccionadas según tus necesidades
        $('#regfiscal').val(opcionesSeleccionadas);

    });
    $("#documento").blur(function () {
        calcularDig();
    });



});


function cancelBTN() {
    $("#iddatas").css("pointer-events", "none");
    $("#iddatas").css("background-color", "#ededed");
    $("#accionejec").css("display", "none");
    $("#accionejec").html("");
    $("#btones").css("display", "none");
}


function calcularDigitoVerificacion(myNit) {
    var vpri,
        x,
        y,
        z;

    // Se limpia el Nit
    myNit = myNit.replace(/\s/g, ""); // Espacios
    myNit = myNit.replace(/,/g, ""); // Comas
    myNit = myNit.replace(/\./g, ""); // Puntos
    myNit = myNit.replace(/-/g, ""); // Guiones

    // Se valida el nit
    if (isNaN(myNit)) {
        alert("El nit/cédula '" + myNit + "' no es válido(a).");
        return "";
    };

    // Procedimiento
    vpri = new Array(16);
    z = myNit.length;

    vpri[1] = 3;
    vpri[2] = 7;
    vpri[3] = 13;
    vpri[4] = 17;
    vpri[5] = 19;
    vpri[6] = 23;
    vpri[7] = 29;
    vpri[8] = 37;
    vpri[9] = 41;
    vpri[10] = 43;
    vpri[11] = 47;
    vpri[12] = 53;
    vpri[13] = 59;
    vpri[14] = 67;
    vpri[15] = 71;

    x = 0;
    y = 0;
    for (var i = 0; i < z; i++) {
        y = (myNit.substr(i, 1));
        // console.log ( y + "x" + vpri[z-i] + ":" ) ;

        x += (y * vpri[z - i]);
        // console.log ( x ) ;    
    }

    y = x % 11;
    // console.log ( y ) ;

    return (y > 1) ? 11 - y : y;
}


// Calcular
function calcularDig() {

    // Verificar que haya un numero
    let nit = document.getElementById("documento").value;
    let isNitValid = nit >>> 0 === parseFloat(nit) ? true : false; // Validate a positive integer

    // Si es un número se calcula el Dígito de Verificación
    if (isNitValid) {
        let inputDigVerificacion = document.getElementById("digverificacion");
        inputDigVerificacion.value = calcularDigitoVerificacion(nit);
    }
}