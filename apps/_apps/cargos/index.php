<?php
//Si bahy consulta

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
     $nmbapp="CARGOS";

//echo ".................".$sctrl4."-----------";
    $cadena="SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.cargos".
                        $filterfrom.
                    " where 1=1";
             $cadena=$cadena.$filterwhere;
//              echo $cadena;
             $resultadP2=$conetar->query($cadena);
             $filaP2=mysqli_fetch_array($resultadP2);
             $cantrgt = $filaP2['cantidad'];
;
?>

            <div class="card border-info">

                <div class="card-header bg-light " style="">
                    <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong><?php echo $nmbapp; ?></strong> </label>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 col-lg-5" style="overflow:hidden; overflow-y:auto;">
                            <div id="thetable" name="thetable"
                                style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                            height:450px;width:auto;"></div><?php //aqui va thedatatable.php //tabla de la app ?>
                            <div class="text-nowrap" id="thenavigation" name="thenavigation"></div><?php // aqui ca la navegacion y filtro btn ?>
                        </div>
                        <div class="col-md-7 col-lg-7" style="overflow:hidden; overflow-y:auto;" name="divappshow" id="divappshow">
                            <?php include('thedatashow.php');  //campos de la app ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <?php include('piepag.php'); //zoan de botornes?>
                </div>
            </div>

<?php
include('thefinder.php'); //modal de busqueda personalizado

include('apps/thedata.php');//scriops de control
?>

    <script>
        function habilitacmpos(){
            $("#iddatas").css("pointer-events", "auto");
            $("#iddatas").css("background-color","white");
        }
        function inhabilitacmpos(){
            $("#iddatas").css("pointer-events", "none");
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
//                     alert('Termiando');
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

