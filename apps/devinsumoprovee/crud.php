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
        $cadena="select estado from u116753122_cw3completa.insumo_devueltosproveedor where id='".$id."'";
        $resultadP2a=$conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if($numerfiles2a>=1){
            $filaP2a=mysqli_fetch_array($resultadP2a);
            $estado=trim($filaP2a['estado']);
        }else{ $estado='1'; }
        if($estado=='1'){ $estado='0'; }else{ $estado='1'; }
        $cadena= "update u116753122_cw3completa.insumo_devueltosproveedor set estado='".$estado."' where id='".$id."'";
        $resultado = mysqli_query($conetar,$cadena);
        $result="ok";
    }else{//es crea o moifica

        $nombre=trim($_POST['nombre']);
         $cantidad=trim($_POST['cantidad']);
        $fecha=trim($_POST['fecha']);
        $motivo=trim($_POST['motivo']);
        $costo=trim($_POST['costo']);
        $no_factura=trim($_POST['no_factura']);
        $estado=trim($_POST['estado']);




            if($modeeditstatus=="C"){////CREACION
                $cadena="insert into u116753122_cw3completa.insumo_devueltosproveedor(nombre,cantidad,fecha,motivo,costo,no_factura,estado)values('".
                        $nombre.
                        "','".$cantidad.
                        "','".$fecha.
                        "','".$motivo.
                        "','".$costo.
                        "','".$no_factura.
                        "','1')";
                $resultado = mysqli_query($conetar,$cadena);

                //bujscamos el id para el proce sde predetemando...
                $cadena="select id from  u116753122_cw3completa.insumo_devueltosproveedor where
                            nombre='".$nombre."'
                            and cantidad='".$cantidad."'
                            and fecha='".$fecha."'
                            and motivo='".$motivo."'
                            and costo='".$costo."'
                            and no_factura='".$no_factura."'";
                $resultadP2a=$conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if($numerfiles2a>=1){
                    $filaP2a=mysqli_fetch_array($resultadP2a);
                    $id=$filaP2a['id'];
                }
                $result="ok";
            }else{
                if($modeeditstatus=="E"){//acgualzucsion
                    $cadena="update u116753122_cw3completa.insumo_devueltosproveedor set
                                nombre='".$nombre."',
                                cantidad='".$cantidad."',
                                fecha='".$fecha."',
                                motivo='".$motivo."',
                                costo='".$costo."',
                                no_factura='".$no_factura."'
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
