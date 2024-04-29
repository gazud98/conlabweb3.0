<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $nombre_1=$_REQUEST['nombre_1'];
    $fndnit=$_REQUEST['fndnit'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id_proveedores='".$fndcodigo."'"; }
    if($nombre_1!="") { $maswhere=$maswhere . " and razon_social like '%".$nombre_1."%'"; }
    if($fndnit!="") { $maswhere=$maswhere . " and numero_identificacion like '%".$fndnit."%'"; }



    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
