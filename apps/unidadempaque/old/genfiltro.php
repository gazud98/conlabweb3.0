<?php

    $modeeditstatus=$_POST['modeeditstatus'];
    $maswhere="";
    $masfrom="";
    if($modeeditstatus=="B") {
        //organiaop los filyros
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $email=$_POST['email'];

        if($email!="") { $maswhere=$maswhere." and U.email like '%".$email."%'"; }
        if($lastName!="") { $maswhere=$maswhere." and U.lastName like '%".$lastName."%'"; }
        if($firstName!="") { $maswhere=$maswhere." and U.firstName like '%".$firstName."%'";}
    }

    if($maswhere!=""){
        $_SESSION['filterfrom']=$masfrom;
        $_SESSION['filterwhere']=$maswhere;
    }else{
        $_SESSION['filterfrom']="";
        $_SESSION['filterwhere']="";
    }



    //echo $_SESSION['filterfrom']. '<br> ' .$_SESSION['filterwhere'];
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
