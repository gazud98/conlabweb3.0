<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $fndnombre=$_REQUEST['fndnombre'];
    $fndfecha=$_REQUEST['fndfecha'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id='".$fndcodigo."'"; }
    if($fndnombre!="") { $maswhere=$maswhere . " and nombre like '%".$fndnombre."%'"; }
    if($fndfecha!="") { $maswhere=$maswhere . " and fecha like '%".$fndfecha."%'"; }

    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
