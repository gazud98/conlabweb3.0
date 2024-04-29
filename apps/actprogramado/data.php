<?php

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
   

?>
    <form id="formcontrol" action="" method="post" style="width:100%" enctype="multipart/form-data">
        <div class="row" style="width:100%;">
            <div class="col-md-2 col-lg-2">
                <label>Instrumento</label>
                <input type="input" class="form-control" name="codinstrumento" id="codinstrumento" ></input>
                <?php

                ?>
            </div>
            <div class="col-md-4 col-lg-4 ">
                <label>Descripcion</label>
                
                <select class="form-control" name="descripcion1" id="descripcion1" onchange='agregar(this);'>
                <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT a.id_producto, a.nombre
                                                    FROM u116753122_cw3completa.producto a,u116753122_cw3completa.producto_activofijo b
                                                    where estado='1'
                                                    and b.id_producto=a.id_producto";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            $id_producto = trim($filaP2a['id_producto']);
                            echo "<option value='" . trim($filaP2a['id_producto']) . "'";
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-2 col-lg-2 ">
                <label>Actividades</label>
                <input type="input" class="form-control" name="actividades" id="actividades" ></input>

            </div>
            <div class="col-md-4 col-lg-4 ">
                <label>Descripcion</label>
                <select class="form-control" name="descripcion2" id="descripcion2" onchange='agregar2(this);'>
                <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_actividad_seguimiento, descripcion
                                                    FROM u116753122_cw3completa.actividad_seguimiento 
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            $id_actividad_seguimiento = trim($filaP2a['id_actividad_seguimiento']);
                            echo "<option value='" . trim($filaP2a['id_actividad_seguimiento']) . "'";
                            echo '>' . $filaP2a['descripcion'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="row" style="width:100%;">
            <div class="col-md-3 col-lg-3 ">
                <label>Fecha</label>
                <input type="date" class="form-control" name="fecha" id="fecha" required></input>
            </div>
            <div class=" col-md-3 col-lg-3">
                <label>Resultado</label>
                <input type="input" class="form-control" name="resultado" id="resultado" required></input>
            </div>
            <div class=" col-md-3 col-lg-3">

                <button type="submit" value="Enviar" class="btn btn-outline-primary" id="envio" style="margin:15% 0% 0% 0%;">Agregar</button>
            </div>
        </div>

    </form>

<?php } ?>

<script>
 function  agregar(sel){
       var valor =$('option:selected',sel).attr('value');
       $("#codinstrumento").val(valor);
            
      
    };

    function  agregar2(sel){
       var valor =$('option:selected',sel).attr('value');
       $("#actividades").val(valor);
            
      
    };
</script>