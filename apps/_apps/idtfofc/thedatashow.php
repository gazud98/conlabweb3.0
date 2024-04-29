<?php


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
?>
            <div class=" bg-light col-md-12 col-lg-12 p-2" name="accionejec" id="accionejec"
                style="text-align:center; font-weight:bold;display:none; background-color:#ededed; "
                ></div><?php //Aqui se esceo lo que va a pasar ?>

                <div class="col-md-12 col-lg-12 p-3" name="iddatas" id="iddatas" style="pointer-event_s: none;background-color:#ededed;">
                    <div class="row" name="casoesperado" id="casoesperado"></div><?php //aqui va el caso a mostrar segun seleccion del caso encontrado ?>
                </div>



<script>

    function cargarcasoesperado(){
        <?php 
            if(!isset($id)){ $id=""; }
            if($id==""){ $id="-1"; }//no viene anda lo pongo en babco enla otra pantalla todos los campos y lo pogo de color inhabilitado
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
