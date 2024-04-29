<?php
 include("../../../../../config/global_config.php");
//echo __FILE__.'>dd.....<br>';
//echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
if ($conetar->connect_errno) {
    $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    include("pageserror.php");
}else{


/*
echo $_FILES['formFile']['name'].'<br>';
echo $_FILES['formFile']['tmp_name'].'<br>';
echo $_FILES['formFile']['type'].'<br>';
echo $_FILES['formFile']['size'].'<br>';
echo $_FILES['formFile']['error'].'<br>';

*/
    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $modeeditstatus=$_POST['modeeditstatus'];
        $id=$_POST['id'];
            $active=$_POST['active'];
            $email=$_POST['email'];
            $password=sha1($_POST['password']);
            $firstName=$_POST['firstName'];
            $lastName=$_POST['lastName'];
            $cellPhone=$_POST['cellPhone'];
            $idProfile=$_POST['idProfile'];



        if($modeeditstatus=="D"){
            $cadenaa="select U.active
                        from ".$_SESSION['cw3ctrlsrv'].$_SESSION['bbserver1'].".users U
                        where U.id='".$id."'";
            $resultadP2a=$conetar->query($cadenaa);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            $activez=1;
            if($numerfiles2a>=1){
                $filaP2a=mysqli_fetch_array($resultadP2a);
                $activez=$filaP2a['active'];
            }

            if($activez=="0"){
                //procedo a borrarlos
                $cadena="delete from ".$_SESSION['cw3ctrlsrv'].$_SESSION['bbserver1'].".users
                        WHERE id ='".$id."'";
//                         echo $cadena;
                 $resultado = mysqli_query($conetar,$cadena);
            }else{
                //lo marcao como ianivo
                $cadena="UPDATE ".$_SESSION['cw3ctrlsrv'].$_SESSION['bbserver1'].".users SET
                            active = '0'
                        WHERE id ='".$id."'";
//                         echo $cadena;
                 $resultado = mysqli_query($conetar,$cadena);
            }
        }else{


            if($modeeditstatus=="C"){


                $cadena="insert into  ".$_SESSION['cw3ctrlsrv'].$_SESSION['bbserver1'].".users
                            (id,email,password,firstName,lastName,
                            cellPhone,idProfile,active,
                            creaDate,idCreaUser,modDate,idModUser)
                            VALUES (
                            NULL,'".$email."','".$password."','".$firstName."','".$lastName."','".
                            $cellPhone."','".$idProfile."','".$active."',
                            SYSDATE(),'".$_SESSION['userid']."',NULL,NULL)";

//                             echo $cadena;
                 $resultado = mysqli_query($conetar,$cadena);
            }else{

                if($modeeditstatus=="E"){

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
//                                 echo $cadena;
                     $resultado = mysqli_query($conetar,$cadena);
                }
            }

        }//dee selonIR?
}


            ?>
                <form action="../../index.php" method="post"
                    name="FormLoginconectado" id="FormLoginconectado"
                    enctype="multipart/form-data" target="_top">
                    <input type="hidden" name="p" id="p" value="<?php echo $_SESSION['p']; ?>">
                    <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['userid']; ?>">
                                <input type="hidden" name="name" id="name" value="<?php echo $_SESSION['nameis']; ?>">
<!--                     <input type="hidden" name="redpwd" id="redpwd" value="E"> -->
                    <script language="JavaScript">
                                    document.forms.FormLoginconectado.submit(); //hace el automarico
                    </script>
                </form>
            <?php

?>
