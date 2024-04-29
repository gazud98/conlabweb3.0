<?php
//SI POSEE CONSUKTA

if( file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
}else{
    if( file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    }else{
        if( file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}

 //echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
 $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
 if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
 }else{




 include('reglasdenavegacion.php');

     /* */
   // $caso=$_REQUEST['caso'];
   if(isset($_REQUEST['id']))  {
        $id=$_REQUEST['id'];

    //$id=1;
   // echo $caso.'----'.$id;
    /* */

    $cadena="select id
                from u116753122_cw3completa.cargos
                where id='".$id."'";
    $resultadP2=$conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2>=1){
        $filaP2=mysqli_fetch_array($resultadP2);
        $id=trim($filaP2['id']);
    }
 }else{
    $id="";
    $nombre="";
 }

?>
            <div class=" bg-light col-md-12 col-lg-12 p-2" name="accionejec" id="accionejec"
                style="pointer-events: none; text-align:center; font-weight:bold;display:none; background-color:#ededed; "
                ></div><?php //Aqui se esceo lo que va a pasar ?>

                <div class="col-md-12 col-lg-12 p-3" name="iddatas" id="iddatas" style="pointer-events: none;background-color:#ededed;">


                    <div class="row" name="casoesperado" id="casoesperado"><?php include('thedatacase1.php');  //campos de la app ?></div><?php //aqui va el caso a mostrar segun seleccion del caso encontrado ?>
                </div>



<script>

    function cargarcasoesperado(){
        <?php
             if($sctrl1!="0"){
            ?>
                 var casox=<?php echo $sctrl1;  ?>//es un defalut
            <?php
            }else{
            ?>
                var casox=$("#id_categoria_producto").val();
            <?php
            } //busca siemtpe ponerse en productos si exisr eerror

            if($id==""){ $id="-1";}//no viene anda lo pongo en babco enla otra pantalla todos los campos y lo pogo de color inhabilitado
        ?>


         $("#casoesperado").load('<?php echo 'apps/'.$p.'/datacase1.php'; ?>',
                                 { p:"<?php echo $p; ?>",
                                   id:<?php echo $id; ?>,
                                   limiteinf:<?php echo $limiteinf; ?>,
                                   limitinpantalla:<?php echo limitinpantalla; ?>,
                                   sctrl1:<?php echo $sctrl1; ?>,
                                   sctrl2:<?php echo $sctrl2; ?>,
                                   sctrl3:<?php echo $sctrl3; ?>,
                                   sctrl4:<?php echo $sctrl4; ?>,
                                   sctrl5:<?php echo $sctrl5; ?>,
                                   sctrl6:<?php echo $sctrl6; ?>
                                 }
                         );
    }


    cargarcasoesperado();//Ejecuacin automaica
</script>



<?php
 }
 ?>
