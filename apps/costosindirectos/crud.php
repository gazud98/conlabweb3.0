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

    $modeeditstatus="C";
    $id=$_REQUEST['id'];

    if($modeeditstatus=="D"){//es de desahibilitar/habikitr
//          si estadio es 1 pasa ra 0 o v iceversa
        $cadena="select estado from u116753122_cw3completa.bodegas where id='".$id."'";
        $resultadP2a=$conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if($numerfiles2a>=1){
            $filaP2a=mysqli_fetch_array($resultadP2a);
            $estado=trim($filaP2a['estado']);
        }else{ $estado='1'; }
        if($estado=='1'){ $estado='0'; }else{ $estado='1'; }
        $cadena= "update u116753122_cw3completa.bodegas set estado='".$estado."' where id='".$id."'";
        $resultado = mysqli_query($conetar,$cadena);
        $result="ok";
    }else{//es crea o moifica
      
        $descripcion=trim(htmlspecialchars($_POST['descripcion']));
     

        if ($_POST['distribuido'] == "1"){
            $distribuir_dpto = 1;
            $distribuir_prueba = 0;
        }elseif($_POST['distribuido'] == "2"){
            $distribuir_dpto = 0;
            $distribuir_prueba = 1;
        }
        if (isset($_REQUEST['check'])) {
           $chek1 = 1;
          }
            if($modeeditstatus=="C"){////CREACION
                $cadena="insert into u116753122_cw3completa.costos_indirectos(descripcion,distribuir_dpto,distribuir_prueba,costo_fijo,estado)values('".
                        $descripcion.
                        "','".$distribuir_dpto.
                        "','".$distribuir_prueba.
                        "','".$chek1.
                        "','1')";
                $resultado = mysqli_query($conetar,$cadena);

                //bujscamos el id para el proce sde predetemando...
                $cadena="select id from  u116753122_cw3completa.detalle_costosindirectos where
                            nombre='".$nombre."'
                            and descripcion='".$descripcion."'
                            and mes='".$mes."'
                            and ano='".$ano."'";
                $resultadP2a=$conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if($numerfiles2a>=1){
                    $filaP2a=mysqli_fetch_array($resultadP2a);
                    $id=$filaP2a['id'];
                }
                $result="ok";
            }else{
                if($modeeditstatus=="E"){//acgualzucsion
                    $cadena="update u116753122_cw3completa.bodegas set
                                nombre='".$nombre."',
                                codigo='".$codigo."',
                                id_centro_costo='".$id_centro_costo."',
                                id_empleado='".$id_empleado."',
                                predeterminada='".$predeterminada."'
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
