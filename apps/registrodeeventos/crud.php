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

    $modeeditstatus="D";
    $id=trim($_REQUEST['id']);
     
    if($modeeditstatus=="D"){
        $cadena="delete from u116753122_cw3completa.solicitud_insumo_enc where id='".$id."'";
        $resultado=mysqli_query($conetar,$cadena);
        $result="ok";

    }else{//es crea o moifica

        
       


            if($modeeditstatus=="C"){////CREACION
                $cadena="insert into u116753122_cw3completa.departamentos(nombre,estado)values('".$nombre."','1')";
                $resultado = mysqli_query($conetar,$cadena);
                    $result="ok";
            }else{
                if($modeeditstatus=="E"){//acgualzucsion
                    $cadena="update u116753122_cw3completa.departamentos set
                                nombre='".$nombre."'
                            where id='".$id."'";
                    $resultado = mysqli_query($conetar,$cadena);

                     $result="ok";
                }//es acgtaliadar
            }//De es insetar
    }//es de desahibilitar
}//de hay cneion e bbd

?>
