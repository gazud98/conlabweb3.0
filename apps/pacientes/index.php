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


    include('reglasdenavegacion.php');


    // echo $sctrl1;
    $nmbapp = "MÉDICOS";
    $moduraiz = $_SESSION['moduraiz'];
    //echo ".................".$sctrl4."-----------";
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = 0;
    }

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "1"; //esa ctivo fijo
    $id_tipo_identificacion = "";
    $documento = "";
    $nombre_1 = "";
    $nombre_2 = "";
    $apellido_1 = "";
    $apellido_2 = "";
    $id_tipo_genero = "";
    $estado = "";
    $fecha_nacimiento = "";
    $direccion = "";
    $telefono = "";
    $movil = "";
    $ciudad = "";
    $departamento = "";
    $direccion_alterna = "";
    $telefono_alterno = "";
    $fecha_ingreso = "";
    $fecha_retiro = "";
    $email = "";
    $id_sede = "";
    $id_cargos = "";
    $id_departamento = "";
    $detalle_cargo = "";
    $tarjeta_profesional = "";
    $empresa_temporal = "";
    $estado = "1";


    if ($id != "") {
        $cadena = "select P.id_persona,P.id_tipo_identificacion, P.documento, P.nombre_1, P.nombre_2, P.apellido_1, P.apellido_2, P.id_tipo_genero, P.estado,
                    P.fecha_nacimiento,P.direccion, P.telefono, P.movil, P.ciudad, P.direccion_alterna, P.telefono_alterno,
                    PE.fecha_ingreso, PE.fecha_retiro,
                    PE.email, PE.id_sede,PE.id_cargos, PE.detalle_cargo, PE.tarjeta_profesional, PE.empresa_temporal,PE.id_departamento,P.departamento
                from u116753122_cw3completa.persona P,
                    u116753122_cw3completa.persona_empleados PE
                where  P.id_persona=PE.id_persona
                    and P.id_persona='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_persona']);
            $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
            $documento = trim($filaP2['documento']);
            $nombre_1 = trim($filaP2['nombre_1']);
            $nombre_2 = trim($filaP2['nombre_2']);
            $apellido_1 = trim($filaP2['apellido_1']);
            $apellido_2 = trim($filaP2['apellido_2']);
            $id_tipo_genero = trim($filaP2['id_tipo_genero']);
            $estado = trim($filaP2['estado']);
            $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
            $direccion = trim($filaP2['direccion']);
            $telefono = trim($filaP2['telefono']);
            $movil = trim($filaP2['movil']);
            $ciudad = trim($filaP2['ciudad']);
            $departamento = trim($filaP2['departamento']);
            $direccion_alterna = trim($filaP2['direccion_alterna']);
            $telefono_alterno = trim($filaP2['telefono_alterno']);
            $fecha_ingreso = trim($filaP2['fecha_ingreso']);
            $fecha_retiro = trim($filaP2['fecha_retiro']);
            $email = trim($filaP2['email']);
            $id_sede = trim($filaP2['id_sede']);
            $id_departamento = trim($filaP2['id_departamento']);
            $id_cargos = trim($filaP2['id_cargos']);
            $detalle_cargo = trim($filaP2['detalle_cargo']);
            $tarjeta_profesional = trim($filaP2['tarjeta_profesional']);
            $empresa_temporal = trim($filaP2['empresa_temporal']);
        }
    }
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>

    </head>

    <style>
        .table-input tr td{
            padding: 5px;
        }
        .modal-pacientes .modal-content{
            width: 1000px; 
            margin-left:-280px;
        }
        @media only screen and (max-width: 375px) {
            .modal-pacientes .modal-content {
                width: 100%;
                margin-left: 0px;
                margin-bottom: 50px;
            }
        }

        @media only screen and (max-width: 500px) {
            .modal-pacientes .modal-content {
                width: 100%;
                margin-left: 0px;
                margin-bottom: 50px;
            }
        }
    </style>

    <body>

        <div class="content-table">

            <div class="table-wrapper">
                <div class="table-title" style="padding: 30px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <nav class="breadcrumbs">
                                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Pacientes</a>
                                </nav>
                                <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center; padding: 10px">
                            <h4><strong>Creación de Pacientes</strong></h4>
                        </div>
                        <div class="col-md-4">
                            <a href="#addEmployeeModal" class="btn btn-primary" data-toggle="modal" style="background-color: rgb(0,69,165);"><i class="fa-solid fa-plus"></i><span>Nuevo</span></a>
                            <!--<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>-->
                        </div>
                    </div>
                </div>

                <div class="content-table-sedes" style="overflow-x:scroll;">

                </div>

            </div>

        </div>
        <!-- Edit Modal HTML -->
        <div id="addEmployeeModal" class="modal fade modal-pacientes">
            <div class="modal-dialog">
                <div class="modal-content content-create-paciente" style="">
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Paciente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <label style="font-size: 12px;">Tipo Identificacion:</label>
                                        <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion" required>
                                            <option selected="true" disabled="disabled"></option>
                                            <?php
                                            $cadena = "SELECT id, nombre
                                                                FROM u116753122_cw3completa.tipo_identificacion
                                                                where estado='1'";
                                            $resultadP2a = $conetar->query($cadena);
                                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                                            if ($numerfiles2a >= 1) {
                                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                                    echo "<option value='" . trim($filaP2a['id']) . "'";
                                                    if (trim($filaP2a['id']) == $id_tipo_identificacion) {
                                                        echo ' selected';
                                                    }
                                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div id="id_tipo_identificacionx"></div>
                                </div>
                                
                                <div class="col-md-2">
                                    <label style="font-size: 12px;">No. Identificación:</label>
                                        <input type="text" class="form-control" name="numero_ide" id="numero_ide" required>
                                </div>
                                
                            </div>
                            
                            <div class="row mt-2">
                                
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Primer Nombre:</label>
                                    <input type="text" class="form-control" name="nombre_1" id="nombre_1" required>
                                </div>
                                
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Segundo Nombre:</label>
                                    <input type="text" class="form-control" name="nombre_2" id="nombre_2">
                                </div>
                                
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Primer Apellido:</label>
                                    <input type="text" class="form-control" name="apellido_1" id="apellido_1" required>
                                </div>
                                
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Segundo Apellido:</label>
                                    <input type="text" class="form-control" name="apellido_2" id="apellido_2">
                                </div>
                                
                            </div>
                            
                            <div class="row mt-2">
                                
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Sexo:</label>
                                        <select class="form-control" name="id_tipo_genero" id="id_tipo_genero" required>
                                            <option selected="true" disabled="disabled"></option>
                                            <option value="1" <?php if ($id_tipo_genero == "1") {
                                                                    echo " selected";
                                                                } ?>>Masculino</option>
                                            <option value="2" <?php if ($id_tipo_genero == "2") {
                                                                    echo " selected";
                                                                } ?>>Femenino</option>
                                        </select>
                                        <div id="id_tipo_generox"></div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Fecha de Nacimiento:</label>
                                        <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" required></input>
                                        <div id="fecha_nacimientox"></div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Telefono Fijo:</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></input>
                                        <div id="telefonox"></div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Celular:</label>
                                        <input type="text" class="form-control" name="movil" id="movil" value="<?php echo $movil; ?>" required></input>
                                        <div id="movilx"></div>
                                </div>
                                
                            </div>

                            <div style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-top:20px; margin-bottom:10px; font-size:13px;">
                                <strong>Dirección:</strong>
                            </div>
                            
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Direccion:</label>
                                        <!--<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"></input>-->
                                        <textarea class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>" cols="30" rows="1" required></textarea>
                                        <div id="direccionx"></div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" style="font-size: 12px;">Ciudad:</label>
                                    <select class="form-control" name="ciudad" id="ciudad" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <?php
                                            $cadena33 = "SELECT id, nombre FROM u116753122_cw3completa.ciudades";
                                            $resultadP2a33 = $conetar->query($cadena33);
                                            if ($resultadP2a33->num_rows > 0) {
                                                while ($row = $resultadP2a33->fetch_assoc()) {
                                                    $value = $row['id'];
                                                    $ciudad_nombre = $row['nombre'];
                                                    $selected = ($ciudad == $value) ? 'selected' : '';
                                                    echo "<option value='$value' $selected>$ciudad_nombre</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="" style="font-size: 12px;">Departamento:</label>
                                    <select class="form-control" name="dep" id="dep" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <?php
                                            $cadena33 = "SELECT id, nombre FROM u116753122_cw3completa.departamento";
                                            $resultadP2a33 = $conetar->query($cadena33);
                        
                                            if ($resultadP2a33->num_rows > 0) {
                                                while ($row = $resultadP2a33->fetch_assoc()) {
                                                    $value = $row['id'];
                                                    $dep_nombre = $row['nombre'];
                                                    $selected = ($id_departamento == $value) ? 'selected' : '';
                                                    echo "<option value='$value' $selected>$dep_nombre</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

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
        <!-- Edit Modal HTML -->
        <div id="editsedeModal" class="modal fade modal-pacientes">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form id="formeditar" action="#" method="POST">
                        <div class="modal-body cargar-campos">
                            
                            
                            
                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-success" value="Aceptar">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("apps/thedata.php") ?>

        <script>
            $(document).ready(function() {


                $('.content-table-sedes').load('/cw3/conlabweb3.0/apps/pacientes/thedatatable.php');
                

            })
        </script>

    </body>

    </html>

<?php
}
?>