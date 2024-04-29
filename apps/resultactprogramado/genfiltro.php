<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $fndnombre=$_REQUEST['fndnombre'];
    $fndfecha=$_REQUEST['fndfecha'];
    $fndactividad=$_REQUEST['fndactividad'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id='".$fndcodigo."'"; }
    if($fndnombre!="") { $maswhere=$maswhere . " and instrumento like '%".$fndnombre."%'"; }
    if($fndfecha!="") { $maswhere=$maswhere . " and fecha like '%".$fndfecha."%'"; }
    if($fndactividad!="") { $maswhere=$maswhere . " and actividades like '%".$fndactividad."%'"; }

    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
