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
        $cadena="select estado from u116753122_cw3completa.estuches where id='".$id."'";
        $resultadP2a=$conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if($numerfiles2a>=1){
            $filaP2a=mysqli_fetch_array($resultadP2a);
            $estado=trim($filaP2a['estado']);
        }else{ $estado='1'; }
        if($estado=='1'){ $estado='0'; }else{ $estado='1'; }
        $cadena= "update u116753122_cw3completa.estuches set estado='".$estado."' where id='".$id."'";
        $resultado = mysqli_query($conetar,$cadena);
        $result="ok";
    }else{//es crea o moifica

       
        $id_reactivo==trim($_POST['id_reactivo']); 
        $reactivo=trim($_POST['reactivo']);
        $descripcion=trim($_POST['descripcion']);
        $instrumento=trim($_POST['instrumento']); 
        $fecha_apertura=trim($_POST['fecha_apertura']); 
        $fecha_expiracion=trim($_POST['fecha_expiracion']); 
        $presentacion=trim($_POST['presentacion']); 
        $no_lote=trim($_POST['no_lote']); 
        $fabricante=trim($_POST['fabricante']); 
        $referencia_fabricante=trim($_POST['referencia_fabricante']); 
        $pruebas_nominales=trim($_POST['pruebas_nominales']); 
        $valor_reactivo=trim($_POST['valor_reactivo']);
        $usuario=trim($_POST['usuario']);
        $estado=trim($_POST['estado']);




            if($modeeditstatus=="C"){////CREACIO
                $cadena="insert into u116753122_cw3completa.estuches( id_reactivo, reactivo, descripcion, instrumento, fecha_apertura, fecha_expiracion, presentacion, no_lote, fabricante, referencia_fabricante, pruebas_nominales,valor_reactivo, usuario, estado)values('".
                        $id_reactivo.
                        "','".$reactivo.
                        "','".$descripcion.
                        "','".$instrumento.
                        "','".$fecha_apertura.
                        "','".$fecha_expiracion.
                        "','".$presentacion.
                        "','".$no_lote.
                        "','".$fabricante.
                        "','".$referencia_fabricante.
                        "','".$pruebas_nominales.
                        "','".$valor_reactivo.
                        "','".$usuario.
                        "','1')";
                $resultado = mysqli_query($conetar,$cadena);

                //bujscamos el id para el proce sde predetemando...
                $cadena="select id from  u116753122_cw3completa.estuches where
                            id_reactivo='".$id_reactivo."'
                            and reactivo='".$reactivo."'
                            and instrumento='".$instrumento."'
                            and usuario='".$usuario."'";
                $resultadP2a=$conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if($numerfiles2a>=1){
                    $filaP2a=mysqli_fetch_array($resultadP2a);
                    $id=$filaP2a['id'];
                }
                $result="ok";
            }else{
                if($modeeditstatus=="E"){//acgualzucsion
                      $cadena="update u116753122_cw3completa.estuches set
                               id_reactivo='".$id_reactivo."',
                               reactivo='".$reactivo."',
                               descripcion='".$descripcion."',
                               instrumento='".$instrumento."',
                               fecha_apertura='".$fecha_apertura."',
                               fecha_apertura='".$fecha_expiracion."',
                               presentacion='".$presentacion."',
                               no_lote='".$no_lote."',
                               fabricante='".$fabricante."',
                               referencia_fabricante='".$referencia_fabricante."',
                               pruebas_nominales='".$pruebas_nominales."',
                               valor_reactivo='".$valor_reactivo."',
                               usuario='".$usuario."'
                            where id='".$id."'";
                    $resultado = mysqli_query($conetar,$cadena);
                     $result="ok";
                }//es acgtaliadar
            }//De es insetar

            if($predeterminada=="1"){
                //borramos los predetneirando aantrroreo
                 $cadena="update u116753122_cw3completa.bodegas set
                                predeterminada='0'";
                $resultado = mysqli_query($conetar,$cadena);
                //motnamos el nuevo
                $cadena="update u116753122_cw3completa.bodegas set
                                predeterminada='1'
                                where id='".$id."'";
                $resultado = mysqli_query($conetar,$cadena);
            }

    }//es de desahibilitar
}//de hay cneion e bbd

?>
