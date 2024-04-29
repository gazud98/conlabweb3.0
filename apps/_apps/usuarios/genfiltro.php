<?php
//si hay campos para valida

    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $nombre_1=$_REQUEST['nombre_1'];
    $nombre_2=$_REQUEST['nombre_2'];
    $apellido_1=$_REQUEST['apellido_1'];
    $apellido_2=$_REQUEST['apellido_2'];


    if($fndcodigo!="") { $maswhere=$maswhere . " and id_persona='".$fndcodigo."'"; }
    if($nombre_1!="") { $maswhere=$maswhere . " and nombre_1 like '%".$nombre_1."%'"; }
    if($nombre_2!="") { $maswhere=$maswhere . " and nombre_2 like '%".$nombre_2."%'"; }
    if($apellido_1!="") { $maswhere=$maswhere . " and apellido_1 like '%".$apellido_1."%'"; }
    if($apellido_2!="") { $maswhere=$maswhere . " and apellido_2 like '%".$apellido_2."%'"; }


    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
