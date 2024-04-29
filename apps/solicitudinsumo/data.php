<?php

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


?>
    <form id="formcontrol" action="" method="post" style="width:100%" enctype="multipart/form-data">
        <div class="row" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label>Solicitante</label>
                <select class="form-control" name="solicitante" id="solicitante" >
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT a.id_persona, a.nombre_1 ,a.nombre_2,a.apellido_1,a.apellido_2
                                                    FROM u116753122_cw3completa.persona a, u116753122_cw3completa.persona_empleados b
                                                    where estado='1'
                                                    and a.id_persona = b.id_persona ";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            $solicitante = trim($filaP2['id_persona']);
                            echo "<option value='" . trim($filaP2a['id_persona']) . "'";
                            echo '>' . $filaP2a['nombre_1']." ".$filaP2a['nombre_2']." " .$filaP2a['apellido_1']." ".$filaP2a['apellido_2'] .  "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 col-lg-4 ">
                <label>Centro de Costo</label>
                <select class="form-control" name="costo" id="costo" >
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.centro_costos
                                                    where estado='1' ";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            $costo = trim($filaP2['id']);
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            echo '>' . $filaP2a['nombre'].  "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4 col-lg-4 ">
                <label>Motivo</label>
                <textarea type="input" class="form-control" name="motivo" id="motivo" required></textarea>

            </div>

        </div>
        <div class="row" style="width:100%;">
            <div class="col-md-3 col-lg-3 ">
                <label>Insumo</label>
                <select class="form-control" name="insumo" id="insumo" >
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_producto ,nombre
                                                    FROM u116753122_cw3completa.producto
                                                    where estado='1' ";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                       
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            $insumo = trim($filaP2['id_producto']);
                            echo "<option value='" . trim($filaP2a['id_producto']) . "'";
                            echo '>' . $filaP2a['nombre']."</option>";
                           
                        }
                    }
                    ?>
                </select>
            </div>
            <div class=" col-md-3 col-lg-3">
                <label>Cantidad</label>
                <input type="input" class="form-control" name="cantidad" id="cantidad" required></input>
            </div>
            <div class=" col-md-3 col-lg-3">
                <label>Fecha</label>
                <input type="date" class="form-control" name="fecha" id="fecha" required></input>
            </div>
            <div class=" col-md-3 col-lg-3">

                <button type="submit" value="Enviar" class="btn btn-outline-primary" id="envio" style="margin:15% 0% 0% 0%;">Agregar</button>
            </div>
        </div>

    </form>
   
<?php } ?>

