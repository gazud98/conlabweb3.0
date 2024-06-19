<?php


// echo __FILE__.'>dd.....<br>';
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

$id_users = $_SESSION['id_users'];

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $moduraiz = $_SESSION['moduraiz'];

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/empresas/assets/style.css">

    </head>

    <style>
        .content-wrapper {
            background-image: url('/cw3/conlabweb3.0/apps/medicos/assets/backcw3-v1.png');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .card-title-rezise {
            width: 100%;
            color: #164085;
            text-align: center;
            position: relative;
            margin-top: 9px;
        }

        .btn-info-2 {
            color: #fff;
            background-color: #D3619F;
            border-color: #D3619F;
            box-shadow: none;
        }

        .btn-info-2:hover {
            color: #fff;
            background-color: #CA5193;
            border-color: #CA5193;
        }

        .btn-info-2:focus,
        .btn-info-2.focus {
            color: #fff;
            background-color: #CA5193;
            border-color: #CA5193;
            box-shadow: 0 0 0 0 rgba(58, 176, 195, 0.5);
        }
    </style>

    <body>

        <div class="content-all">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <nav class="breadcrumbs">
                                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Empresas</a>

                                </nav>
                                <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h5 class="card-title card-title-rezise"><strong>Creación de empresas</strong></h5>
                        </div>
                        <div class="col-md-4 text-right">
                            <div class="btn-group" role="group" aria-label="Basic example" style="margin-top:3px;">
                                <button title="Refresacar tabla" type="button" class="btn btn-outline-primary btn-sm" id="btnRefresh"><i class="fa-solid fa-rotate-right"></i> Refrescar Tabla</button>
                                <button title="Crear nueva empresa" type="button" class="btn btn-outline-primary btn-sm" onclick="loadAddEmpresa()" class="btn btn-primary" data-toggle="modal" data-target="#modalAddEmpresa">
                                    <i class="fa-solid fa-plus"></i>&nbsp;Nueva Empresa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="content-table-empresa">

                    </div>

                </div>
                <div class="card-footer">
                    <h5 style="color: #008E16;" id="titleInfo">Debe escoger una empresa para activar estas opciones. <i class="fa-solid fa-arrow-down"></i></h5>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button id="btnLoadModals-1" class="btn btn-warning btn-sm" disabled="true" data-toggle="modal" data-target="#modalPlan" onclick="loadPlanesAdd()">Crear Plan</button>
                        <button id="btnLoadModals-2" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalInfoFact" onclick="loadInfoFactAdd()" disabled>Ver info. facturación</button>
                        <button id="btnLoadModals-3" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalInfoCartera" onclick="loadAddInfoCartera()" disabled>Ver info. Cartera</button>
                        <button id="btnLoadModals-4" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalInfoTributaria" onclick="loadAddInfoTributaria()" disabled>Ver info. Tributaria</button>
                    </div>
                    <!--<button id="btnLoadModals-3" class="btn btn-success btn-sm" disabled>Ver planes</button>-->
                </div>
            </div>
        </div>

        <!-- Modal información de facturación -->
        <div class="modal fade" id="modalInfoFact" tabindex="-1" aria-labelledby="modalInfoFactLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-xl">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInfoFactLabel"><strong>Información de Facturación</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-modal-info-fact mt-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Crear Plan -->
        <div class="modal fade" id="modalPlan" tabindex="-1" aria-labelledby="modalPlanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPlanLabel">Crear Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
                            Empresa: <span id="title-empresa"></span></h5>
                        </div>
                        <br>
                        <form action="" id="formCrearPlan" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="idEmpresaReq" name="idEmpresaReq" value="">
                            <div class="content-add-plan">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal crear empresa -->
        <div class="modal fade" id="modalAddEmpresa" tabindex="-1" aria-labelledby="modalAddEmpresaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddEmpresaLabel">Crear Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-add-empresa mt-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal view planes -->
        <div class="modal fade" id="modalViewPlanes" tabindex="-1" aria-labelledby="modalViewPlanesLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalViewPlanesLabel">Ver planes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-table-planes">

                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit planes -->
        <div class="modal fade" id="modalEditPlan" tabindex="-1" aria-labelledby="modalEditPlanesLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditPlanesLabel">Editar Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-modal-planes">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Empresa -->
        <div class="modal fade" id="modalEditEmpresa" tabindex="-1" aria-labelledby="modalEditEmpresaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalViewPlanesLabel">Editar empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-edit-empresa">


                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Info Cartera -->
        <div class="modal fade" id="modalInfoCartera" tabindex="-1" aria-labelledby="modalEditEmpresaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-lg">
                    <div class="modal-header">
                        <h5 class="modal-title">Información de Cartera</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="content-info-cartera mt-4">

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Info Tributaria -->
        <div class="modal fade" id="modalInfoTributaria" tabindex="-1" aria-labelledby="modalInfoTributariaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-md">
                    <div class="modal-header">
                        <h5 class="modal-title">Información Tributaria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-info-tributaria mt-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
        <script src="/cw3/conlabweb3.0/apps/empresas/assets/index.js"></script>

        <script>
            function loadInfoFactAdd() {
                //confirmRadioSelected()
                var radios = document.getElementsByName('selectempresa');
                var valor_seleccionado2 = null;

                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].checked) {
                        valor_seleccionado2 = radios[i].value;
                        break;
                    }
                }

                $('.content-modal-info-fact').load('/cw3/conlabweb3.0/apps/empresas/info-facturacion.php', {
                    id: valor_seleccionado2
                })

                $('#title-empresa-2').html($('#nombreEmpresa').val());
            }

            function loadPlanesAdd() {
                confirmRadioSelected()
                $('#idEmpresaReq').val($('#idempresa').val());
                $('#title-empresa').html($('#nombreEmpresa').val());
                $('.content-add-plan').load('/cw3/conlabweb3.0/apps/empresas/modal-planes.php')
                console.log($('#nombreEmpresa').val())
            }

            function loadAddEmpresa() {
                $('.content-add-empresa').load('/cw3/conlabweb3.0/apps/empresas/modal-add-empresa.php')
            }

            function loadAddInfoCartera() {

                var radios = document.getElementsByName('selectempresa');
                var valor_seleccionado2 = null;

                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].checked) {
                        valor_seleccionado2 = radios[i].value;
                        break;
                    }
                }

                $('.content-info-cartera').load('/cw3/conlabweb3.0/apps/empresas/info-cartera.php', {
                    id: valor_seleccionado2
                })

                $('#title-empresa-3').html($('#nombreEmpresa').val());
            }

            function loadAddInfoTributaria() {

                var radios = document.getElementsByName('selectempresa');
                var valor_seleccionado2 = null;

                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].checked) {
                        valor_seleccionado2 = radios[i].value;
                        break;
                    }
                }

                $('.content-info-tributaria').load('/cw3/conlabweb3.0/apps/empresas/info-tributaria.php', {
                    id: valor_seleccionado2
                })

                $('#title-empresa-5').html($('#nombreEmpresa').val());
            }

            function activeButtons() {
                $('#btnLoadModals-1').prop('disabled', false);
                $('#btnLoadModals-2').prop('disabled', false);
                $('#btnLoadModals-3').prop('disabled', false);
                $('#btnLoadModals-4').prop('disabled', false);
                $('#titleInfo').css('display', 'none');
            }

            function loadModalPlanes(id) {
                $('.content-modal-planes').load('/cw3/conlabweb3.0/apps/empresas/modal-edit-planes.php', {
                    id: id
                })
            }
        </script>

    </body>

    </html>

<?php
}
?>