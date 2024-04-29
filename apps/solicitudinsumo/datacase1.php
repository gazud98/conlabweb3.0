<?php
//si hay consulta
//     presntadio n par todos los departamento

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
        $codigo	="";
        $id_centro_costo="";
        $id_empleado="";
        $predeterminada="";
        $estado="";


    if($id!=""){
        $cadena="select id,codigo,id_centro_costo,nombre,id_empleado,estado,predeterminada
                    from u116753122_cw3completa.bodegas
                    where id='".$id."'";
//                     echo $cadena;
        $resultadP2=$conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if($numerfiles2>=1){
            $filaP2=mysqli_fetch_array($resultadP2);
            $id=trim($filaP2['id']);
            $nombre=trim($filaP2['nombre']);
            $estado=trim($filaP2['estado']);
            $codigo=trim($filaP2['codigo']);
            $id_centro_costo=trim($filaP2['id_centro_costo']);
            $id_empleado=trim($filaP2['id_empleado']);
            $predeterminada=trim($filaP2['predeterminada']);
        }
    }

?>

            <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
                 <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
                 <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


                            <div class="row mb-2">

                                <div class="col-md-12 col-lg-12 ">
                                    <div class="row mb-2">
                                        <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Codigo:</label>
                                                <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                                                <?php if($estado=='0'){ echo "<span style='color:red;'> Inhabilitado</span>"; } ?>
                                        </div>
                                        <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Codigo:</label>
                                                <input type="input" class="form-control" style="border:thin solid transparent; " name="codigo" id="codigo" value="<?php echo $codigo; ?>"></input>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                                <label style="font-size: 12px;">Es Predeterminada</label>
                                                <select class="form-control" name="predeterminada" id="predeterminada">
                                                <?php
                                                    echo "<option value='0'";
                                                                if('0'==$predeterminada){ echo ' selected'; }
                                                            echo '>NO</option>';
                                                    echo "<option value='1'";
                                                                if('1'==$predeterminada){ echo ' selected'; }
                                                            echo '>SI</option>';
                                                    ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <label style="font-size: 12px;">Nombre:</label>
                                        <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                                    </div>
                                </div>
                            </div>




                            <div class="row mb-2">
                                <div class="col-md-12 col-lg-12">
                                    <label style="font-size: 12px;">Centro Costos</label>
                                    <select class="form-control" name="id_centro_costo" id="id_centro_costo">
                                       <?php
                                        $cadena="SELECT id, nombre
                                                    FROM u116753122_cw3completa.centro_costos
                                                    where estado='1'";
                                        $resultadP2a=$conetar->query($cadena);
                                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                                        if($numerfiles2a>=1){
                                            while( $filaP2a=mysqli_fetch_array($resultadP2a)){
                                                echo "<option value='".trim($filaP2a['id'])."'";
                                                    if(trim($filaP2a['id'])==$id_centro_costo){ echo ' selected'; }
                                                echo '>'.$filaP2a['nombre']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12 col-lg-12">
                                    <label style="font-size: 12px;">Responsable</label>
                                    <select class="form-control" name="id_empleado" id="id_empleado">
                                       <?php
                                        $cadena="SELECT id_persona,nombre_1,nombre_2,apellido_1,apellido_2
                                                    FROM u116753122_cw3completa.persona
                                                    where estado='1'
                                                        and id_cw2_empleados='1'";
                                        $resultadP2a=$conetar->query($cadena);
                                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                                        if($numerfiles2a>=1){
                                            while( $filaP2a=mysqli_fetch_array($resultadP2a)){
                                                echo "<option value='".trim($filaP2a['id_persona'])."'";
                                                    if(trim($filaP2a['id_persona'])==$id_empleado){ echo ' selected'; }
                                                echo '>'.$filaP2a['nombre_1']." ".
                                                        $filaP2a['nombre_2']." ".
                                                        $filaP2a['apellido_1']." ".
                                                        $filaP2a['apellido_2']." "."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


            </form>


<?php
 }
 ?>
