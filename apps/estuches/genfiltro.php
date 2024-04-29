<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $fndnombre=$_REQUEST['fndnombre'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id_reactivo='".$fndcodigo."'"; }
    if($fndnombre!="") { $maswhere=$maswhere . " and reactivo like '%".$fndnombre."%'"; }

    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
