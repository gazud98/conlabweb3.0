$(document).ready(function () {

    $('.content-info-basic').load('https://conlabweb3.tierramontemariana.org/apps/empresas/info-basica.php');
    $('.content-datos-contacto').load('https://conlabweb3.tierramontemariana.org/apps/empresas/datos-contacto.php');
    $('.content-datos').load('https://conlabweb3.tierramontemariana.org/apps/empresas/otros-datos.php');
    $('#datos-facturacion').load('https://conlabweb3.tierramontemariana.org/apps/empresas/info-facturacion.php');
    $('#info-cartera').load('https://conlabweb3.tierramontemariana.org/apps/empresas/info-cartera.php');
    $('.content-table-req-insumos').load('https://conlabweb3.tierramontemariana.org/apps/empresas/table-req-insumos.php');
    $('.content-table-docs').load('https://conlabweb3.tierramontemariana.org/apps/empresas/table-docs.php');
    $('#info-glosas').load('https://conlabweb3.tierramontemariana.org/apps/empresas/glosas.php');
    $('#info-tributaria').load('https://conlabweb3.tierramontemariana.org/apps/empresas/info-tributaria.php');
    $('.content-table-empresa').load('https://conlabweb3.tierramontemariana.org/apps/empresas/table-empresas.php');

    $('#btnRefresh').click(function () {
        $('.content-table-empresa').load('https://conlabweb3.tierramontemariana.org/apps/empresas/table-empresas.php');
        $('#btnLoadModals-1').prop('disabled', true);
        $('#btnLoadModals-2').prop('disabled', true);
        $('#btnLoadModals-3').prop('disabled', true);
        $('#btnLoadModals-4').prop('disabled', true);
        $('#titleInfo').css('display', 'block');
    })

    /* update ------------------ */



    /*----*/

    $('#producto').select2({
        language: "es"
    });

})

function setPlan() {
    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=7',
        data: $('#formCrearPlan').serialize(),
        success: function (respuesta) {
            //$('.content-table-unidad_medida').load('https://conlabweb3.tierramontemariana.org/apps/planes/thedatatable.php');

            Swal.fire({
                position: 'top',
                icon: 'success',
                title: '¡Registro Agregado con exito!',
                showConfirmButton: false,
                timer: 1500
            })
            //$("#addModal").modal("hide");
            //$('#nombre').val('');
        }
    });
}

function setEmpresa() {

    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=1',
        data: $('#formDatosBasicos').serialize(),
        success: function (respuesta) {

            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });
            $('#contentTableEmpresas2').load('..https://conlabweb3.tierramontemariana.org/apps/empresas/table-empresas.php');
        }
    });

} //de alvar datos

function loadModalEditEmpresa(id) {
    $('.content-edit-empresa').load('https://conlabweb3.tierramontemariana.org/apps/empresas/modal-edit-empresa.php', {
        id: id
    });
}

function loadModalCrearPlan(id) {
    $('#idEmpresaReq').val(id);
}

function loadViewPlanesEmpresa(id) {
    $('.content-table-planes').load('https://conlabweb3.tierramontemariana.org/apps/empresas/table-planes-empresa.php', {
        id: id
    });
}

function loadModalEditPlan(id) {
    $('#showTextFields').load('https://conlabweb3.tierramontemariana.org/apps/empresas/modal-edit-planes.php', {
        id: id
    });
}


function updateEmpresa() {

    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=2',
        data: $('#formEditDatosBasicos').serialize(),
        success: function (respuesta) {
            //alert("¡Registro Exitoso!");
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });
            $('#modalEditEmpresas').modal('hide');
            miDataTableEmpresas.ajax.reload();
        }
    });

}

function deleteEmpresa(id) {

    Swal.fire({
        title: "Estás seguro?",
        text: "Estás a punto de eliminar un registro!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=9',
                data: {
                    id: id
                },
                success: function (respuesta) {
                    //alert("¡Registro Exitoso!");
                    Swal.fire({
                        title: "Eliminado!",
                        text: "El registro ha sido eliminado.",
                        icon: "success"
                    });
                    $('#contentTableEmpresas2').load('https://conlabweb3.tierramontemariana.org/apps/empresas/table-empresas.php');
                }
            });
        }
    });

}

function updatePlan() {

    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=8',
        data: $('#formEditPlan').serialize(),
        success: function (respuesta) {
            //alert("¡Registro Exitoso!");
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });
            $('#formEditPlan').modal('hide');
        }
    });

}

function setInfoFact() {

    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=5',
        data: $('#formInfoFacturacion').serialize(),
        success: function (respuesta) {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });
            //alert("¡Registro Exitoso!");
        }
    });

}

function confirmRadioSelected() {
    var radios = document.getElementsByName('selectempresa');
    var valor_seleccionado2 = null;

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            valor_seleccionado2 = radios[i].value;
            break;
        }
    }

    if (valor_seleccionado2 == null) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "No has seleccionado una empresa!",
        });

    } else {
        //alert(valor_seleccionado2);
        $('#idEmpresaReq').val(valor_seleccionado2);
        $('#idEmpresaReq2').html(valor_seleccionado2);
        $('#idempresafact').val(valor_seleccionado2);
        //$('#cardInfoFact').css('border', '2px solid #00B573');
    }

}

/* update ---------------------------- */

function setMotivoGlosas() {

    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=4',
        data: $('#formMotivoGlosas').serialize(),
        success: function (respuesta) {
            //alert("¡Registro Exitoso!");
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

}

function updateMotivoGlosas() {

    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=10',
        data: $('#formMotivoGlosas').serialize(),
        success: function (respuesta) {
            //alert("¡Registro Exitoso!");
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

}

function updateMotivoGlosas() {

    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=4',
        data: $('#formMotivoGlosas').serialize(),
        success: function (respuesta) {
            //alert("¡Registro Exitoso!");
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

}

function setEntidadesBancarias() {


    $.ajax({
        type: 'POST',
        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=6',
        data: $('#formDatosEndBanc').serialize(),
        success: function (respuesta) {
            //alert("¡Registro Exitoso!");
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "¡Registro Exitoso!",
                showConfirmButton: false,
                timer: 1500
            });

            $('#modalEntidadesBanc').modal('hide');
        }
    });
}

function loadEdnBanc(id) {
    $('#contentTextFileds').load('https://conlabweb3.tierramontemariana.org/apps/empresas/modal-end-banc-edit.php', {
        id: id
    });
}

function deleteEndBanc(id) {
    Swal.fire({
        title: "Estás seguro(a)?",
        text: "Estás a punto de eliminar un registro!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!"
    }).then((result) => {
        $.ajax({
            type: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=12',
            data: {
                id: id
            },
            success: function (respuesta) {
                //alert("¡Registro Exitoso!");
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Eliminado!",
                        text: "El registro ha sido eliminado.",
                        icon: "success"
                    });
                }
                miDataTableEndBanc.ajax.reload();
            }
        });

    });
}

function loadMotivosGlosas(id) {
    $('#modalMotivoGlosas').load('https://conlabweb3.tierramontemariana.org/apps/empresas/modal-edit-motivos-glosas.php', {
        id: id
    });
}