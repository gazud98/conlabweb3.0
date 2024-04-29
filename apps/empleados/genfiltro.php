<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
   


    if($fndcodigo!="") { $maswhere=$maswhere . " and P.id_persona='".$fndcodigo."'"; }
   


    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
