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
        $cadena="select estado from u116753122_cw3completa.sedes where id_sedes='".$id."'";
        $resultadP2a=$conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if($numerfiles2a>=1){
            $filaP2a=mysqli_fetch_array($resultadP2a);
            $estado=trim($filaP2a['estado']);
        }else{ $estado='1'; }
        if($estado=='1'){ $estado='0'; }else{ $estado='1'; }
        $cadena= "update u116753122_cw3completa.sedes set estado='".$estado."' where id_sedes='".$id."'";
        $resultado = mysqli_query($conetar,$cadena);
        $result="ok";
    }else{//es crea o moifica

        $nombre=trim($_POST['nombre']);
        $estado=trim($_POST['estado']);



            if($modeeditstatus=="C"){////CREACION
                $cadena="insert into u116753122_cw3completa.sedes(nombre)values('".$nombre."')";
                $resultado = mysqli_query($conetar,$cadena);
                /*si existe tablas dependentiees-......busco el id
                $cadena="select id_sedes
                                from u116753122_cw3completa.producto
                                where id_categoria_producto='".$id_categoria_producto."'
                                        and nombre='".$nombre."'
                                        and referencia='".$referencia."'
                                        and id_departamento='".$id_departamento."'";
                    $resultadP2=$conetar->query($cadena);
                    $numerfiles2 = mysqli_num_rows($resultadP2);
                    if($numerfiles2>=1){
                        //creo el compelntero
                        $filaP2a=mysqli_fetch_array($resultadP2);
                        $id=$filaP2a['id_producto'];
                        //no existe creo
                        $cadena="insert into u116753122_cw3completa.producto_activofijo(id_producto,valor,modelo,serie,
                                       fchinstalacion,seguro,seguroprima,garantia,
                                        fchexpgarantia,vidautilmes,metdepreciacion)values('".
                                        $id."','".$valor."','".$modelo."','".$serie."','".
                                        $fchinstalacion."','".$seguro."','".$seguroprima."','".$garantia."','".
                                        $fchexpgarantia."','".$vidautilmes."','".$metdepreciacion."')";
                        $resultado = mysqli_query($conetar,$cadena);
                    }
                    */
                    $result="ok";
            }else{
                if($modeeditstatus=="E"){//acgualzucsion
                    $cadena="update u116753122_cw3completa.sedes set
                                nombre='".$nombre."'
                            where id_sedes='".$id."'";
                    $resultado = mysqli_query($conetar,$cadena);

                    /*
                    //si hay tabals sub de sedesasegruo que este en la tabla de campso adicoanes pde activos fijos
                    $cadena="select id_sedes
                                from u116753122_cw3completa.producto_activofijo
                                where id_producto='".$id."'";
                    $resultadP2=$conetar->query($cadena);
                    $numerfiles2 = mysqli_num_rows($resultadP2);
                    if($numerfiles2>=1){
                        //exite actualizao
                        $cadena="update u116753122_cw3completa.producto_activofijo set
                                    valor='".$valor."',
                                    modelo='".$modelo."',
                                    serie='".$serie."',
                                    fchinstalacion='".$fchinstalacion."',
                                    seguro='".$seguro."',
                                    seguroprima='".$seguroprima."',
                                    garantia='".$garantia."',
                                    fchexpgarantia='".$fchexpgarantia."',
                                    vidautilmes='".$vidautilmes."',
                                    metdepreciacion='".$metdepreciacion."'
                                 where id_producto='".$id."'";
                        $resultado = mysqli_query($conetar,$cadena);
                    }else{
                        //no existe creo
                        $cadena="insert into u116753122_cw3completa.producto_activofijo(id_producto,valor,modelo,serie,
                                       fchinstalacion,seguro,seguroprima,garantia,
                                        fchexpgarantia,vidautilmes,metdepreciacion)values('".
                                        $id."','".$valor."','".$modelo."','".$serie."','".
                                        $fchinstalacion."','".$seguro."','".$seguroprima."','".$garantia."','".
                                        $fchexpgarantia."','".$vidautilmes."','".$metdepreciacion."')";

                                        echo '<br><br>'.$cadena;

                        $resultado = mysqli_query($conetar,$cadena);
                    }
                    */

                     $result="ok";
                }//es acgtaliadar
            }//De es insetar
    }//es de desahibilitar
}//de hay cneion e bbd

?>
