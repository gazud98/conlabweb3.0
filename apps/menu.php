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


    $id_users = $_SESSION['id_users'];

 
       $cadena = "SELECT id_modulos,name,identificacion,
                        descripcion,icono,url,orden
                    FROM u116753122_cw3completa.modulos
                    where estado='1' AND FIND_IN_SET(id_modulos, (
          SELECT GROUP_CONCAT(r.id_modulo) 
          FROM u116753122_cw3completa.roles r 
          JOIN u116753122_cw3completa.users u ON u.id_rol = r.id 
          WHERE u.id_users = '".$id_users."')) > 0
          ORDER BY orden";
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
            echo ' style="" >
                    <a href="#" class="nav-link"  onclick="selectthefile4('  . trim($thefile) . ')" >
                    <input type="input"  name="fileselect4' . $thefile . '" id="fileselect4' . $thefile . '"value="' . $modraiz . '" style="display:none;" >
                        <i class="nav-icon fas ';
            if ($filaP2['icono'] != "") {
                echo $filaP2['icono'];
            } else {
                echo 'fa-caret-right';
            }
            echo '" style="color:#fff;" id="iconitempadre" onclick="openMenu()"></i>
                        <span style="color:#fff;" class="name-item">' . $filaP2['name'] . '
                        </span>
                        <i style="color:#fff;" class="fas fa-angle-left right" id="iconangle"></i>
                    </a>';

            echo '<ul class="nav nav-treeview content-subitems" style="padding:2px 2px 2px 2px;">'; //



            $cadenasublvl1 = "SELECT id_submodulos,idpadre,name,
                                            descripcion,icono,orden
                                        FROM submodulos
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
                    <div class="card collapsed-card mb-2 item-prinp" style="background-color: #6ba2fa;">
                        <div class="card-header" style="padding-left:1px;">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" style="width:100%;text-align:justify;font-size: 12px !important;color:#fff;">
                                <i class="fas fa-plus" style="font-size: 10px;padding:0px;"></i>&nbsp;
                                <?php echo $filaP2a['name']; ?>&nbsp;&nbsp;
                            </button>
                        </div><!-- /.card-header -->


                        <div class="card-body" style="display: none; max-width:90% !important;">
                            <?php
                            //meto el er nivel
                            $cadenasublvl2 = "SELECT id_submodulos,idpadre,name,identificacion,
                                                                    descripcion,icono,url,orden,sctrl1,sctrl2,sctrl3
                                                                FROM  submodulos
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


                                    echo '<li class="nav-item" style="font-size:0.9em; text-align: left; padding: 0px; ">
                                                            <a href="' . $vapara . '" class="nav-link " style="padding:0px;color:#fff;" onclick="closeMenu()">
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

<style>

</style>

<script>
    function selectthefile4(thefile) {

        var theobject = "fileselect4" + thefile;

        var mod = $('input[name="' + theobject + '"]').val();

        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/validate',
            data: {
                mod: mod
            },
            success: function(resp) {

            }
        });

    }
</script>