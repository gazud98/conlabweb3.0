<?php
include("../../config/accesosystems.php");
//echo __FILE__.'>dd.....<br>';
//echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    //vbles que vienen en la forma
    $pageactive = $_REQUEST['p'];
    $caso = $_REQUEST['caso'];
    $id = $_REQUEST['id'];



    //******************************************************************************

/*
    if (!(($caso == "IP") or ($caso == "EP"))) {
        $cadena = "SELECT U.id_unidad_medida,U.nombre, U.estado,C.nombre as nmbcatumd,U.id_categoria_umd,U.simbolo,U.factor,U.redondeo,U.conversion,U.cantidad_decimal
            FROM  desarrollo_laboratorio.unidad_medida U,
            desarrollo_laboratorio.categoria_umd C
            WHERE u.id_unidad_medida='" . $id . "' 
                    and U.id_categoria_umd=C.id_categoria_umd
                        and C.estado=1"; //obligfa al registo señalDO
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_unidad_medida']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
            $estado= ($filaP2['estado']);  
            $nombre = $filaP2['nombre'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
            $nmbcatumd = $filaP2['nmbcatumd'];
            $id_categoria_umd=$filaP2['id_categoria_umd'];
            $simbolo=$filaP2['simbolo'];
            $factor=$filaP2['factor'];
            $redondeo=$filaP2['redondeo'];
            $conversion=$filaP2['conversion'];
            $cantidad_decimal=$filaP2['cantidad_decimal'];
                }
    } //no sale en imporacion/exportacion
*/

?>






    <div class="row" style="width:100%;">
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


       // echo $brrctrl;
        ?>


        <div class="row m-3" style="width:100%;">
            <div class="col-md-12 col-lg-12">
                <?php
                $goto = "app/" . $pageactive . "/crud.php";
                if ($caso == "B") {
                    $goto = "app/" . $pageactive . "/genfiltro.php";
                }
                if (($caso == "IP") or ($caso == "EP")) {
                    $goto = "app/" . $pageactive . "/genimportexport.php";
                }
                ?>

                <form name="formcontrol" id="formcontrol" action="<?php echo $goto; ?>" method="POST" enctype="multipart/form-data" style="width:100%">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="<?php echo $caso; ?>">

                    <div class="row">
                        <?php if (($caso == "IP") or ($caso == "EP")) { ?>
                            <div class="col-md-12 col-lg-12 mb-3">
                                <span style="color:red">Seleccion el boton Guardar para
                                    <?php if ($caso == "IP") {
                                        echo 'Importar';
                                    } else {
                                        echo 'Exportar';
                                    }  ?>
                                    La estructura del Archivo es como se muestra a continuacion:
                                </span>
                                <table class="table table-border table-hover table-sm">
                                    <tr>
                                        <td style="text-align:center;font-weight:bold;">A</td>
                                        <td style="text-align:center;font-weight:bold;">B</td>
                                        <td style="text-align:center;font-weight:bold;">C</td>
                                        <td style="text-align:center;font-weight:bold;">D</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">id</td>
                                        <td style="text-align:center;">Nombre</td>
                                        <td style="text-align:center;">Estado</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-12 col-lg-12 mb-3">
                                <label for="email" class="form-label">Escoja Archivo <span style="color:red">*</span></label>
                                <input type="file" class="form-control " name="dataCliente" id="file-input" placeholder="file" required>
                            </div>

                        <?php } else { ?>

                            <div class="col-md-12 col-lg-12 mb-9" style="width:100%; ">
                                <div class="row">

                                      <div class="col-md-6 col-lg-6 mb-3">




                                        <?php if ($caso != "B") { ?>
                                            <label for="active" class="form-label">Estado <span style="color:red">*</span></label>
                                            <select class="form-control <?php if (($caso == "V") or ($caso == "D")) {
                                                                            echo "noeditable";
                                                                        } ?> " id="estado" name="estado">
                                                <option value="1" <?php if ($estado == "1") {
                                                                        echo 'selected';
                                                                    } ?>>Activo</option>
                                                <option value="0" <?php if ($estado == "0") {
                                                                        echo 'selected';
                                                                    } ?>>Inactivo</option>
                                            </select>

                                            <hr>
                                        <?php   } ?>





                                    </div>
                                    
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="input" class="form-label">Categoria Unidad Medida <span style="color:red">*</span></label>
                                        <select class="form-control <?php if (($caso == "V") or ($caso == "D")) {
                                                                            echo "noeditable";
                                                                        } ?> " id="nombrecat" name="nombrecat">
