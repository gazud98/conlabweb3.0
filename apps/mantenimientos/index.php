<?php

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

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    include('reglasdenavegacion.php');

    $nmbapp = "MANTENIMIENTOS";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);

    $cadena = "SELECT count(*) as cantidad
                    FROM correctivo P" .
        $filterfrom .
        " where  1=1";
    $cadena = $cadena . $filterwhere;

    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];;
?>

    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/mantenimientos/assets/style.css">

    <style>
        #thetable::-webkit-scrollbar {
            width: 1px;
        }
    </style>
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
                    <h5 style="text-align: center; color: #0045A5;"><strong>Creación de Mantenimientos</strong></h5>
                </div>
                <div class="col-md-4 col-lg-4">
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-primary btn-sm" onclick="loadFormPrev()" data-toggle="modal" data-target="#modalPreventivo">Crear Mant. Preventivo</button>
                    <button class="btn btn-primary btn-sm" onclick="loadFormCor()" data-toggle="modal" data-target="#modalCorrectivo">Crear Mant. Correctivo</button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12" id="contentTableMant">

                </div>
            </div>

        </div>


    </div>

    <!-- Modal Preventivo -->
    <div class="modal fade" id="modalPreventivo" tabindex="-1" aria-labelledby="modalPreventivoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPreventivoLabel">Mantenimiento Preventivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="formPreventivo" id="formPreventivo" action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body" id="textFieldsPrev">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Grabar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Correctivo -->
    <div class="modal fade" id="modalCorrectivo" tabindex="-1" aria-labelledby="modalCorrectivoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCorrectivoLabel">Mantenimiento Correctivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="formCorrectivo" id="formCorrectivo" action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body" id="textFieldsCor">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Grabar</button>
                    </div>
                </form>
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
                <strong class="text-center p-2"><span class="p-2" id="titleEdit"></span></strong>
                <div class="modal-body" id="textFieldsEdit">

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function loadFormPrev() {
            $('#textFieldsPrev').load('/cw3/conlabweb3.0/apps/mantenimientos/preventivo.php');
        }

        function loadFormCor() {
            $('#textFieldsCor').load('/cw3/conlabweb3.0/apps/mantenimientos/correctivo.php');
        }

        $(document).ready(function() {
            $('#contentTableMant').load('/cw3/conlabweb3.0/apps/mantenimientos/table.php');
        })

        function habilitacmpos() {
            $("#iddatas").css("pointer-events", "auto");
            $("#iddatas").css("background-color", "white");
        }

        function inhabilitacmpos() {
            $("#iddatas").css("pointer-events", "none");
            $("#iddatas").css("background-color", "#ededed");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }


        function accionesespecificas(caso) {
            if (caso == "X") { //cancelar....
                $("#divproveedoresproducto").css("display", "block");
            }
            if (caso == "A") { //aceptar...
                $("#divproveedoresproducto").css("display", "block");
            }
            if (caso == "C") { //de crer
                //desaparece la creacion de proveedores, solo sale en los demas casos
                $("#divproveedoresproducto").css("display", "none");
            } //De crear
            if (caso == "E") {
                $("#divproveedoresproducto").css("display", "block");
            } //Editar
            if (caso == "D") {
                $("#divproveedoresproducto").css("display", "block");
            } //Es de habolita / inhablitar
        } //funcikjnes que hacen casos epeciales en

        function cancelNew() {
            inhabilitacmpos(); //inhabilita camnoos
            $("#newbtn").css("display", "block");
            $("#modbtn").css("display", "none");
            $("#delbtn").css("display", "none");
            $("#successbtn").css("display", "none");
            $("#cancelbtn").css("display", "none");
            $("#casoesperado").load('/cw3/conlabweb3.0/apps/mantenimientos/datacase1.php')
        }
    </script>
<?php
}
?>