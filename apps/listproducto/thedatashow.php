<?php


if (file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {




    include('reglasdenavegacion.php');
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = "";
    }
    /* */
    // $caso=$_REQUEST['caso'];
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        //$id=1;
        // echo $caso.'----'.$id;
        /* */

        $cadena = "select id_producto,id_categoria_producto
                from u116753122_cw3completa.producto
                where id_producto='" . $id . "'";
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = trim($filaP2['id_categoria_producto']);
        }
    } else {
        $id = "";
        $id_categoria_producto = "";
    }

?>
    <div class=" bg-light col-md-12 col-lg-12 p-2" name="accionejec" id="accionejec" style="pointer-events: none; text-align:center; font-weight:bold;display:none; background-color:#ededed; "></div><?php //Aqui se esceo lo que va a pasar 
                                                                                                                                                                                                        ?>

    <div class="col-md-12 col-lg-12 p-3" name="iddatas" id="iddatas" style="
    pointer-events: 
    none;background-color:#ededed;">
        <div class="row mb-2">
            <div class="col-md-12 col-lg-12" style=" border-bottom:thin solid gray; padding-bottom:3px; margin-bottom:5px;">
                <?php //muesta ao no la seccionde tipo de procuto o serviio a utitrizar
                if ($sctrl1 != "0") {
                    echo '<input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="0" >';
                } else {
                ?>
                    <label style="font-size: 12px;">Tipo</label>
                    <select class="form-control" aria-label="Default select example" name="id_categoria_producto" id="id_categoria_producto" onclick="cargarcasoesperado();">
                        <?php
                        $cadena = "SELECT id_categoria_producto, nombre
                                                FROM u116753122_cw3completa.categoria_producto
                                                where estado='1'";
                        if ($sctrl1 != "0") {
                            $cadena = $cadena . " and id_categoria_producto='" . $sctrl1 . "'";
                        } //obliga que sea solo el caso de tipo especidifo
                        //echo $cadena;
                        $resultadP2a = $conetar->query($cadena);
                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                        if ($numerfiles2a >= 1) {
                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                echo "<option value='" . trim($filaP2a['id_categoria_producto']) . "'";
                                if (trim($filaP2a['id_categoria_producto']) == $id_categoria_producto) {
                                    echo ' selected';
                                }
                                echo '>' . $filaP2a['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                <?php
                } ?>

            </div>
        </div>

        <div class="row" name="casoesperado" id="casoesperado"><?php include('datacase' . $sctrl1 . '.php');  //campos de la app 
                                                                ?></div><?php //aqui va el caso a mostrar segun seleccion del caso encontrado 
                                                                                                                                        ?>
    </div>



    <script>
        function cargarcasoesperado() {
            <?php
            if ($sctrl1 != "0") {
            ?>
                var casox = <?php echo $sctrl1;  ?> //es un defalut
            <?php
            } else {
            ?>
                var casox = $("#id_categoria_producto").val();
            <?php
            } //busca siemtpe ponerse en productos si exisr eerror

            if ($id == "") {
                $id = "-1";
            } //no viene anda lo pongo en babco enla otra pantalla todos los campos y lo pogo de color inhabilitado
            ?>


            $("#casoesperado").load('<?php echo 'apps/' . $p . '/datacase'; ?>' + casox + '<?php echo '.php'; ?>', {
                p: "<?php echo $p; ?>",
                id: <?php echo $id; ?>,
                iduser: <?php echo $iduser; ?>,
                limiteinf: <?php echo $limiteinf; ?>,
                limitinpantalla: <?php echo limitinpantalla; ?>,
                
                sctrl1: <?php echo $sctrl1; ?>,
                sctrl2: <?php echo $sctrl2; ?>,
                sctrl3: <?php echo $sctrl3; ?>,
                sctrl4: <?php echo $sctrl4; ?>,
                sctrl5: <?php echo $sctrl5; ?>,
                sctrl6: <?php echo $sctrl6; ?>
            });
        }


        cargarcasoesperado(); //Ejecuacin automaica
    </script>



<?php
}
?>