<?php
                                        $cadenaA = "SELECT C.id_categoria_umd, C.nombre 
                                                    FROM  desarrollo_laboratorio.categoria_umd C
                                                    WHERE C.estado=1"; //obligfa al registo señalDO
                                            $resultadP2A = $conetar->query($cadenaA);
                                            $numerfiles2A = mysqli_num_rows($resultadP2A);
                                            if ($numerfiles2A >= 1) {
                                                WHILE($filaP2A = mysqli_fetch_array($resultadP2A)) {
                                                    $id_categoria_umd2 = trim($filaP2A['id_categoria_umd']); 
                                                    $nombrecategoria = trim($filaP2A['nombre']); 
                                                    echo '<option id="'.$id_categoria_umd.'" ';
                                                         if ($id_categoria_umd2 == $id_categoria_umd) {
                                                                echo 'selected';
                                                            } 
                                                    echo '>'.$nombrecategoria.'</option>';
                                                }
                                            }
?>                                              
                                        </select>

                                    </div>


                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="input" class="form-label">Nombre <span style="color:red">*</span></label>
                                        <input type="input" class="form-control <?php if (($caso == "V") or ($caso == "D")) {
                                                                                    echo "noeditable";
                                                                                } ?> " id="nombre" name="nombre" value="<?php echo $nombre; ?>" <?php if ($caso != "B") { ?> required <?php } ?>>
                                    </div>

                                          
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="input" class="form-label">Simbolo <span style="color:red">*</span></label>
                                        <input type="input" class="form-control <?php if (($caso == "V") or ($caso == "D")) {
                                                                                    echo "noeditable";
                                                                                } ?> " id="simbolo" name="simbolo" value="<?php echo $simbolo; ?>" <?php if ($caso != "B") { ?> required <?php } ?>>
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="input" class="form-label">Factor <span style="color:red">*</span></label>
                                        <input type="input" class="form-control <?php if (($caso == "V") or ($caso == "D")) {
                                                                                    echo "noeditable";
                                                                                } ?> " id="factor" name="factor" value="<?php echo $factor; ?>" <?php if ($caso != "B") { ?> required <?php } ?>>
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="input" class="form-label">Redondeo <span style="color:red">*</span></label>
                                        <input type="input" class="form-control <?php if (($caso == "V") or ($caso == "D")) {
                                                                                    echo "noeditable";
                                                                                } ?> " id="redondeo" name="redondeo" value="<?php echo $redondeo; ?>" <?php if ($caso != "B") { ?> required <?php } ?>>
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="input" class="form-label">Conversion <span style="color:red">*</span></label>
                                        <input type="input" class="form-control <?php if (($caso == "V") or ($caso == "D")) {
                                                                                    echo "noeditable";
                                                                                } ?> " id="conversion" name="conversion" value="<?php echo $conversion; ?>" <?php if ($caso != "B") { ?> required <?php } ?>>
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="input" class="form-label">Cantidad Decimal <span style="color:red">*</span></label>
                                        <input type="input" class="form-control <?php if (($caso == "V") or ($caso == "D")) {
                                                                                    echo "noeditable";
                                                                                } ?> " id="cantidad_decimal" name="cantidad_decimal" value="<?php echo $cantidad_decimal; ?>" <?php if ($caso != "B") { ?> required <?php } ?>>
                                    </div>



                                </div>

                            </div>

                        <?php } ?>
                    </div>

                </form>
            </div>
        </div>

        <?php
        //echo $brrctrl;
        ?>
    </div>



    <script>
        function clicksendfrm() {
            <?php if ($caso != "D") { ?>
                if ($("#formcontrol").validate()) {
                    $('#formcontrol').submit();
                }
            <?php
            } else {
            ?>
                $('#formcontrol').submit();
            <?php } ?>
        }
    </script>







<?php
    /* ***************************************************************************** */
}
?>
