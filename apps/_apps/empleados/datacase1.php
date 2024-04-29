<?php
//si hay consulta
//     presntadio n par todos los departamento

if( file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
}else{
    if( file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    }else{
        if( file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}

// echo __FILE__.'>dd.....<br>';

 //echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
 $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
 if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
 }else{


 include('reglasdenavegacion.php');

 //echo '..............................'.$_REQUEST['id'].'...';

 if(isset($_REQUEST['id']))  {
        $id=$_REQUEST['id'];
    if($id=="-1"){ $id=""; }
  }else{ $id=""; }

    //$id=1;
//    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto="1";//esa ctivo fijo
        $id_tipo_identificacion="";
        $documento="";
        $nombre_1="";
        $nombre_2="";
        $apellido_1="";
        $apellido_2="";
        $id_tipo_genero="";
        $estado="";
        $fecha_nacimiento="";
        $direccion="";
        $telefono="";
        $movil="";
        $ciudad="";
        $direccion_alterna="";
        $telefono_alterno="";
        $fecha_ingreso="";
        $fecha_retiro="";
        $email_empresarial="";
        $id_sede="";
        $id_cargos="";
        $detalle_cargo="";
        $tarjeta_profesional="";
        $empresa_temporal="";
        $estado="1";


    if($id!=""){
        $cadena="select P.id_persona,P.id_tipo_identificacion, P.documento, P.nombre_1, P.nombre_2, P.apellido_1, P.apellido_2, P.id_tipo_genero, P.estado,
                    P.fecha_nacimiento,P.direccion, P.telefono, P.movil, P.ciudad, P.direccion_alterna, P.telefono_alterno,
                    PE.fecha_ingreso, PE.fecha_retiro,
                    PE.email_empresarial, PE.id_sede,id_cargos, PE.detalle_cargo, PE.tarjeta_profesional, PE.empresa_temporal
                from u116753122_cw3completa.persona P,
                    u116753122_cw3completa.persona_empleados PE
                where  P.id_persona=PE.id_persona
                    and P.id_persona='".$id."'";
//                     echo $cadena;
        $resultadP2=$conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if($numerfiles2>=1){
            $filaP2=mysqli_fetch_array($resultadP2);
            $id=trim($filaP2['id_persona']);
                $id_tipo_identificacion=trim($filaP2['id_tipo_identificacion']);
                $documento=trim($filaP2['documento']);
                $nombre_1=trim($filaP2['nombre_1']);
                $nombre_2=trim($filaP2['nombre_2']);
                $apellido_1=trim($filaP2['apellido_1']);
                $apellido_2=trim($filaP2['apellido_2']);
                $id_tipo_genero=trim($filaP2['id_tipo_genero']);
                $estado=trim($filaP2['estado']);
                $fecha_nacimiento=trim($filaP2['fecha_nacimiento']);
                $direccion=trim($filaP2['direccion']);
                $telefono=trim($filaP2['telefono']);
                $movil=trim($filaP2['movil']);
                $ciudad=trim($filaP2['ciudad']);
                $direccion_alterna=trim($filaP2['direccion_alterna']);
                $telefono_alterno=trim($filaP2['telefono_alterno']);
                $fecha_ingreso=trim($filaP2['fecha_ingreso']);
                $fecha_retiro=trim($filaP2['fecha_retiro']);
                $email_empresarial=trim($filaP2['email_empresarial']);
                $id_sede=trim($filaP2['id_sede']);
                $id_cargos=trim($filaP2['id_cargos']);
                $detalle_cargo=trim($filaP2['detalle_cargo']);
                $tarjeta_profesional=trim($filaP2['tarjeta_profesional']);
                $empresa_temporal=trim($filaP2['empresa_temporal']);
        }
    }

?>

            <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
                 <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
                 <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


                            <div class="row mb-2">

                                        <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Codigo:</label>
                                                <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                                                <?php if($estado=='0'){ echo "<span style='color:red;'> Inhabilitado</span>"; } ?>
                                        </div>

                                        <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Tipo Identificacion:</label>
                                                <select  class="form-control"  name="id_tipo_identificacion" id="id_tipo_identificacion">
                                                    <option value="1" <?php if($id_tipo_identificacion=="1"){ echo " selected"; } ?>>Nit</option>
                                                    <option  value="2" <?php if($id_tipo_identificacion=="2"){ echo " selected"; } ?>>Nuip</option>
                                                    <option  value="3" <?php if($id_tipo_identificacion=="3"){ echo " selected"; } ?>>Tarjeta de Identidad</option>
                                                    <option  value="4" <?php if($id_tipo_identificacion=="4"){ echo " selected"; } ?>>Cedula de Ciudadania</option>
                                                    <option  value="5" <?php if($id_tipo_identificacion=="5"){ echo " selected"; } ?>>Cedula de Extranjeria</option>
                                                </select>
                                        </div>

                                        <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Numero:</label>
                                                <input type="input" class="form-control"  name="documento" id="documento" value="<?php echo $documento; ?>"></input>
                                        </div>
                            </div>

                            <div class="row mb-2">

                                        <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Primer Nombre:</label>
                                                <input type="input" class="form-control" name="nombre_1" id="nombre_1" value="<?php echo $nombre_1; ?>"></input>
                                        </div>

                                        <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Segundo Nombre:</label>
                                                <input type="input" class="form-control" name="nombre_2" id="nombre_2" value="<?php echo $nombre_2; ?>"></input>
                                        </div>

                                        <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Primer Apellido:</label>
                                                <input type="input" class="form-control" name="apellido_1" id="apellido_1" value="<?php echo $apellido_1; ?>"></input>
                                        </div>

                                        <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Segundo Apellido:</label>
                                                <input type="input" class="form-control" name="apellido_2" id="apellido_2" value="<?php echo $apellido_2; ?>"></input>
                                        </div>
                            </div>
                                <hr>

                            <div class="row mb-2">
                                        <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Sexo:</label>
                                                <select  class="form-control"  name="id_tipo_genero" id="id_tipo_genero">
                                                    <option value="1" <?php if($id_tipo_genero=="1"){ echo " selected"; } ?>>Masculino</option>
                                                    <option  value="2" <?php if($id_tipo_genero=="2"){ echo " selected"; } ?>>Femenino</option>
                                                </select>
                                        </div>

                                        <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Fecha de Nacimiento:</label>
                                                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>"></input>
                                        </div>
                            </div>
                            <hr>

                            <div class="row mb-2">
                                <div class="col-md-12 col-lg-12 ">
                                                <label style="font-size: 12px;">Direccion:</label>
                                                <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"></input>
                                                <input type="text" class="form-control" name="direccion_alterna" id="direccion_alterna" value="<?php echo $direccion_alterna; ?>"></input>
                                        </div>
                                <div class="col-md-12 col-lg-12 ">
                                                <label style="font-size: 12px;">Ciudad:</label>
                                                <input type="text" class="form-control" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>"></input>
                                        </div>

                                <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Telefono 1:</label>
                                                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></input>
                                        </div>

                                <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Telefono 2:</label>
                                                <input type="text" class="form-control" name="telefono_alterno" id="telefono_alterno" value="<?php echo $telefono_alterno; ?>"></input>
                                        </div>

                                <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Movil:</label>
                                                <input type="text" class="form-control" name="movil" id="movil" value="<?php echo $movil; ?>"></input>
                                        </div>

                            </div>
                            <hr>

                            <div class="row mb-2">
                                <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Fecha de Ingreso:</label>
                                                <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>"></input>
                                        </div>

                                <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Fecha de Retiro:</label>
                                                <input type="date" class="form-control" name="fecha_retiro" id="fecha_retiro" value="<?php echo $fecha_retiro; ?>"></input>
                                        </div>

                                <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Tarjeta Profesional:</label>
                                                <input type="text" class="form-control" name="tarjeta_profesional" id="tarjeta_profesional" value="<?php echo $tarjeta_profesional; ?>"></input>
                                        </div>

                                <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">email Empresarial:</label>
                                                <input type="email" class="form-control" name="email_empresarial" id="email_empresarial" value="<?php echo $email_empresarial; ?>"></input>
                                        </div>

                            </div>
                            <hr>

                             <div class="row mb-2">
                                <div class="col-md-12 col-lg-12 ">
                                                <label style="font-size: 12px;">Sede:</label>
                                                <select class="form-control" name="id_sede" id="id_sede">
                                                <?php
                                                    $cadena="SELECT id_sedes, nombre
                                                                FROM u116753122_cw3completa.sedes
                                                                where estado='1'";
                                                    $resultadP2a=$conetar->query($cadena);
                                                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                                                    if($numerfiles2a>=1){
                                                        while( $filaP2a=mysqli_fetch_array($resultadP2a)){
                                                            echo "<option value='".trim($filaP2a['id_sedes'])."'";
                                                                if(trim($filaP2a['id_sedes'])==$id_sede){ echo ' selected'; }
                                                            echo '>'.$filaP2a['nombre']."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                        </div>

                                <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Cargos:</label>
                                                <select class="form-control" name="id_cargos" id="id_cargos">
                                                <?php
                                                    $cadena="SELECT id, nombre
                                                                FROM u116753122_cw3completa.cargos
                                                                where estado='1'";
                                                    $resultadP2a=$conetar->query($cadena);
                                                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                                                    if($numerfiles2a>=1){
                                                        while( $filaP2a=mysqli_fetch_array($resultadP2a)){
                                                            echo "<option value='".trim($filaP2a['id'])."'";
                                                                if(trim($filaP2a['id'])==$id_cargos){ echo ' selected'; }
                                                            echo '>'.$filaP2a['nombre']."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                        </div>

                                <div class="col-md-12 col-lg-12 ">
                                                <label style="font-size: 12px;">Descripcion de Cargo:</label>
                                                <input type="text" class="form-control" name="detalle_cargo" id="detalle_cargo" value="<?php echo $detalle_cargo; ?>"></input>
                                        </div>

                                <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Empresa Temporal:</label>
                                                <input type="text" class="form-control" name="empresa_temporal" id="empresa_temporal" value="<?php echo $empresa_temporal; ?>"></input>
                                        </div>

                            </div>







            </form>


<?php
 }
 ?>
