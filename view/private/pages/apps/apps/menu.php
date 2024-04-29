                                                                                                              <?php
 include("config/global_config.php");
//echo __FILE__.'>dd.....<br>';
//echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
if ($conetar->connect_errno) {
    $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
}else{


     $cadena="SELECT id_modulos,name,identificacion,
                        descripcion,icono,url,orden
                    FROM desarrollo_access.modulos
                    where estado='1'
                    order by orden";//obligfa en los modulso activos y los permitidos por el usuario
                   // echo $cadena;
    $resultadP2=$conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2>=1){
        while($filaP2=mysqli_fetch_array($resultadP2)){

            echo '<li class="nav-item"  ';
                if($filaP2['descripcion']!=""){ echo ' data-toggle="tooltip" data-html="true" title="'.$filaP2['descripcion'].'"'; }
            echo ' style="border-top:thin dotted #DBD6D6;">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas ';
                    if($filaP2['icono']!=""){ echo $filaP2['icono']; } else { echo 'fa-caret-right'; }
                        echo '" style="color:#967C7C"></i>
                            <p>'.$filaP2['name'].'
                           
                        </p>
                    </a>';

                    echo '<ul class="nav nav-treeview" style="display:none;">';//
                        $cadenasublvl1="SELECT id_submodulos,idpadre,name,
                                            descripcion,icono,orden
                                        FROM desarrollo_access.submodulos
                                        where estado='1'
                                            and id_submodulos=idpadre
                                            AND id_modulos='".$filaP2['id_modulos']."'
                                        order by orden;";
                                       //     echo $cadenasublvl1;
                        $resultadP2a=$conetar->query($cadenasublvl1);
                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                        if($numerfiles2a>=1){


                            while($filaP2a=mysqli_fetch_array($resultadP2a)){


                                ?>
                                <div class="col-md-12 " style="max-width:100%; overflow-wrap: break-word;" >
                                    <div class="callout callout-info" style="color:gray; max-width:100%; padding:0px; padding-left:2px;">
                                        <h5><?php echo $filaP2a['name']; ?></h5>
                                        <?php
                                        //meto el er nivel
                                        $cadenasublvl2="SELECT id_submodulos,idpadre,name,identificacion,
                                                            descripcion,icono,url,orden
                                                        FROM  desarrollo_access.submodulos
                                                        where estado='1'
                                                            and id_submodulos<>idpadre
                                                            and idpadre='".$filaP2a['id_submodulos']."'
                                                        order by orden;";
                                                      //  echo $cadenasublvl2;
                                        $resultadP2b=$conetar->query($cadenasublvl2);
                                        $numerfiles2b = mysqli_num_rows($resultadP2b);
                                        if($numerfiles2b>=1){
                                            while($filaP2b=mysqli_fetch_array($resultadP2b)){
                                                echo '<li class="nav-item" style="color:gray; ">
                                                    <a href="'.$filaP2b['url'].'" class="nav-link" style="padding:0px;">
                                                        <i class="'.$filaP2b['icono'].'"></i>
                                                        <p>'.$filaP2b['name'].'</p>
                                                    </a>
                                                </li>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                echo '</ul>
            </li>';


        }//del whiel de modulos...
    }//de hay regotros en modulos?
?>


<?php
}
?>
