<?php
 include("../../../../../config/global_config.php");
//echo __FILE__.'>dd.....<br>';
//echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
if ($conetar->connect_errno) {
    $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    include("pageserror.php");
}else{

    $tipo       = $_FILES['dataCliente']['type'];
    $tamanio    = $_FILES['dataCliente']['size'];
    $archivotmp = $_FILES['dataCliente']['tmp_name'];
    $lineas     = file($archivotmp);

    $i = 0;

    foreach ($lineas as $linea) {
        $cantidad_registros = count($lineas);
        $cantidad_regist_agregados =  ($cantidad_registros - 1);

        if ($i != 0) {

            $datos = explode(";", $linea);

            $id= !empty($datos[0])  ? (str_replace('"', "", $datos[0])) : '';
            $email= !empty($datos[1])  ? (str_replace('"', "", $datos[1])) : '';
            $password= !empty($datos[2])  ? (str_replace('"', "", $datos[2])) : '';
            $firstName= !empty($datos[3])  ? (str_replace('"', "", $datos[3])) : '';
            $lastName= !empty($datos[4])  ? (str_replace('"', "", $datos[4])) : '';
            $cellPhone= !empty($datos[5])  ? (str_replace('"', "", $datos[5])) : '';
            $idProfile= !empty($datos[6])  ? (str_replace('"', "", $datos[6])) : '';
            $active= !empty($datos[7])  ? (str_replace('"', "", $datos[7])) : '';
            $creaDate= !empty($datos[8])  ? (str_replace('"', "", $datos[8])) : '';
            $idCreaUser= !empty($datos[9])  ? (str_replace('"', "", $datos[9])) : '';
            $modDate= !empty($datos[10])  ? (str_replace('"', "", $datos[10])) : '';
            $idModUser= !empty($datos[11])  ? (str_replace('"', "", $datos[11])) : '';


        if( !empty($id) ){
            $cadena="SELECT id
                FROM  ".$_SESSION['cw3ctrlsrv'].$_SESSION['bbserver1'].".users
                WHERE id='".$id."'";//obligfa en la empresa activa del sisrema
                $resultadP2=$conetar->query($cadena);
                $cant_duplicidad = mysqli_num_rows($resultadP2);

        }

        //No existe Registros Duplicados
        if ( $cant_duplicidad == 0 ) {

                    $cadena="insert into  ".$_SESSION['cw3ctrlsrv'].$_SESSION['bbserver1'].".users
                                (id,email,password,firstName,lastName,
                                cellPhone,idProfile,active,
                                creaDate,idCreaUser,modDate,idModUser)
                                VALUES (
                                NULL,'".$email."','".$password."','".$firstName."','".$lastName."','".
                                $cellPhone."','".$idProfile."','".$active."',
                                SYSDATE(),'".$_SESSION['userid']."',NULL,NULL)";
                    $resultado = mysqli_query($conetar,$cadena);

        }else{
            /**Caso Contrario actualizo el o los Registros ya existentes*/
            $cadena="UPDATE ".$_SESSION['cw3ctrlsrv'].$_SESSION['bbserver1'].".users SET
                                    email='".$email."',
                                    password='".$password."',
                                    firstName='".$firstName."',
                                    lastName='".$lastName."',
                                    cellPhone='".$cellPhone."',
                                    idProfile='".$idProfile."',
                                    active='".$active."',
                                    modDate=SYSDATE(),
                                    idModUser='".$_SESSION['userid']."'
                                WHERE id ='".$id."'";
            $resultado = mysqli_query($conetar,$cadena);
        }
    }

    $i++;
    }
?>
    <form action="../../index.php" method="post"
        name="FormLoginconectado" id="FormLoginconectado"
        enctype="multipart/form-data" target="_top">
        <input type="hidden" name="p" id="p" value="<?php echo $_SESSION['p']; ?>">
<!--                     <input type="hidden" name="redpwd" id="redpwd" value="E"> -->

                                <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['userid']; ?>">
                                <input type="hidden" name="name" id="name" value="<?php echo $_SESSION['nameis']; ?>">
        <script language="JavaScript">
                document.forms.FormLoginconectado.submit(); //hace el automarico
        </script>
    </form>
<?php
}
?>
