<?php


// echo __FILE__.'>dd.....<br>';
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

    // echo $sctrl1;
     $nmbapp="IDENTIFICACION DE LA EMPRESA";

//echo ".................".$sctrl4."-----------";

             $cantrgt = 1;
;
?>

            <div class="card border-info">

                <div class="card-header bg-light " style="">
                    <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong><?php echo $nmbapp; ?></strong> </label>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12" style="overflow:hidden; overflow-y:auto;" name="divappshow" id="divappshow">
                            <?php include('thedatashow.php');  //campos de la app ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <?php include('piepag.php'); //zoan de botornes?>
                </div>
            </div>

<?php
include('apps/thedata.php');//scriops de control
?>

    <script>
        function habilitacmpos(){
            $("#iddatas").css("background-color","white");
        }
        function inhabilitacmpos(){
            $("#iddatas").css("background-color","#ededed");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }

        function savedata(){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url.'apps/'.$p.'/crud.php'; ?>',
                data: $('#formcontrol').serialize(),
                success: function(respuesta) {
                    if(respuesta=='ok'){
                     alert('Termiando');
                    }

                }
            });



            inhabilitacmpos();
        }//de alvar datos

        function accionesespecificas(caso){
            if(caso=="X"){ //cancelar....
                $("#divproveedoresproducto").css("display","block");
            }
            if(caso=="A"){ //aceptar...
                $("#divproveedoresproducto").css("display","block");
            }
            if(caso=="C"){//de crer
                //desaparece la creacion de proveedores, solo sale en los demas casos
                $("#divproveedoresproducto").css("display","none");
            } //De crear
            if(caso=="E"){
                $("#divproveedoresproducto").css("display","block");
            }//Editar
            if(caso=="D"){
                $("#divproveedoresproducto").css("display","block");
            }//Es de habolita / inhablitar
        }//funcikjnes que hacen casos epeciales en

    </script>
<?php
 }
?>

