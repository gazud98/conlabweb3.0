<?php
    $masselect="";
    $masfrom="";
    $maswhere="";


    $fndcodigo=$_REQUEST['fndcodigo'];
    $fndnombre=$_REQUEST['fndnombre'];

    if($fndcodigo!="") { $maswhere=$maswhere . " and id_sedes='".$fndcodigo."'"; }
    if($fndnombre!="") { $maswhere=$maswhere . " and nombre like '%".$fndnombre."%'"; }

    $cdgcontrol="S:".$masselect."|F:".$masfrom."|W:".$maswhere;
    echo $cdgcontrol;

?>
