<?php

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


?>



    <form id="formcontrol" action="" method="post" style="width:100%" enctype="multipart/form-data">
        <div class="row" style="width:100%;">

            <div class="col-md-3 col-lg-3 ">
                <label>Descripcion</label>
                <input type="input" class="form-control" name="descripcion" id="descripcion" required></input>
            </div>

            <div class=" col-md-3 col-lg-3" style="text-align: center;">
                <div class="form-check">
                    <label>
                        Distribuir Dpto
                    </label>
                    <input class="form-check-input" type="radio" name="distribuido" id="distribuido" style="margin-top:30%;" value="1"></input>
                </div>
            </div>
            <div class=" col-md-3 col-lg-3" style="text-align: center;">
                <div class="form-check">
                    <label>
                        Distribuir Prueba
                    </label>
                    <input class="form-check-input" type="radio" name="distribuido" id="distribuido" style="margin-top:30%;" value="2"></input>
                </div>
            </div>
            <div class=" col-md-3 col-lg-3" style="text-align: center;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="check" name="check" style="margin:29% 0% 0% 0%" checked>
                    <label>
                        Costo Fijo
                    </label>


                </div>
            </div>
        </div>
        <div class="row" style="width:100%; margin-top: 20px;">

            <div class=" col-md-6 col-lg-6">
                <button type="submit" value="Enviar" class="btn btn-primary" id="envio">Agregar</button>
            </div>
        </div>

    </form>

<?php } ?>