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



    $cadena = "SELECT distinct id_persona , id_sede
    FROM u116753122_cw3completa.ordrequisicion_temp";

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id_persona = $filaP2['id_persona'];
            $id_sede = $filaP2['id_sede'];
            date_default_timezone_set('America/Bogota');
            $fechaActual = date("d/m/Y");
            $horaActual = date("h:i:s");

            $cadena21 = "insert into u116753122_cw3completa.ordrequisicion(id_persona,id_sede,fecha,hora,estado)values(
                '" . $id_persona . "',
                '" . $id_sede . "',
                '" . $fechaActual .
                "','" . $horaActual .
                "','P')";
            $resultado21 = mysqli_query($conetar, $cadena21);
        
            $cadena3 = "select id
           from u116753122_cw3completa.ordrequisicion
           where fecha='" . $fechaActual . "'
               and hora='" . $horaActual . "'
               and id_persona='" . $id_persona . "' and id_sede='" . $id_sede . "' ";
            $resultadP22 = $conetar->query($cadena3);
            $numerfiles22 = mysqli_num_rows($resultadP22);
            if ($numerfiles22 >= 1) {
                $filaP22 = mysqli_fetch_array($resultadP22);
                $idreq = $filaP22['id'];
             
            }

            $cadena4 = "SELECT  id_producto, cantidad, ccosto, id_departamento
            FROM u116753122_cw3completa.ordrequisicion_temp a 
            where id_persona='" . $id_persona."' and id_sede='".$id_sede."'";
            $resultadP23 = $conetar->query($cadena4);
            $numerfiles23 = mysqli_num_rows($resultadP23);
            if ($numerfiles23 >= 1) {
                while ($filaP23 = mysqli_fetch_array($resultadP23)) {
                    $id_productox = $filaP23['id_producto'];
                    $cantidad = $filaP23['cantidad'];
                    $ccosto = $filaP23['ccosto'];
                    $id_departamento = $filaP23['id_departamento'];
                    $cadena5 = "insert into u116753122_cw3completa.ordrequisicion_detalle
                    (id_req,id_producto,cantidad,ccosto,id_departamento)values('" .
                        $idreq .
                        "','" . $id_productox .
                        "','" . $cantidad . "','" . $ccosto . "','" . $id_departamento . "')";
                    $resultado4 = mysqli_query($conetar, $cadena5);
                }
            }
        
        }
    }
   


  

    $cadenaxy = "DELETE  FROM u116753122_cw3completa.ordrequisicion_temp";
    $resultado = mysqli_query($conetar, $cadenaxy);


    
}//de hay cneion e bbd
