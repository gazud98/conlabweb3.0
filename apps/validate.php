<?php
if(isset($_REQUEST['mod']))  {
    $mod=$_REQUEST['mod'];
if($mod=="-1"){ $mod=""; }
}else{ $mod=""; }


   

$_SESSION['moduraiz'] = $mod;
