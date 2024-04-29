<?php
$result = "err";

//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');


    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $id = trim($_POST['idcuenta']);
    $codcuenta = trim($_POST['codcuenta']);
    $nombrecuenta = trim($_POST['nombrecuenta']);


    $cadena2="select id_ctapagar from u116753122_cw3completa.config_ctaxpagar WHERE id_ctapagar = '$id'";
    $resultadP2=$conetar->query($cadena2);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2<1){
        $cadena = "insert into u116753122_cw3completa.config_ctaxpagar(codigo_ctapagar, descripcion) 
        values('" . $codcuenta . "', '" . $nombrecuenta . "')";
        $resultado = mysqli_query($conetar, $cadena);
    }else{
        $cadena="update u116753122_cw3completa.config_ctaxpagar set
                                    codigo_ctapagar='".$codcuenta."',
                                    descripcion='".$nombrecuenta."'
                                    where id_ctapagar = '".$id."'";

                        $resultado = mysqli_query($conetar,$cadena);
    }

    //asegruo que este en la tabla de campso adicoanes pde activos fijos
    /*$cadena="select * from u116753122_cw3completa.config_impuestos WHERE codigo_cuenta = '$cuentacontable'";
                    $resultadP2=$conetar->query($cadena);
                    $numerfiles2 = mysqli_num_rows($resultadP2);
                    if($numerfiles2>=1){
                        //exite actualizao
                        $cadena="update u116753122_cw3completa.config_impuestos set
                                    codigo_cuenta='".$cuentacontable."',
                                    valor_uvt_config='".$valoruvt."',
                                    base_pesos='".$basepesos."',
                                    porcentaje_uvt='".$porcentajeuvt."'
                                    where id_config_imp='".$id."' AND codigo_cuenta = '" .$cuentacontable."'";

                                echo $cadena;
                        $resultado = mysqli_query($conetar,$cadena);
                    }else{
                        //no existe creo
                        $cadena="insert into u116753122_cw3completa.config_impuestos(codigo_cuenta,valor_uvt_config,base_pesos,
                        porcentaje_uvt)values('".$cuentacontable."','".$valoruvt."','".$basepesos."','".$porcentajeuvt."')";

                        echo $cadena;

                        $resultado = mysqli_query($conetar,$cadena);
                    }*/

    //...............................................................................................................................................................

}
