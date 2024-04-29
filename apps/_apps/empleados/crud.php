<?php
  $result="err";
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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


    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $modeeditstatus=$_REQUEST['modeeditstatus'];
    $id=$_REQUEST['id'];

    if($modeeditstatus=="D"){//es de desahibilitar/habikitr
//          si estadio es 1 pasa ra 0 o v iceversa
        $cadena="select estado from u116753122_cw3completa.persona where id_persona='".$id."'";
        $resultadP2a=$conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if($numerfiles2a>=1){
            $filaP2a=mysqli_fetch_array($resultadP2a);
            $estado=trim($filaP2a['estado']);
        }else{ $estado='1'; }
        if($estado=='1'){ $estado='0'; }else{ $estado='1'; }
        $cadena= "update u116753122_cw3completa.persona set estado='".$estado."' where id_persona='".$id."'";
        $resultado = mysqli_query($conetar,$cadena);
        $result="ok";
    }else{//es crea o moifica

         $id_tipo_identificacion=trim($_POST['id_tipo_identificacion']);
                $documento=trim($_POST['documento']);
                $nombre_1=trim($_POST['nombre_1']);
                $nombre_2=trim($_POST['nombre_2']);
                $apellido_1=trim($_POST['apellido_1']);
                $apellido_2=trim($_POST['apellido_2']);
                $id_tipo_genero=trim($_POST['id_tipo_genero']);
                $estado=trim($_POST['estado']);
                $fecha_nacimiento=trim($_POST['fecha_nacimiento']);
                $direccion=trim($_POST['direccion']);
                $telefono=trim($_POST['telefono']);
                $movil=trim($_POST['movil']);
                $ciudad=trim($_POST['ciudad']);
                $direccion_alterna=trim($_POST['direccion_alterna']);
                $telefono_alterno=trim($_POST['telefono_alterno']);
                $fecha_ingreso=trim($_POST['fecha_ingreso']);
                $fecha_retiro=trim($_POST['fecha_retiro']);
                $email_empresarial=trim($_POST['email_empresarial']);
                $id_sede=trim($_POST['id_sede']);
                $id_cargos=trim($_POST['id_cargos']);
                $detalle_cargo=trim($_POST['detalle_cargo']);
                $tarjeta_profesional=trim($_POST['tarjeta_profesional']);
                $empresa_temporal=trim($_POST['empresa_temporal']);



            if($modeeditstatus=="C"){////CREACION
                $cadena="insert into u116753122_cw3completa.persona(
                             id_tipo_identificacion, documento,
                             nombre_1, nombre_2, apellido_1, apellido_2,
                             id_tipo_genero, fecha_nacimiento, direccion, telefono,
                             movil, ciudad, direccion_alterna, telefono_alterno, estado
                            )values('".
                            $id_tipo_identificacion."','".$documento."','".
                            $nombre_1."','".$nombre_2."','".$apellido_1."','". $apellido_2."','".
                            $id_tipo_genero."','".$fecha_nacimiento."','".$direccion."','".$telefono."','".
                            $movil."','".$ciudad."','".$direccion_alterna."','".$telefono_alterno."','1')";
                $resultado = mysqli_query($conetar,$cadena);
                $cadena="select id_persona
                            from u116753122_cw3completa.persona
                            where id_tipo_identificacion='".$id_tipo_identificacion."'
                                and documento='".$documento."'
                                and nombre_1='".$nombre_1."'
                                and nombre_2='".$nombre_2."'
                                and apellido_1='".$apellido_1."'
                                and apellido_2='".$apellido_2."'";
                $resultadP2=$conetar->query($cadena);
                $numerfiles2 = mysqli_num_rows($resultadP2);
                if($numerfiles2>=1){
                    $filaP2=mysqli_fetch_array($resultadP2);
                    $id=trim($filaP2['id_persona']);
                }
                $cadena="insert into u116753122_cw3completa.persona_empleados(
                            id_persona,fecha_ingreso, fecha_retiro, email_empresarial,
                            id_sede, id_cargos, detalle_cargo, tarjeta_profesional, empresa_temporal
                        )values('".$id."','".$fecha_ingreso."','".$fecha_retiro."','".$email_empresarial."','".
                            $id_sede."','".$id_cargos."','".$detalle_cargo."','".$tarjeta_profesional."','".$empresa_temporal."')";
                $resultado = mysqli_query($conetar,$cadena);
                $result="ok";
            }else{
                if($modeeditstatus=="E"){//acgualzucsion
                    $cadena="UPDATE u116753122_cw3completa.persona SET
                                id_tipo_identificacion = '".$id_tipo_identificacion."',
                                documento = '".$documento."',
                                nombre_1 = '".$nombre_1."',
                                nombre_2 = '".$nombre_2."',
                                apellido_1 = '".$apellido_1."',
                                apellido_2 = '".$apellido_2."',
                                id_tipo_genero = '".$id_tipo_genero."',
                                fecha_nacimiento = '".$fecha_nacimiento."',
                                direccion = '".$direccion."',
                                telefono = '".$telefono."',
                                movil = '".$movil."',
                                ciudad = '".$ciudad."',
                                direccion_alterna = '".$direccion_alterna."',
                                telefono_alterno = '".$telefono_alterno."'
                            WHERE id_persona = '".$id."'";
                    $resultado = mysqli_query($conetar,$cadena);

                    $cadena="UPDATE persona_empleados SET
                            fecha_ingreso = '".$fecha_ingreso."',
                            fecha_retiro = '".$fecha_retiro."',
                            email_empresarial = '".$email_empresarial."',
                            id_sede = '".$id_sede."',
                            id_cargos = '".$id_cargos."',
                            detalle_cargo = '".$detalle_cargo."',
                            tarjeta_profesional = '".$tarjeta_profesional."',
                            empresa_temporal = '".$empresa_temporal."'
                        WHERE id_persona = '".$id."'";

                        echo $cadena;
                    $resultado = mysqli_query($conetar,$cadena);

                     $result="ok";
                }//es acgtaliadar
            }//De es insetar
    }//es de desahibilitar
}//de hay cneion e bbd

?>
