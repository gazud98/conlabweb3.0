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

            $id=trim($_POST['id']);
            $identificacion_legal=trim($_POST['identificacion_legal']);
            $codigo_ria=trim($_POST['codigo_ria']);
            $ciudad=trim($_POST['ciudad']);
            $nombre_empresa=trim($_POST['nombre_empresa']);
            $direccion=trim($_POST['direccion']);
            $pais=trim($_POST['pais']);
            $telefono=trim($_POST['telefono']);
            $codigo_postal=trim($_POST['codigo_postal']);
            $fax=trim($_POST['fax']);
            $email=trim($_POST['email']);
            $direccion_electronica=trim($_POST['direccion_electronica']);


                    //asegruo que este en la tabla de campso adicoanes pde activos fijos
                    $cadena="select id from u116753122_cw3completa.identificacion_empresa";
                    $resultadP2=$conetar->query($cadena);
                    $numerfiles2 = mysqli_num_rows($resultadP2);
                    if($numerfiles2>=1){
                        //exite actualizao
                        $cadena="update u116753122_cw3completa.identificacion_empresa set
                                    identificacion_legal='".$identificacion_legal."',
                                    codigo_ria='".$codigo_ria."',
                                    nombre_empresa='".$nombre_empresa."',
                                    direccion='".$direccion."',
                                    pais='".$pais."',
                                    ciudad='".$ciudad."',
                                    telefono='".$telefono."',
                                    codigo_postal='".$codigo_postal."',
                                    fax='".$fax."',
                                    email='".$email."',
                                    direccion_electronica='".$direccion_electronica."'
                                where id='".$id."'";

                                echo $cadena;
                        $resultado = mysqli_query($conetar,$cadena);
                    }else{
                        //no existe creo
                        $cadena="insert into u116753122_cw3completa.identificacion_empresa(
                                        id,identificacion_legal,codigo_ria,ciudad,licencia,
                                        nombre_empresa,direccion,pais,ciudad,telefono,
                                        codigo_postal,fax,email,direccion_electronica)values('".
                                        $id."','".$identificacion_legal."','".$codigo_ria."','".$ciudad."','".
                                        sha1($nombre_empresa)."','".$nombre_empresa."','".$direccion."','".$pais."','".
                                        $ciudad."','".$telefono."','".$codigo_postal."','".
                                        $fax."','".$email."','".$direccion_electronica."')";

                                        echo $cadena;

                        $resultado = mysqli_query($conetar,$cadena);
                    }

//...............................................................................................................................................................

}

?>
