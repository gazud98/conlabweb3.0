<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $fndnombre=$_REQUEST['fndnombre'];
    $fndreferencia=$_REQUEST['fndreferencia'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id_producto='".$fndcodigo."'"; }
    if($fndnombre!="") { $maswhere=$maswhere . " and nombre like '%".$fndnombre."%'"; }
    if($fndreferencia!="") { $maswhere=$maswhere . " and referencia like '%".$fndreferencia."%'"; }

    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
