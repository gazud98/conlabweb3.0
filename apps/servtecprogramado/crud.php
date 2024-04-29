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
        $cadena="select estado from u116753122_cw3completa.visitas_tecnicas where id='".$id."'";
        $resultadP2a=$conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if($numerfiles2a>=1){
            $filaP2a=mysqli_fetch_array($resultadP2a);
            $estado=trim($filaP2a['estado']);
        }else{ $estado='1'; }
        if($estado=='1'){ $estado='0'; }else{ $estado='1'; }
        $cadena= "update u116753122_cw3completa.visitas_tecnicas set estado='".$estado."' where id='".$id."'";
        $resultado = mysqli_query($conetar,$cadena);
        $result="ok";
    }else{//es crea o moifica

        $fecha=trim($_POST['fecha']);
        $id_proveedores=trim($_POST['id_proveedores']);
            $id_instrumento=trim($_POST['id_instrumento']);
            $falla=trim($_POST['falla']);
            $reparacion=trim($_POST['reparacion']);
            $repuesto=trim($_POST['repuesto']);
            $tecnico=trim($_POST['tecnico']);
            $valor=trim($_POST['valor']);



            if($modeeditstatus=="C"){////CREACION
                $cadena="insert into u116753122_cw3completa.visitas_tecnicas(fecha,id_proveedor,id_instrumento,falla,reparacion,repuesto,tecnico,valor,estado)values('".
                        $fecha.
                        "','".$id_proveedores.
                        "','".$id_instrumento.
                        "','".$falla.
                        "','".$reparacion.
                        "','".$repuesto.
                        "','".$tecnico.
                        "','".$valor.
                        "','1')";
                $resultado = mysqli_query($conetar,$cadena);

                //bujscamos el id para el proce sde predetemando...
                $cadena="select id from  u116753122_cw3completa.visitas_tecnicas where
                id_proveedor='".$id_proveedor."'
                            and id_instrumento='".$id_instrumento."'";
                $resultadP2a=$conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if($numerfiles2a>=1){
                    $filaP2a=mysqli_fetch_array($resultadP2a);
                    $id=$filaP2a['id'];
                }
                $result="ok";
            }else{
                if($modeeditstatus=="E"){//acgualzucsion
                    $cadena="update u116753122_cw3completa.visitas_tecnicas set
                    fecha='".$fecha."',
                    id_proveedor='".$id_proveedores."',
                    id_instrumento='".$id_instrumento."',
                    falla='".$falla."',
                    reparacion='".$reparacion."',
                    repuesto='".$repuesto."',
                    tecnico='".$tecnico."',
                    valor='".$valor."'
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
