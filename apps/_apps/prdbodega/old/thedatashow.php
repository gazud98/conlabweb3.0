<?php
 include("../../config/accesosystems.php");
//echo __FILE__.'>dd.....<br>';
//echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
if ($conetar->connect_errno) {
    $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
}else{

    //vbles que vienen en la forma
    $pageactive=$_REQUEST['p'];
    $caso=$_REQUEST['caso'];
    $id=$_REQUEST['id'];



//******************************************************************************


if(!(($caso=="IP")or($caso=="EP"))){
    $cadena="SELECT id, nombre,estado
            FROM  desarrollo_access.departamentos
            WHERE id='".$id."'";//obligfa al registo señalDO
    $resultadP2=$conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2>=1){
        $filaP2=mysqli_fetch_array($resultadP2);
        $id=trim($filaP2['id']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
        $nombre=$filaP2['nombre'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
        $estado=$filaP2['estado'];
    }
}//no sale en imporacion/exportacion


?>



<div class="row bg-light " style=" min-width:100% ; width:100% !important; ">


    <div class="col-md-12 col-xs-12 m-3 " style="width:100%; !important ">
        <div class="col-md-12 col-lg-12" style="width:100%; ">

            <?php
                $goto="app/". $pageactive."/crud.php";
                if($caso=="B") {
                    $goto="app/".$pageactive."/genfiltro.php";
                }
                if(($caso=="IP")or($caso=="EP")){
                    $goto="app/".$pageactive."/genimportexport.php";
                }
            ?>

            <form name="formcontrol" id="formcontrol"  action="<?php echo $goto; ?>"  method="POST" enctype="multipart/form-data"  style="width:100%">
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="<?php echo $caso; ?>">



                    <div class="row  card-body" style="width:100%">
                        <div class="col-md-3 col-xs-12">
                            <div class="row">
                                <div class="col-md-3 col-xs-6">
                                    <img src="assets/image/qr.png">
                                </div>
                                <div class="col-md-9 col-xs-6">
                                    <table style="font-size:0.7em; width:100%">
                                        <tr ><td>Bodega</td></tr>
                                        <tr><td style="font-weight:bold;">Principal</td></tr>
                                        <tr ><td>Codigo</td></tr>
                                        <tr><td style="font-weight:bold;">0000001</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="row">
                                <div class="col-md-3 col-xs-6">
                                    <img src="assets/image/qr.png">
                                </div>
                                <div class="col-md-9 col-xs-6">
                                    <table style="font-size:0.7em; width:100%">
                                        <tr ><td>Producto</td></tr>
                                        <tr><td style="font-weight:bold;">0000001</td></tr>
                                        <tr ><td>Codigo</td></tr>
                                        <tr><td style="font-weight:bold;">0000002</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>



                    <div class="container" style="width:100%">


                        <div class="col-md-12 col-lg-12 mb-3">
                            <label for="Categorias" class="form-label">Categorias<span style="color:red">*</span></label>


                            <div class="card-body table-responsive p-0" style="height: 200px;">
                                <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                    <th>Cantidad Disponible</th>
                                    <th>Alerta de Stock</th>
                                    <th>Ubicacion</th>
                                    <th>Movimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td><?php echo Rand(10,100); ?></td>
                                    <td><?php echo Rand(30,40); ?></td>
                                    <td>Bodega X<br>Stang: 10<br>Entrepaño: 3<br>Caja: 2</td>
                                    <td>Traslado</td>
                                    </tr>
                                    <tr>
                                    <td><?php echo Rand(10,100); ?></td>
                                    <td><?php echo Rand(30,40); ?></td>
                                    <td>Bodega X<br>Stang: 10<br>Entrepaño: 3<br>Caja: 2</td>
                                    <td>Ajuste</td>
                                    </tr>
                                    <tr>
                                    <td><?php echo Rand(10,100); ?></td>
                                    <td><?php echo Rand(30,40); ?></td>
                                    <td>Bodega X<br>Stang: 10<br>Entrepaño: 3<br>Caja: 2</td>
                                    <td>Entrega de Productos</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>


                        </div>


                    </div>



            </form>


        </div>
    </div>

</div>




<?php
/*
<div class="col-md-12" style="min-width:100% ; width:100% !important; border:thin solid green">
 <?php
        $brrctrl = '<section id="component-footer col-md-12 col-xs-12" style="width:100%">
                    <footer class="footer bg-light">
                        <div class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
                        <div style="col-md-6">';
        if ($caso == "V") {
            $brrctrl = $brrctrl . 'Modo Vision';
        }
        if ($caso == "B") {
            $brrctrl = $brrctrl . 'Modo Filtro';
        }
        if ($caso == "C") {
            $brrctrl = $brrctrl . 'Modo Creacion';
        }
        if ($caso == "E") {
            $brrctrl = $brrctrl . 'Modo Edicion';
        }
        if ($caso == "D") {
            $brrctrl = $brrctrl . '<span style="color :red">Precaucion: Al seleccionar el boton "salvar", El registro queda marcado como inactivo.</span>';
        }
        if ($caso == "IP") {
            $brrctrl = $brrctrl . 'Modo Importacion';
        }
        if ($caso == "EP") {
            $brrctrl = $brrctrl . 'Modo Exportacion';
        }
        $brrctrl = $brrctrl . '</div>

                        <div style="col-md-6">';
        if ($caso != "V") {
            $brrctrl = $brrctrl . '<div  name="btnsend" id="btnsend"
                                    class="btn btn-sm btn-outline-success" onclick="clicksendfrm()"><i class="bx bx-log-out-circle"></i> ';
            if ($caso != "B") {
                $brrctrl = $brrctrl . 'Guardar';
            } else {
                $brrctrl = $brrctrl . 'Aplicar Filtro';
            }
            $brrctrl = $brrctrl . '</div>';
        }


        $brrctrl = $brrctrl . '<form action="index.php" method="post"
                                name="frmuser" id="frmuser"
                                enctype="multipart/form-data" target="_top">
                                <input type="hidden" name="p" id="p" value="' . $pageactive . '">
                                <input type="submit" class="btn btn-sm btn-outline-danger"
                                value=" Cancelar">
                        </form>


                        </div>
                        </div>
                    </footer>
                </section>';


        echo $brrctrl;
        ?>
</div>
*/
?>

<script>
    function clicksendfrm(){
         <?php if($caso!="D") { ?>
            if($("#formcontrol").validate() ) {
                 $('#formcontrol').submit();
            }
        <?php
            }else{
        ?>
            $('#formcontrol').submit();
        <?php } ?>
    }
</script>







<?php
/* ***************************************************************************** */
}
?>
