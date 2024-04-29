<?php
if( file_exists("../../config/accesosystems.php")) {
    include("../../config/accesosystems.php");
}
$filterfrom="";
$filterwhere="";
// echo __FILE__.'>dd.....<br>';

 //echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
 $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
 if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
 }else{

    /* */
   // $caso=$_REQUEST['caso'];
   if(isset($_REQUEST['id']))  { 
        $id=$_REQUEST['id'];

    //$id=1;
   // echo $caso.'----'.$id;
    /* */

    $cadena="SELECT id_unidad_medida,id_categoria_umd, nombre,estado,simbolo,factor,redondeo,conversion,cantidad_decimal
             FROM u116753122_cw3completa.unidad_medida
             where id_unidad_medida='".$id."'";


               // echo $cadena;


    $resultadP2=$conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2>=1){
        $filaP2=mysqli_fetch_array($resultadP2);
        $id=trim($filaP2['id_unidad_medida']);
        $id_categoria_umd=trim($filaP2['id_categoria_umd']);
        $nombre=trim($filaP2['nombre']);
        $estado=trim($filaP2['estado']);
        $simbolo=trim($filaP2['simbolo']);
        $factor=trim($filaP2['factor']);
        $redondeo=trim($filaP2['redondeo']);
        $conversion=trim($filaP2['conversion']);
        $cantidad_decimal=trim($filaP2['cantidad_decimal']);
    }
 }else{
    $id="";
    $id_categoria_umd="";
    $nombre="";
    $estado="";
    $simbolo="";
    $factor="";
    $redondeo="";
    $conversion="";
    $cantidad_decimal="";

 }
?>

                        <div class="col-md-12 col-lg-12 p-1" name="iddatas" id="iddatas" style="pointer-events: none;">
                            <div class="row bg-light p-2" name="accionejec" id="accionejec" style="text-align:center; font-weight:bold;display:none"></div><?php //Aqui se esceo lo que va a pasar ?>
                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3 ">
                                        <label style="font-size: 12px;">Codigo:</label>
                                        <input type="input" class="form-control" style="border:thin solid transparent; " disabled name="id" id="id" value="<?php echo $id; ?>"></input>
                                        <?php if($estado=='0'){ echo "<span style='color:red;'> Inhabilitado</span>"; } ?>
                                        
                                </div>
                                <div class="col-md-4 col-lg-4 ">
                                 <label style="font-size: 12px;">Unidad Medida:</label>
                                 <select class="form-control" aria-label="Default select example" name="id_categoria_umd" id="id_categoria_umd">
                                       <?php
                                          $cadena = "SELECT id_categoria_umd, nombre
                                                    FROM u116753122_cw3completa.categoria_umd
                                                    where estado='1'";
                                          $resultadP2a = $conetar->query($cadena);
                                          $numerfiles2a = mysqli_num_rows($resultadP2a);
                                           if ($numerfiles2a >= 1) {
                                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                             echo "<option value='" . trim($filaP2a['id_categoria_umd']) . "'";
                                           if (trim($filaP2a['id_categoria_umd']) == $id_categoria_umd) {
                                             echo ' selected';
                                            }
                                             echo '>' . $filaP2a['nombre'] .  "</option>";
                                             }
                                            }
                                     ?>
                                 </select>
                                </div>
                                <div class="col-md-3 col-lg-3 ">
                                    <img src='assets/image/qr.png'>
                                </div>
                            </div>


                          
                            
                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Simbolo:</label>
                                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $simbolo; ?>"></input>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Factor:</label>
                                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $factor; ?>"></input>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Redondeo:</label>
                                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $redondeo; ?>"></input>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Conversion:</label>
                                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $conversion; ?>"></input>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Cantidad Decimal:</label>
                                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $cantidad_decimal; ?>"></input>
                                </div>
                                
                            </div>

                        </div>



                        

<?php
 }
 ?>
