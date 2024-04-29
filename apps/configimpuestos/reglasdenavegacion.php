<?php

//echo 'regaldebavevsvon';

    if(isset($_REQUEST["p"])){$p=$_REQUEST["p"];}

    //echo '.......>'.$p.'<......';

    //reglas obligatorias:
    if ( isset( $_REQUEST["sctrl1"] ) ) {
        if($_REQUEST["sctrl1"]!="0"){ $sctrl1=$_REQUEST["sctrl1"]; }else{ $sctrl1="0"; }
    }else{ $sctrl1="0"; }

    if ( isset( $_REQUEST["sctrl2"] ) ) {
        if($_REQUEST["sctrl2"]!="0"){ $sctrl2=$_REQUEST["sctrl2"];}else{ $sctrl2="0"; }
    }else{ $sctrl2="0"; }

    if ( isset( $_REQUEST["sctrl3"] ) ) {
        if($_REQUEST["sctrl3"]!="0"){ $sctrl3=$_REQUEST["sctrl3"];}else{ $sctrl3="0"; }
    }else{ $sctrl3="0"; }

//     darcontrol : filterselect
    if ( isset( $_REQUEST["sctrl4"] ) ) {
        if($_REQUEST["sctrl4"]!="0"){ $sctrl4=$_REQUEST["sctrl4"];}else{ $sctrl4="0"; }
    }else{ $sctrl4="0"; }

//     darcontrol : filterfrom
    if ( isset( $_REQUEST["sctrl5"] ) ) {
        if($_REQUEST["sctrl5"]!="0"){ $sctrl5=$_REQUEST["sctrl5"];}else{ $sctrl5="0"; }
    }else{ $sctrl5="0"; }

//     darcontrol : filterwhere
    if ( isset( $_REQUEST["sctrl6"] ) ) {
        if($_REQUEST["sctrl6"]!="0"){ $sctrl6=$_REQUEST["sctrl6"];}else{ $sctrl6="0"; }
    }else{ $sctrl6="0"; }


    if ( isset($_REQUEST['limiteinf']) ){
        $limiteinf = $_REQUEST['limiteinf'];
    }else{ $limiteinf=""; }
     if($limiteinf==""){ $limiteinf=0; }else{ if($limiteinf=="1"){ $limiteinf=0; } }

     if ( isset($_REQUEST['limitinpantalla']) ){
         $limitinpantalla = $_REQUEST['limitinpantalla'];
        }else{ $limitinpantalla="15"; }

     if($sctrl4!="0"){$filterselect=$sctrl4;}else{$filterselect="";}
     if($sctrl5!="0"){$filterfrom=$sctrl5;}else{$filterfrom="";}
     if($sctrl6!="0"){$filterwhere=$sctrl6;}else{$filterwhere="";}

/* */

?>
