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

// echo __FILE__.'>dd.....<br>';
// echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {



    $cadena = "SELECT id_modulos,name,identificacion,
                        descripcion,icono,url,orden
                    FROM u116753122_cw3completa.modulos
                    where estado='1'
                    order by orden"; //obligfa en los modulso activos y los permitidos por el usuario
    //echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $thefile = 0;
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $thefile = $thefile + 1;

            $modraiz = $filaP2['name'];
            echo '<li class="nav-item mb-2"  ';
            if ($filaP2['descripcion'] != "") {
                echo ' data-toggle="tooltip" data-html="true" title="' . $filaP2['descripcion'] . '"';
            }
            echo ' style="border-top:thin dotted #DBD6D6;">
                    <a href="#" class="nav-link"  onclick="selectthefile4('  . trim($thefile) . ')" >
                    <input type="input"  name="fileselect4' . $thefile . '" id="fileselect4' . $thefile . '"value="' . $modraiz . '" style="display:none;" >
                        <i class="nav-icon fas ';
            if ($filaP2['icono'] != "") {
                echo $filaP2['icono'];
            } else {
                echo 'fa-caret-right';
            }
            echo '" style="color:#967C7C"></i>
                            <p>' . $filaP2['name'] . '
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>';

            echo '<ul class="nav nav-treeview" style="display:none; background:#dee3ea; padding:2px 2px 2px 2px;">'; //



            $cadenasublvl1 = "SELECT id_submodulos,idpadre,name,
                                            descripcion,icono,orden
                                        FROM u116753122_cw3completa.submodulos
                                        where estado='1'
                                            and id_submodulos=idpadre
                                            AND id_modulos='" . $filaP2['id_modulos'] . "'
                                        order by orden;";
            //     echo $cadenasublvl1;
            $resultadP2a = $conetar->query($cadenasublvl1);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
?>
                    <div class="card card-primary collapsed-card mb-2">
                        <div class="card-header" style="padding-left:1px;">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" style="width:100%;text-align:justify;">
                                <i class="fas fa-plus" style="float:left"></i>&nbsp;&nbsp;
                                <?php echo $filaP2a['name']; ?>&nbsp;&nbsp;
                            </button>
                        </div><!-- /.card-header -->


                        <div class="card-body" style="display: none; max-width:90% !important; ">
                            <?php
                            //meto el er nivel
                            $cadenasublvl2 = "SELECT id_submodulos,idpadre,name,identificacion,
                                                                    descripcion,icono,url,orden,sctrl1,sctrl2,sctrl3
                                                                FROM  u116753122_cw3completa.submodulos
                                                                where estado='1'
                                                                    and id_submodulos<>idpadre
                                                                    and idpadre='" . $filaP2a['id_submodulos'] . "'
                                                                order by orden;";
                            //  echo $cadenasublvl2;
                            $resultadP2b = $conetar->query($cadenasublvl2);
                            $numerfiles2b = mysqli_num_rows($resultadP2b);
                            if ($numerfiles2b >= 1) {
                                while ($filaP2b = mysqli_fetch_array($resultadP2b)) {

                                    if ($filaP2b['url'] == "") {
                                        $vapara = "?c=default&prg=" . $filaP2b['identificacion'];
                                        $vapara = $vapara . "&sctrl1=" . $filaP2b['sctrl1'];
                                        $vapara = $vapara . "&sctrl2=" . $filaP2b['sctrl2'];
                                        $vapara = $vapara . "&sctrl3=" . $filaP2b['sctrl3'];
                                    } else {
                                        $vapara = "?c=" . $filaP2b['url'];
                                    }


                                    echo '<li class="nav-item" style="color:gray; font-size:0.9em;">
                                                            <a href="' . $vapara . '" class="nav-link" style="padding:0px;">
                                                                <i class="' . $filaP2b['icono'] . '"></i>&nbsp;
                                                                <p>' . $filaP2b['name'] . '</p>
                                                            </a>
                                                        </li>';
                                }
                            }
                            ?>

                        </div>
                    </div><!-- /.card-body -->
    <?php
                }
            }
            echo '</ul>
            </li>';
        } //del whiel de modulos...
    } //de hay regotros en modulos?
    ?>


<?php
}
?>

<script>
    function selectthefile4(thefile) {

        var theobject = "fileselect4" + thefile;

        var mod = $('input[name="' + theobject + '"]').val();

        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/validate',
            data: {
                mod: mod
            },
            success: function(resp) {

            }
        });


    }
</script>