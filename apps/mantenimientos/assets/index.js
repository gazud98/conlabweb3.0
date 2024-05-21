function seleccionar1(sel) {
    var caso = $('option:selected', sel).attr('value');

    $("#period1").load('/cw3/conlabweb3.0/apps/mantenimientos/periodicidad.php', {
        caso: caso
    })

}

$(document).ready(function() {
    var periodicidad = $("#periodicidad").val();
    var period_semanal = $("#period_semanal").val();
    var mesoption = $("#mesoption").val();
    if (periodicidad === "S") {
        $("#period1").load('/cw3/conlabweb3.0/apps/mantenimientos/periodicidad.php', {
            caso: 'S',
            period_semanal: period_semanal,
            mesoption: mesoption
        });
    } else if (periodicidad === "M") {
        $("#period1").load('/cw3/conlabweb3.0/apps/mantenimientos/periodicidad.php', {
            caso: 'M'
        });
    }

    $('#localizacion').change(function() {
        id = $('#localizacion').val();
        $.ajax({
            method: 'POST',
            url: '/cw3/conlabweb3.0/apps/mantenimientos/search-equipo.php?id=' + id,
            success: function(rest) {

                if (rest == '0') {
                    $('#equipo').html('');
                } else {
                    $('#equipo').html(rest);
                }

            }
        })
    })

    $('#localizacion').change(function(){

        id = $('#localizacion').val();

        $('#departamento').load('/cw3/conlabweb3.0/apps/mantenimientos/dep.php', {
            id: id
        });
    })

});

$(document).ready(function() {

    disabledTextFields()

    $('#tipmant').change(function() {
        tipmant = $('#tipmant').val();
        if (tipmant == 1) {
            $('#localizacion').prop('disabled', false);
            $('#departamento').prop('disabled', false);
            $('#equipo').prop('disabled', false);
            $('#id_proveedor').prop('disabled', false);
            $('#meses_garantia').prop('disabled', false);
            $('#responsable').prop('disabled', false);
            $('#periodicidad').prop('disabled', false);
            $('#comenzar').prop('disabled', false);
            $('#fechaFinal').css('display', 'block');
            $('#desc_mantenimiento').prop('disabled', false);
            $('#resp_mantenimiento').prop('disabled', false);
            $('#dir_resp').prop('disabled', false);
            $('#tef_resp').prop('disabled', false);
            $('#emailcontacto').prop('disabled', false);
            $('#danio').prop('disabled', true);
            $('#accion').prop('disabled', true);
            $('#fecha_final').prop('disabled', false);
            $('#repuestos').prop('disabled', true);
            $('#btnSaveMant').prop('disabled', false);
            $('#contentCorrectivo').css('display', 'none');
            $('#contentPreventivo').css('display', 'block');
            $('#contentPreventivo2').css('display', 'block');
            $('#proxFechas').css('display', 'block');
            $('#viewDates').css('display', 'block');
            $('#fechaFinalCorrectivo').css('display', 'none');
        } else {
            $('#localizacion').prop('disabled', false);
            $('#departamento').prop('disabled', false);
            $('#equipo').prop('disabled', false);
            $('#id_proveedor').prop('disabled', false);
            $('#meses_garantia').prop('disabled', false);
            $('#responsable').prop('disabled', false);
            $('#periodicidad').prop('disabled', true);
            $('#comenzar').prop('disabled', false);
            $('#fecha_final').prop('disabled', false);
            $('#desc_mantenimiento').prop('disabled', false);
            $('#resp_mantenimiento').prop('disabled', false);
            $('#dir_resp').prop('disabled', false);
            $('#tef_resp').prop('disabled', false);
            $('#emailcontacto').prop('disabled', false);
            $('#danio').prop('disabled', false);
            $('#accion').prop('disabled', false);
            //$('#repuestos').prop('disabled', false);
            $('#btnSaveMant').prop('disabled', false);
            $('#contentCorrectivo').css('display', 'block');
            $('#contentPreventivo').css('display', 'none');
            $('#contentPreventivo2').css('display', 'none');
            $('#fechaFinal').css('display', 'none');
            $('#proxFechas').css('display', 'none');
            $('#viewDates').css('display', 'none');
            $('.fecha-collapse').removeClass('show');
            $('#fechaFinalCorrectivo').css('display', 'block');
        }
    })

})

function disabledTextFields() {
    $('#localizacion').prop('disabled', true);
    $('#departamento').prop('disabled', true);
    $('#equipo').prop('disabled', true);
    $('#id_proveedor').prop('disabled', true);
    $('#meses_garantia').prop('disabled', true);
    $('#responsable').prop('disabled', true);
    $('#periodicidad').prop('disabled', true);
    $('#comenzar').prop('disabled', true);
    $('#fecha_final').prop('disabled', true);
    $('#desc_mantenimiento').prop('disabled', true);
    $('#resp_mantenimiento').prop('disabled', true);
    $('#dir_resp').prop('disabled', true);
    $('#tef_resp').prop('disabled', true);
    $('#emailcontacto').prop('disabled', true);
    $('#danio').prop('disabled', true);
    $('#accion').prop('disabled', true);
    $('#repuestos').prop('disabled', true);
}