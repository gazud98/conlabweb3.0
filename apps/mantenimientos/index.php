<?php
$nmbapp = "Creacion de Mantenimiento";
$moduraiz = $_SESSION['moduraiz'];
$ruta =  "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);
?>

<link rel="stylesheet" href="/cw3/conlabweb3.0/apps/mantenimientos/assets/style.css">


<div class="card" style="width:80%;margin:auto;">

    <div class="card-header bg-light ">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <nav class="breadcrumbs">
                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Creación de Mantenimientos</strong></a>
                </nav>
            </div>
            <div class="col-md-4 col-lg-4 text-center">
                <h5 class="card-title card-title-rezise"><strong>Registrar Mantenimientos</strong></h5>
            </div>
            <div class="col-md-4 col-lg-4">
            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-primary btn-sm" onclick="loadFormCor()" data-toggle="modal" data-target="#modalMant">Registrar Mantenimiento</button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12" id="contentTableMant">

            </div>
        </div>

    </div>


</div>

<!-- Modal Mantenimientos -->
<div class="modal fade" id="modalMant" tabindex="-1" aria-labelledby="modalMantLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMantLabel">Registro de Mantenimientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="textFieldsCor">

            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="textFieldsEdit">

            </div>
        </div>
    </div>
</div>

<!-- Modal Reprogramar -->
<div class="modal fade" id="modalReprogramar" tabindex="-1" aria-labelledby="modalReprogramarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReprogramarLabel">Reprogramar Mantenimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="formEditDatosBasicos" name="formEditDatosBasicos" method="POST" enctype="multipart/form-data">
                <div class="modal-body" id="contentModalRep">

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal add motivo -->
<div class="modal fade" id="modalAddMotivo" tabindex="-1" aria-labelledby="modalAddMotivoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddMotivoLabel">Crear Motivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="formAddMotivo" name="formAddMotivo" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="motivo" id="motivo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="setMotivo()" class="btn btn-success btn-sm">Grabar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Fechas -->
<div class="modal fade" id="modalFechas" tabindex="-1" aria-labelledby="modalFechasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFechasLabel">Próximos mantenimientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentFechasProx">



            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/cw3/conlabweb3.0/apps/mantenimientos/assets/index.js"></script>

<script>
    function loadCalendarProx() {
        $('#contentFechasProx').load('/cw3/conlabweb3.0/apps/mantenimientos/prox-mantenimientos.php');
    }


    function loadFormCor() {
        $('#textFieldsCor').load('/cw3/conlabweb3.0/apps/mantenimientos/maintenance.php');
    }

    $(document).ready(function() {
        $('#contentTableMant').load('/cw3/conlabweb3.0/apps/mantenimientos/table.php');
    })

    function setMotivo() {
        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/mantenimientos/crud.php?aux=1',
            data: $('#formAddMotivo').serialize(),
            success: function(respuesta) {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: '¡Registro Exitoso!',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#loadMotivo').load('/cw3/conlabweb3.0/apps/mantenimientos/load-motivo.php');
            }
        });
    }
</script>