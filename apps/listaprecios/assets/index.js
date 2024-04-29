$(document).ready(function() {

    $('.content-table-examenes').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-examen.php');
    $('.content-table-precio-examenes').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-lista-examen.php');
    $('.content-detalle-lista').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-detalle-lista.php');

    document.addEventListener('keydown', manejarTecla);
    
    viewTotalExamenes();

})

function viewTotalExamenes(){
    $.ajax({
        type: 'POST',
        url: 'https://cw3.tierramontemariana.org/apps/listaprecios/mostrar.php?aux=4',
        success: function (res) {
            $('#totalexas').html(res);
        }
    });
}

function manejarTecla() {
    if (event.keyCode === 13) {
        moverDatos()
    }
}

function moverDatos() {

    var box = document.getElementsByName('seleccionar2');
    var valor_seleccionado = null;

    for (var i = 0; i < box.length; i++) {
        if (box[i].checked) {
            ide = 0;

            const checkboxes1 = document.querySelectorAll('.checkbox2:checked');

            checkboxes1.forEach(checkbox => {
                ide = checkbox.getAttribute('data-id-2');
                //datosSeleccionados.push(id);
            });

            const checkboxes = document.querySelectorAll('input[name="seleccionar[]"]:checked');

            const datosSeleccionados = [];

            checkboxes.forEach(checkbox => {
                const filaOrigen = checkbox.closest('tr');
                const id = filaOrigen.cells[0].innerText;
                const nombre = filaOrigen.cells[1].innerText;

                datosSeleccionados.push({
                    id,
                    nombre,
                    ide
                });
            });

            const formData = new FormData();
            formData.append('datos', JSON.stringify(datosSeleccionados));

            fetch('https://cw3.tierramontemariana.org/apps/listaprecios/procesar.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "¡Este examen ya está en la lista!",
                    });
                    console.error(error);
                });

            $('.content-table-precio-examenes').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-lista-examen.php', {
                id: ide
            });
            
            viewTotalExamenesLista(ide)
            
            break;
        } else {
            //alert("Tiene que seleccionar una lista");
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Tiene que seleccionar una lista",
            });
        }
    }

}

function setDetalleLista() {

    $.ajax({
        type: 'POST',
        url: 'https://cw3.tierramontemariana.org/apps/listaprecios/crud.php?aux=8',
        data: $('#formDetalleLista').serialize(),
        success: function (respuesta) {

            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });
            //alert("¡Registro Exitoso!");
            $('.content-detalle-lista').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-detalle-lista.php');
        }
    });

}

function updateProcentaje() {

    var radios = document.getElementsByName('inlineRadioOptions');
    var valor_seleccionado = null;

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            valor_seleccionado = radios[i].value;
            break;
        }
    }

    var frecuencia = $('#frecuencialista').val();
    var procentaje = $('#procentaje').val();

    var checkboxes = document.getElementsByName('seleccionar3[]');
    var totalCheckboxes = checkboxes.length;
    var checkboxesSeleccionados = 0;
    var dataIDSeleccionado = null;

    for (var i = 0; i < totalCheckboxes; i++) {
        if (checkboxes[i].checked) {
            checkboxesSeleccionados++;
            dataIDSeleccionado = checkboxes[i].getAttribute('data-id-3');
        }
    }

    if (checkboxesSeleccionados === totalCheckboxes) {
        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/listaprecios/crud.php?aux=5',
            data: {
                frecuencia: frecuencia,
                procentaje: procentaje,
                valor: valor_seleccionado
            },
            success: function (respuesta) {

                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "¡Registro Exitoso!",
                    showConfirmButton: false,
                    timer: 1500
                });
                //alert("¡Registro Exitoso!");
                $('.content-detalle-lista').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-detalle-lista.php');
            }
        });

    } else if (checkboxesSeleccionados === 1) {
        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/listaprecios/crud.php?aux=6',
            data: {
                frecuencia: frecuencia,
                procentaje: procentaje,
                id: dataIDSeleccionado,
                valor: valor_seleccionado
            },
            success: function (respuesta) {

                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "¡Registro Exitoso!",
                    showConfirmButton: false,
                    timer: 1500
                });
                //alert("¡Registro Exitoso!");
                $('.content-detalle-lista').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-detalle-lista.php');
            }
        });

    } else {

        var radios = document.getElementsByName('inlineRadioOptions');
        var valor_seleccionado2 = null;
        var frecuencia2 = $('#frecuencialista').val();
        var procentaje2 = $('#procentaje').val();

        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                valor_seleccionado2 = radios[i].value;
                break;
            }
        }

        const checkboxes5 = document.querySelectorAll('input[name="seleccionar3[]"]:checked');

        const datosSeleccionados5 = [];

        checkboxes5.forEach(checkbox => {
            const filaOrigen = checkbox.closest('tr');
            const id = filaOrigen.cells[0].innerText;

            datosSeleccionados5.push({
                frecuencia2,
                procentaje2,
                valor_seleccionado2,
                id
            });

            console.log(datosSeleccionados5);

        });

        const formData2 = new FormData();
        formData2.append('datos_b', JSON.stringify(datosSeleccionados5));

        fetch('https://cw3.tierramontemariana.org/apps/listaprecios/crud.php?aux=7', {
            method: 'POST',
            body: formData2
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error(error);
            });

        $('.content-table-precio-examenes').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-lista-examen.php');
    }

}

function viewDetalleLista(ide) {
    $('.content-table-precio-examenes').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-lista-examen.php', {
        id: ide
    });
    viewTotalExamenesLista(ide)
}

function deleteDetalleLista(ide, ide2) {

    Swal.fire({
        title: "Está seguro?",
        text: "Está a punto de eliminar el registro!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!"
    }).then((result) => {

        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/listaprecios/crud.php?aux=9',
            data: {
                ide: ide
            },
            success: function (respuesta) {

                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Eliminado!",
                        text: "El registro ha sido eliminado",
                        icon: "success"
                    });
                }

                $('.content-table-precio-examenes').load('https://cw3.tierramontemariana.org/apps/listaprecios/table-lista-examen.php', {
                    id: ide2
                });
                viewTotalExamenesLista(ide2)
            }
        });


    });


}

function grabador(id) {

    var objeto = "#prec" + id;
    var preci2 = $(objeto).val();

    var preci = $("#precio" + id).val();

    preciformat = number_format(parseFloat(preci), 2, '.', ',');
    var numeroDesformateado = preciformat.replace(/[.,]/g, '');

    $("#precio" + id).val(preciformat);

    $("#precio" + id).css("border", "1px solid green");


    $.ajax({
        type: 'POST',
        url: 'https://cw3.tierramontemariana.org/apps/listaprecios/crud.php?aux=4',
        data: {
            id: id,
            preci: numeroDesformateado
        },
        success: function(data) {

        }
    });

}

function number_format(number, decimals, decimalSeparator, thousandsSeparator) {
    return number.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);
}

function viewTotalExamenesLista(id){
    $.ajax({
        type: 'POST',
        url: 'https://cw3.tierramontemariana.org/apps/listaprecios/mostrar.php?aux=5',
        data: {
            id: id
        },
        success: function (res) {
            $('#totalexalista').html(res);
        }
    });
}







