<?php
// echo __FILE__.'>dd.....<br>';
//include("../../config/global_config.php");

 //echo $p; //viene con el modulo activo

 // //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
 $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
 if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
 }else{

    $nmbapp="SEDES";
    $filterwhere="";
    $limiteinf="1";
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
                    FROM  u116753122_cw3completa.productos".
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
                    <div class="col-md-5 col-lg-5" style="max-height:80vh; overflow:hidden; overflow-y:auto;">
                        <div id="thetable" name="thetable"
                            style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                        height:450px;width:auto;"></div><?php //aqui va thedatatable.php //tabla de la app ?>
                        <div class="text-nowrap" id="thenavigation" name="thenavigation"></div><?php // aqui ca la navegacion y filtro btn ?>
                    </div>
                    <div class="col-md-7 col-lg-7" style="max-height:80vh; overflow:hidden; overflow-y:auto;" name="divappshow" id="divappshow">
                        <?php include('thedatashow.php');  //campos de la app ?>
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











































<!-- SE OMITE CREAR UN ARCHIVO CSS YA QUE EL DISEÑO ERA SENCILLO-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conlab Web V3.0</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>



    <section class="content " style="padding: 1% 0% 0% 5%;">

        <div class="col-md-12 col-lg-12 mb-9" style="width:95%;">

            <div class="card">
                <div class="card-header bg-white">
                    <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong> CREACIÓN DE SEDES</strong> </label>
                </div>
                <div class="row">
                    <div class="col-md-7 col-lg-7">
                        <!-- DISEÑO TABLA-->
                        <div style=" overflow-y:scroll; height:300px;width:auto;padding:8px;">
                            <table class="table table-hover">
                                <thead>
                                    <tr style="background-color: rgb(1,103,183);color:white;" height="4">

                                        <th style="font-size: 12px;">Codigo</th>
                                        <th style="font-size: 12px;">Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="font-size: 12px;">

                                        <td>31</td>
                                        <td>Sede Principal</td>
                                    </tr>
                                    <tr style="font-size: 12px;">

                                        <td>28</td>
                                        <td>Sede VIP</td>
                                    </tr>
                                    <tr style="font-size: 12px;">

                                        <td>28</td>
                                        <td>Sede Centro</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                     <!--......-->
                    <div class="col-md-5 col-lg-5">

                        <div class="col-md-12 col-lg-12">
                            <label style="color: rgb(1,103,183);font-size: 13px;"><strong>Creación</strong></label>
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 13px;">Codigo:</label>

                                </div>
                                <div class="col-md-8 col-lg-8">
                                    <input type="input" class="form-control" style="width: 88px; height: 28px;font-size: 12px;"></input>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-lg-3 mt-1">
                                    <label style="font-size: 13px;">Descripción:</label>

                                </div>
                                <div class="col-md-8 col-lg-8 mt-1">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>
                            </div>

                            <div class="row">
                                <label style="color: rgb(1,103,183);font-size: 13px;"><strong>Búsqueda</strong></label>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 13px;">Codigo:</label>

                                </div>
                                <div class="col-md-8 col-lg-8">
                                    <input type="input" class="form-control" style="width: 88px; height: 28px;font-size: 12px;"></input>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-lg-3 mt-1">
                                    <label style="font-size: 13px;">Descripción:</label>

                                </div>
                                <div class="col-md-8 col-lg-8 mt-1">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>
                            </div>

                            <div class="row" style="padding-left:100px; width: 90px;">
                                <div class="col-md-12 col-lg-12 mt-1">
                                    <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;" disabled>Buscar</button>
                                </div>

                            </div>

                        </div>



                    </div>
                    <!--FOOTER -->
                    <div style="text-align: center; margin:20px 0px 5px 0px;">
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;">Nuevo</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px; ">Borrar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;">Modificar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px; " disabled>Grabar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;" disabled>Cancelar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px; ">Salir</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </div>


                </div>
            </div>
        </div>
    </section>




</body>

</html>
