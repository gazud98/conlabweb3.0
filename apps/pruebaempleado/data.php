<?php

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $cadena = "select id_empleado
    from u116753122_cw3completa.asignacion_prueba";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id_empleado = trim($filaP2['id_empleado']);
    }

?>
    <form id="formcontrol" action="" method="post" style="width:100%" enctype="multipart/form-data">
        <div class="row" style="width:100%;">
            <div class="col-md-2 col-lg-2">
                <label>Prueba</label>
                <input type="input" class="form-control" name="codpruebas" id="codpruebas" required></input>
            </div>
            <div class="col-md-4 col-lg-4 ">
                <label>Descripcion</label>
                <select class="form-control" name="pruebas" id="pruebas" onchange='agregar(this);'>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.pruebas
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>

            </div>

            <div class="col-md-4 col-lg-4 ">

                <label>Empleado</label>
                <select class="form-control" name="id_empleado" id="id_empleado" onchange='agregar2(this);'>
                <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT a.id_persona,b.documento, b.nombre_1,b.nombre_2,b.apellido_1,b.apellido_2
                                                    FROM u116753122_cw3completa.persona_empleados a,u116753122_cw3completa.persona b
                                                    where estado='1'
                                                    and b.id_persona=a.id_persona";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_persona']) . "' cc='" . trim($filaP2a['documento']) . "'";
                            echo '>' . $filaP2a['nombre_1'] ." ".  $filaP2a['nombre_2'] ." ".  $filaP2a['apellido_1'] ." ".$filaP2a['apellido_2'] ."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="row" style="width:100%;">
            <div class="col-md-3 col-lg-3 ">

                <label>Cedula</label>
                <input type="input" class="form-control" name="identificacion" id="identificacion" required></input>
            </div>
            <div class=" col-md-2 col-lg-2">
                <label>Tiempo Prueba</label>
                <input type="input" class="form-control" name="tiempo_prueba" id="tiempo_prueba" required></input>
            </div>
            <div class=" col-md-2 col-lg-2" style="text-align: center;">
                <div class="form-check">
                    <label>
                        Minutos
                    </label>
                    <input class="form-check-input" type="radio" name="tiempo" id="tiempo" style="margin-top:30%;" value="1"></input>
                </div>
            </div>
            <div class=" col-md-2 col-lg-2" style="text-align: center;">
                <div class="form-check">
                    <label>
                        Horas
                    </label>
                    <input class="form-check-input" type="radio" name="tiempo" id="tiempo" style="margin-top:30%;" value="2"></input>
                </div>
            </div>
            <div class=" col-md-2 col-lg-2" style="text-align: center;">
                <div class="form-check">
                    <label>
                        Dias
                    </label>
                    <input class="form-check-input" type="radio" name="tiempo" id="tiempo" style="margin-top:30%;" value="3"></input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class=" col-md-3 col-lg-3">

                <button type="submit" value="Enviar" class="btn btn-outline-primary" id="envio" style="margin:15% 0% 0% 0%;">Agregar</button>
            </div>
        </div>
    </form>

<?php } ?>

<script>
    function agregar(sel) {
        var valor = $('option:selected', sel).attr('value');
        $("#codpruebas").val(valor);


    };

    function agregar2(sel) {
        var valor = $('option:selected', sel).attr('cc');
        $("#identificacion").val(valor);


    };
</script>