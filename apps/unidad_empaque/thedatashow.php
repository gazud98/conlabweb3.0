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

    $cadena="SELECT id_unidad_empaque,nombre,estado
             FROM u116753122_cw3completa.unidad_empaque
             where id_unidad_empaque='".$id."'";


               // echo $cadena;


    $resultadP2=$conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2>=1){
        $filaP2=mysqli_fetch_array($resultadP2);
        $id=trim($filaP2['id_unidad_empaque']);
        $nombre=trim($filaP2['nombre']);
        $estado=trim($filaP2['estado']);
    }
 }else{
    $id="";
    $nombre="";
    $estado="";


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
                                <div class="col-md-3 col-lg-3 ">
                                    <img src='assets/image/qr.png'>
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-md-6 col-lg-6">
                                    <label style="font-size: 12px;">Nombre:</label>
                                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                                </div>
                            </div>

                         

                        </div>



                        

<?php
 }
 ?>
