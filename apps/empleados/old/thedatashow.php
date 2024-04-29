<?php
if( file_exists("../../config/global_config.php")) {
    include("../../config/global_config.php");
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

    $cadena="SELECT id_empleados,nombres,apellidos,fecha_ingreso,fecha_retiro,estado,identificacion,fecha_nacimiento, direccion, telefono, 
        contacto, direccion_alterna,telefono_alterno,tarjeta_profecional,email_empresarial,descripcion_cargo,empresa_temporal,activo, ciudad
             FROM u116753122_cw3completa.empleados
             where id_empleados='".$id."'";


               // echo $cadena;


    $resultadP2=$conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2>=1){
        $filaP2=mysqli_fetch_array($resultadP2);
        $id=trim($filaP2['id_empleados']);
        $nombre=trim($filaP2['nombres']);
        $apellidos=trim($filaP2['apellidos']);
        $fecha_ingreso=trim($filaP2['fecha_ingreso']);
        $fecha_retiro=trim($filaP2['fecha_retiro']);
        $identificacion=trim($filaP2['identificacion']);
        $fecha_nacimiento=trim($filaP2['fecha_nacimiento']);
        $direccion=trim($filaP2['direccion']);
        $telefono=trim($filaP2['telefono']);
        $contacto=trim($filaP2['contacto']);
        $direccion_alterna=trim($filaP2['direccion_alterna']);
        $telefono_alterno=trim($filaP2['telefono_alterno']);
        $tarjeta_profecional=trim($filaP2['tarjeta_profecional']);
        $email_empresarial=trim($filaP2['email_empresarial']);
        $descripcion_cargo=trim($filaP2['descripcion_cargo']);
        $empresa_temporal=trim($filaP2['empresa_temporal']);
        $ciudad=trim($filaP2['ciudad']);
        $activo=trim($filaP2['activo']);
        $estado=trim($filaP2['estado']);
    }
 }else{
    $id="";
    $nombre="";
    $apellidos="";
    $fecha_ingreso="";
    $fecha_retiro="";
    $identificacion="";
    $fecha_nacimiento="";
    $direccion="";
    $telefono="";
    $contacto="";
    $direccion_alterna="";
    $telefono_alterno="";
    $tarjeta_profecional="";
    $email_empresarial="";
    $descripcion_cargo="";
    $empresa_temporal="";
    $ciudad="";
    $activo="";
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
                                
                            
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Cedula:</label>
                                    <input type="input" class="form-control" name="identificacion" id="identificacion" value="<?php echo $identificacion; ?>"></input>
                                </div>
                            
                                <div class="col-md-3 col-lg-3 ">
                                    <img src='assets/image/qr.png'>
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Nombre:</label>
                                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Apellidos:</label>
                                    <input type="input" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>"></input>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Fecha Nacimiento:</label>
                                    <input type="input" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>"><label>dd/mm/aaaa</label></input>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Direccion:</label>
                                    <input type="input" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"></input>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Ciudad:</label>
                                    <input type="input" class="form-control" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>"></input>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Telefono:</label>
                                    <input type="input" class="form-control" name="telefonos" id="telefonos" value="<?php echo $telefono; ?>"></input>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Cargo:</label>
                                    <input type="input" class="form-control" name="descripcion_cargo" id="descripcion_cargo" value="<?php echo $descripcion_cargo; ?>"></input>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Contacto:</label>
                                    <input type="input" class="form-control" name="contacto" id="contacto" value="<?php echo $contacto; ?>"></input>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Direccion Alterna:</label>
                                    <input type="input" class="form-control" name="direccion_alterna" id="direccion_alterna" value="<?php echo $direccion_alterna; ?>"></input>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label style="font-size: 12px;">Telefono Alterno:</label>
                                    <input type="input" class="form-control" name="telefono_alterno" id="telefono_alterno" value="<?php echo $telefono_alterno; ?>"></input>
                                </div>
                            </div>
                        </div>



                        

<?php
 }
 ?>
