<?php
   $filterfrom="";
   $filterwhere="";

   
    //Control de navigation de la app en curso
    $limiteinf=$_REQUEST['limiteinf'];
    $cantrgt=$_REQUEST['cantrgt'];
    $cantregistros=$_REQUEST['limitinpantalla'];//15 es el limite en pantalla ese esxcribe en el index.php jcial
    $numeroenpantalla=5; //nuemro maxomo de items a mostrar en la pantalas  Ej:5 seria  < 1 2 3 4 5 >

    $last = ceil( $cantrgt / $cantregistros );

    if($cantrgt<=$cantregistros){ $showme="none"; }else { $showme="display"; } //si tiene menos d la cantidad minima se oculta el naveigattor

    $pageactive=ceil(($limiteinf)/$cantregistros);

    $max =$pageactive*$cantregistros;
    //echo '..pageacive: '.$pageactive."--MAX:".$max.'--cantrwegt:'.$cantrgt;

    $page1=(ceil($pageactive/$numeroenpantalla)*$numeroenpantalla)-($numeroenpantalla-1);//5 es numero de pantallazos visibles

        if ((($page1*$cantregistros)-$cantregistros)<=$cantrgt){
            $displaypage1="display";
        }else{ $displaypage1="none"; }
     $page2=$page1+1;
        if((($page2*$cantregistros)-$cantregistros)<=$cantrgt){
            $displaypage2="display";
        }else{ $displaypage2="none"; }
     $page3=$page2+1;
        if((($page3*$cantregistros)-$cantregistros)<=$cantrgt){
            $displaypage3="display";
        }else{ $displaypage3="none"; }
     $page4=$page3+1;
        if((($page4*$cantregistros)-$cantregistros)<=$cantrgt){
            $displaypage4="display";
        }else{ $displaypage4="none"; }
     $page5=$page4+1;
        if((($page5*$cantregistros)-$cantregistros)<=$cantrgt){
            $displaypage5="display";
        }else{ $displaypage5="none"; }
    $page6=$page5+1;
        if((($page6*$cantregistros)-$cantregistros)<=$cantrgt){
            $displaypage5="display";
        }else{ $displaypage5="none"; }


    $pageA=$pageactive-1;
    if($pageA<=0) { $displaypageA="none"; }else{ $displaypageA="display"; }


    if($max>=$cantrgt){
         $displaypageS="none";
    }else{
        $pageS=$pageactive+1;
        if($limiteinf>=$cantrgt) { $displaypageS="none"; }else{ $displaypageS="display"; }
    }

?>

<nav aria-label="Page navigation">


        <table style="width:100%;" >
                            <tr>
                                <td style="width:30%"><span style="font-size:0.8em">Mostrando: <?php echo $limiteinf; ?> a <?php echo $limiteinf+14; ?> de <?php echo $cantrgt; ?> registros</span></td>
                                <td style="width:69%">

                                    <ul class="pagination pagination-sm justify-content-center ">
        <li class="page-item"><a class="page-link" href="#"
            style="display:<?php echo $displaypageA; ?>"
            onclick="paginattion(<?php echo $pageA; ?>);">«</a></li>
        <li class="page-item <?php if($pageactive==$page1){ echo "active"; } ?>" style="display:<?php echo $displaypage1; ?>">
            <a class="page-link" href="#" onclick="paginattion(<?php echo $page1; ?>);"><?php echo $page1; ?></a>
        </li>
        <li class="page-item  <?php if($pageactive==$page2){ echo "active"; } ?>" style="display:<?php echo $displaypage2; ?>">
            <a class="page-link" href="#" onclick="paginattion(<?php echo $page2; ?>);"><?php echo $page2; ?></a>
        </li>
        <li class="page-item  <?php if($pageactive==$page3){ echo "active"; } ?>" style="display:<?php echo $displaypage3; ?>">
            <a class="page-link" href="#" onclick="paginattion(<?php echo $page3; ?>);"><?php echo $page3; ?></a>
        </li>
        <li class="page-item  <?php if($pageactive==$page4){ echo "active"; } ?>" style="display:<?php echo $displaypage4; ?>">
            <a class="page-link" href="#" onclick="paginattion(<?php echo $page4; ?>);"><?php echo $page4; ?></a>
        </li>
        <li class="page-item  <?php if($pageactive==$page5){ echo "active"; } ?>" style="display:<?php echo $displaypage5; ?>">
            <a class="page-link" href="#" onclick="paginattion(<?php echo $page5; ?>);"><?php echo $page5; ?></a>
        </li>
        <li class="page-item"><a class="page-link" href="#"
            style="display:<?php echo $displaypageS; ?>"
            onclick="paginattion(<?php echo $pageS; ?>);">»</a></li>
    </ul>




                                </td>
                                <td style="width:1%">
                                    <button type="button"
                                        class="btn btn-<?php if($filterwhere==""){ echo 'primary'; } else{ echo 'secondary'; } ?> btn-xs
                                            text-nowrap"
                                            data-toggle="modal" data-target="#modal-find" >
                                            <i class="fas fa-newspaper"></i>&nbsp;&nbsp;
                                            <?php if($filterwhere==""){ echo ' Filtro'; }else{ echo "Filtro Aplicado"; } ?>
                                    </button>
                                </td>
                            </tr>
                        </table>




</nav>


<?php /* */ ?>
