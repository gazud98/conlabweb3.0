<?php
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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

// echo __FILE__.'>dd.....<br>';

 //echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
 $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
 if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
 }else{


 include('reglasdenavegacion.php');

 //echo '..............................'.$_REQUEST['id'].'...';

 if(isset($_REQUEST['id']))  {
        $id=$_REQUEST['id'];
    if($id=="-1"){ $id=""; }
  }else{ $id=""; }

    //$id=1;
//    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto="1";//esa ctivo fijo
        $nombre="";
        $estado="1";


    if($id!=""){
        $cadena="select P.id_sedes,P.nombre,P.estado
                    from u116753122_cw3completa.sedes P
                    where P.id_sedes='".$id."'";
//                     echo $cadena;
        $resultadP2=$conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if($numerfiles2>=1){
            $filaP2=mysqli_fetch_array($resultadP2);
            $id=trim($filaP2['id_sedes']);
            $nombre=trim($filaP2['nombre']);
            $estado=trim($filaP2['estado']);
        }
    }

?>

            <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
                 <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
                 <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


                            <div class="row mb-2">
                                <!--<div class="col-md-3 col-lg-3 ">
                                    <?php
//                                       if($id != ""){
//                                            $parametroacodificar="Codigo: ".$id."\nReferencia: ".$referencia."\nNombre: ".$nombre;
//                                             include('../../apps/genqr.php');
//                                        }else {
//                                       echo "<img src='assets/image/qr.png'>";
//                                        }
                                    ?>
                                </div>-->
                                <div class="col-md-9 col-lg-9 ">
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-lg-6 ">
                                                <label style="font-size: 12px;">Codigo:</label>
                                                <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                                                <?php if($estado=='0'){ echo "<span style='color:red;'> Inhabilitado</span>"; } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <label style="font-size: 12px;">Nombre:</label>
                                        <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                                    </div>
                                </div>
                            </div>


                            <!--<div class="row mb-2">
                                <div class="col-md-6 col-lg-6">
                                    <label style="font-size: 12px;">Departamento</label>
                                    <select class="form-control" name="id_departamento" id="id_departamento">
                                       <?php
//                                         $cadena="SELECT id, nombre
//                                                     FROM u116753122_cw3completa.departamentos
//                                                     where estado='1'";
//                                         $resultadP2a=$conetar->query($cadena);
//                                         $numerfiles2a = mysqli_num_rows($resultadP2a);
//                                         if($numerfiles2a>=1){
//                                             while( $filaP2a=mysqli_fetch_array($resultadP2a)){
//                                                 echo "<option value='".trim($filaP2a['id'])."'";
//                                                     if(trim($filaP2a['id'])==$id_departamento){ echo ' selected'; }
//                                                 echo '>'.$filaP2a['nombre']."</option>";
//                                             }
//                                         }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label style="font-size: 12px;">Valor:</label>
                                    <input type="number" class="form-control" name="valor" id="valor" value="<?php echo $valor; ?>"></input>
                                </div>
                            </div>-->



            </form>


<?php
 }
 ?>
