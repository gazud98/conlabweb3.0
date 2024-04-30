<?php
//SI POOSEE CONSULTA

if (file_exists("config/global_config.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/global_config.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/global_config.php")) {
            include("../../config/accesosystems.php");
        }
    }
}



// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $cadena23 = "SELECT count(id) as max
    FROM u116753122_cw3completa.ordrequisicion";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }

    include('reglasdenavegacion.php');

    // echo '..............................';

?>
    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="tb">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Descripcion</th>
                <th>Responsable</th>
                <th>Fecha Inicio</th>
                <th>Cada Cuanto</th>
                <th>Resultado</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /* */
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT a.id,a.evento, a.f_inicio,a.periodicidad,a.estru_periord,a.descripcion,a.observacion,d.nombre_1,d.nombre_2,d.apellido_1,d.apellido_2,a.id_proveedor,a.estado
               FROM  u116753122_cw3completa.eventos a, u116753122_cw3completa.evento_detalle_actfijo b,u116753122_cw3completa.proveedores c,u116753122_cw3completa.persona d 
               where c.id_proveedores = a.id_proveedor and  d.id_persona = a.id_responsable and a.id=b.id_evento"  . $filterwhere;
            $cadena = $cadena . " order by 1
                    Limit " . $limiteinf . "," . $limitinpantalla;
            //                      echo $cadena;
            /* */
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id = $filaP2['id'];
                    $evento = $filaP2['evento'];
                    $nombre_persona = $filaP2['nombre_1'] . " " . $filaP2['nombre_2'] . " " . $filaP2['apellido_1'] . " " . $filaP2['apellido_2'];
                    $f_inicio = $filaP2['f_inicio'];
                    $periodicidad = $filaP2['periodicidad'];
                    $estru_periord = $filaP2['estru_periord'];
                    $descripcion = $filaP2['descripcion'];
                    $id_proveedor = $filaP2['id_proveedor'];
                    $observacion = $filaP2['observacion'];
                    $descripcion = $filaP2['descripcion'];
                    $estado = $filaP2['estado'];
                    $thefile = $thefile + 1;
                    $dias = "";
                    if ($periodicidad == 'S') {
                        $array = explode(",", $estru_periord);
                        $length = count($array);
                        $dias = "";
                        for ($i = 0; $i < $length; ++$i) {
                            if ($array[$i] <> 'N') {
                                if ($array[$i] == 'D') {
                                    $dias = $dias . "Domingo" . ", ";
                                }
                                if ($array[$i] == 'L') {
                                    $dias = $dias . "Lunes" . ", ";
                                }
                                if ($array[$i] == 'M') {
                                    $dias = $dias . "Martes" . ", ";
                                }
                                if ($array[$i] == 'X') {
                                    $dias = $dias . "Miercoles" . ", ";
                                }
                                if ($array[$i] == 'J') {
                                    $dias = $dias . "Jueves" . ", ";
                                }
                                if ($array[$i] == 'V') {
                                    $dias = $dias . "Viernes" . ", ";
                                }
                                if ($array[$i] == 'S') {
                                    $dias = $dias . "Sabado" . ", ";
                                }
                            }
                        }
                    } elseif ($periodicidad == 'M') {
                        if ($estru_periord = 'CPS') {
                            $dias = 'Cada Primer Sabado';
                        } elseif ($estru_periord = 'CPL') {
                            $dias = 'Cada Primer Lunes';
                        }
                    }

                    if ($estado == 1) {
                        $color = 'green';
                    } elseif ($estado == 0) {
                        $color = 'red';
                    }
                    if ($estado == 1) {
                        $estado_evento = 'Abierto';
                    } elseif ($estado == 0) {
                        $estado_evento = 'Cerrado';
                    }

                    if ($estado == 0) {
                        $disable = 'disabled';
                    }else{
                        $disable = '';
                    }

                    echo '<tr  id="col' . $thefile . '"';
                    echo '"';
                    echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '"';
                    echo '>';



                    echo '<td style="font-size:0.8rem;"';
                    echo 'id="celda"';

                    echo '>';
                    echo '<input type="radio"  name="fileselect' . $thefile . '" id="fileselect' . $thefile . '"  value="' . $id . '"   estado="' . $estado . '"    style="display:none;" >';
                    echo $evento;

                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo 'id="celda"';
                    echo '  style="cursor:pointer;"';

                    echo '>';
                    echo $descripcion;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo 'id="celda"';
                    echo '  style="cursor:pointer;"';

                    echo '>';
                    echo $nombre_persona;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';

                    echo '>';
                    echo $f_inicio;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';

                    echo '>';
                    echo $dias;
                    echo '</td>';




                    echo '<td style="font-size:0.8rem;"';

                    echo '>';
                    echo $observacion;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;color:' . $color . '"';

                    echo '>';
                    echo $estado_evento;
                    echo '</td>';




                    echo '<td style="font-size:0.8rem;"';
                    echo '>';
                    echo '<button type="button" class="btn btn-primary btn-xs" onclick="enviarDatos(' . $id . ');" data-toggle="modal"  data-target="#event" ' . $disable . '>Terminar Evento</button>';
                    echo '</td>';


                    echo '</tr>';
                }
            }
            /**/
            ?>

        </tbody>
    </table>
    <div class="modal fade" id="event">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->

                <div class="modal-header" style="background-color: rgb(22,64,133);color:white;">
                    <h5 style="text-align:center;"><strong>Terminar Evento</strong></h5>
                    <button type="button" class="close" style="color:white" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body" id="modalshow" name="modalshow">
                    <div id="mdlevent">
                        <?php include("modal.php") ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="acep" onclick="terminarEvento();" data-dismiss="modal">Cerrar Evento</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} /**/
?>

<script>
    function enviarDatos(id, estado) {



        $("#mdlevent").load('/cw3/conlabweb3.0/apps/registrodeeventos/modal.php', {
            id: id
        });




    }

    function selectthefile(thefile, id) {

        var theobject = "fileselect" + thefile;


        //elementoActivo.checked = true;

        //  id = elementoActivo.value;

        //        var id = $('input[name="' + theobject + '"]').val();

        //        var nom_evento = $('input[name="' + theobject + '"]').attr('nom_evento');




        $("#mdlevent").load("/cw3/conlabweb3.0/apps/registrodeeventos/modal.php", {
            id: id
        });

    }
</script>