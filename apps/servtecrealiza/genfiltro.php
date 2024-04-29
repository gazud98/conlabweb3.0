<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $fndnombre=$_REQUEST['fndnombre'];
    $fndproveedor=$_REQUEST['fndproveedor'];
    $fndfecha=$_REQUEST['fndfecha'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id='".$fndcodigo."'"; }
    if($fndnombre!="") { $maswhere=$maswhere . " and nombre like '%".$fndnombre."%'"; }
    if($fndproveedor!="") { $maswhere=$maswhere . " and id_proveedor like '%".$fndproveedor."%'"; }
    if($fndfecha!="") { $maswhere=$maswhere . " and fecha like '%".$fndfecha."%'"; }

    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
