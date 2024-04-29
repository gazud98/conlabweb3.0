<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $fndnombre=$_REQUEST['fndnombre'];
    $fndcantidad=$_REQUEST['fndcantidad'];
    $fndfecha=$_REQUEST['fndfecha'];
    $fndfactura=$_REQUEST['fndfactura'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id='".$fndcodigo."'"; }
    if($fndnombre!="") { $maswhere=$maswhere . " and nombre like '%".$fndnombre."%'"; }
    if($fndcantidad!="") { $maswhere=$maswhere . " and cantidad like '%".$fndcantidad."%'"; }
    if($fndfecha!="") { $maswhere=$maswhere . " and fecha like '%".$fndfecha."%'"; }
    if($fndfactura!="") { $maswhere=$maswhere . " and no_factura like '%".$fndfactura."%'"; }
    

    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
