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

    $id = trim($_POST['id']);
    $tiporete = trim($_POST['tiporete']);
    $cuentacontable = trim($_POST['cuentacontable']);
    $nombrecu = trim($_POST['nombrecu']);
    $valoruvt = trim($_POST['valoruvt']);
    $basepesos = trim($_POST['basepesos']);
    $porcentajeuvt = trim($_POST['porcentajeuvt']);
    

    $cadena2="select codigo_cuenta from u116753122_cw3completa.config_impuestos WHERE codigo_cuenta = '$cuentacontable'";
    $resultadP2=$conetar->query($cadena2);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2<1){
        $cadena = "insert into u116753122_cw3completa.config_impuestos(codigo_cuenta,nombre_cuenta,valor_uvt_config,base_pesos,
                        porcentaje_uvt,tipo_cuenta)values('" . $cuentacontable . "','" . $nombrecu . "','" . $valoruvt . "','" . $basepesos . 
                        "','" . $porcentajeuvt . "','" . $tiporete . "')";
        $resultado = mysqli_query($conetar, $cadena);
    }else{
        $cadena="update u116753122_cw3completa.config_impuestos set
                                    codigo_cuenta='".$cuentacontable."',
                                    nombre_cuenta='".$nombrecu."',
                                    valor_uvt_config='".$valoruvt."',
                                    base_pesos='".$basepesos."',
                                    porcentaje_uvt='".$porcentajeuvt."',
                                    tipo_cuenta='".$tiporete."'
                                    where codigo_cuenta = '" .$cuentacontable."'";

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
