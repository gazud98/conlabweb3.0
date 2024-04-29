<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $fndnombre=$_REQUEST['fndnombre'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id='".$fndcodigo."'"; }
    if($fndnombre!="") { $maswhere=$maswhere . " and nombre like '%".$fndnombre."%'"; }

    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
