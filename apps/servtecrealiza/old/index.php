<?php
// echo __FILE__.'>dd.....<br>';
//include("../../config/accesosystems.php");

 //echo $p; //viene con el modulo activo

 // //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
 $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
 if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
 }else{

    $nmbapp="SERVICIOS TECNICOS REALIZADOS";
    $filterwhere="";
    $limiteinf="0";
    $filterfrom="";
  /*  
   //         $limiteinf=$_REQUEST['limiteinf'];
   
    if($limiteinf==""){ $limiteinf=0; }else{ if($limiteinf=="1"){ $limiteinf=0; } }

    if ( true === ( isset( $_REQUEST["filterfrom"] ) ? $_REQUEST["filterfrom"] : null ) ) {
        if($_REQUEST["filterfrom"]!=""){ $filterfrom=$_REQUEST["filterfrom"];}else{ $filterfrom=""; }
    }else{ $filterfrom=""; }
    if ( true === ( isset( $_REQUEST["filterwhere"] ) ? $_REQUEST["filterwhere"] : null ) ) {
        if($_REQUEST["filterwhere"]!=""){ $filterwhere=$_REQUEST["filterwhere"]; }else{ $filterwhere=""; }
    }else{ $filterwhere=""; }
*/


    $cadena="SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.visitas_tecnicas".
                        $filterfrom.
                    " where 1=1".
                        $filterwhere;
             $resultadP2=$conetar->query($cadena);
             $filaP2=mysqli_fetch_array($resultadP2);
             $cantrgt = $filaP2['cantidad'];
;
?>

    <section class="content " style="max-height:90vh;">
        <div class="col-md-12 col-lg-12 mb-9" >
            <div class="card">
                <div class="card-header bg-white" style="height: 35px;">
                    <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong><?php echo $nmbapp; ?></strong> </label>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12" style="max-height:80vh; overflow:hidden; overflow-y:auto;">
                        <div id="thetable" name="thetable"
                            style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                        height:450px;width:auto;"></div><?php //aqui va thedatatable.php //tabla de la app ?>
                        <div class="text-nowrap" id="thenavigation" name="thenavigation"></div><?php // aqui ca la navegacion y filtro btn ?>
                    </div>
                   
                </div>
                <?php include('piepag.php'); //zoan de botornes?>
            </div>

        </div>
    </section>


<?php
include('thefinder.php'); //modal de busqueda personalizado

include('apps/thedata.php');//scriops de control
?>

    <script>
        function habilitacmpos(){
            $("#iddatas").css("pointer-events", "auto");
        }
        function inhabilitacmpos(){
            $("#iddatas").css("pointer-events", "none");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }
        function savedata(){

            inhabilitacmpos();
        }

    </script>
<?php
 }
?>



