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

//echo $id_users;
//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {



    // echo $sctrl1;
    $nmbapp = "Roles";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta = "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.roles where 1=1";

    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = 0;
    }

    $id_modulos = "";


    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>

    </head>

    <body>

        <div class="content-table" style="width:95%;margin:auto;">

            <div class="table-wrapper" style="padding:50px;">
                <div class="table-title" style="padding: 30px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <nav class="breadcrumbs">
                                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;">
                                        <?php echo $moduraiz; ?>
                                    </a>
                                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong>
                                            <?php echo $nmbapp; ?>
                                        </strong></a>
                                </nav>
                                <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center; padding: 10px">
                            <h4><strong>Creación de Roles</strong></h4>
                        </div>
                        <div class="col-md-4">
                            <a href="#addModal" class="btn btn-primary" data-toggle="modal"
                                style="background-color: rgb(0,69,165);"><i
                                    class="fa-solid fa-plus"></i><span>Nuevo</span></a>
                            <!--<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>-->
                        </div>
                    </div>
                </div>

                <div class="content-table-roles" style="overflow:hidden;  margin-bottom:5px; border-bottom:thin none #d3d3d3;
                                           height:auto;width:100%;">

                </div>

            </div>

        </div>
        <!-- Edit Modal HTML -->
        <div id="addModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Roles</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group" style="display: none;">
                                <label>Código</label>
                                <input type="input" class="form-control" style="border:thin solid transparent; " readonly=""
                                    name="id" id="id" value="">
                            </div>
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" required>
                            </div>
                            <div class="form-group" style="height: 200px; overflow-y: auto;">
                                <label>Módulos:</label><br>
                                <?php
                                $cadena33 = "SELECT id_modulos, name FROM u116753122_cw3completa.modulos where estado =1";
                                $resultadP2a33 = $conetar->query($cadena33);
                                $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                                $idsGuardados = explode(',', $id_modulos);
                                if ($numerfiles2a33 >= 1) {
                                    while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                        $id_modulos = trim($filaP2a33['id_modulos']);
                                        $name = $filaP2a33['name'];

                                        $checked = in_array($id_modulos, $idsGuardados) ? 'checked' : '';
                                        ?>
                                        <div class="form-check" >
                                            <input type="checkbox" style="font-size: 12px;" class="form-check-input"
                                                name="regimen[]" value="<?= $id_modulos ?>" id="checkreg<?= $id_modulos ?>"
                                                <?= $checked ?>>
                                            <label style="font-size: 12px;" class="form-check-label"
                                                for="checkreg<?= $id_modulos ?>">
                                                <?= $name ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <input type="hidden" name="idmodulo" id="idmodulo" value="">
                            <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">
                            <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-success" value="Aceptar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("apps/thedata.php") ?>
        <!-- Edit Modal HTML -->
        <div id="editModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formeditar" action="#" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Roles</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body" id="modalshow">

                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                        <div class="modal-footer">
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-success" value="Aceptar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script> $(document).ready(function () {

                var opcionesSeleccionadas = [];

                // Escucha el evento change de los checkboxes
                $('input[type="checkbox"]').change(function () {
                    opcionesSeleccionadas = [];

                    // Recorre los checkboxes marcados y agrega sus valores al array
                    $('input[type="checkbox"]:checked').each(function () {
                        opcionesSeleccionadas.push($(this).val());
                    });

                    // Puedes usar el array opcionesSeleccionadas según tus necesidades
                    $('#idmodulo').val(opcionesSeleccionadas);

                });




            });
            $(document).ready(function () {


                $('.content-table-roles').load('https://cw3.tierramontemariana.org/apps/roles/thedatatable.php');



            })
        </script>

    </body>

    </html>

    <?php
}
?>