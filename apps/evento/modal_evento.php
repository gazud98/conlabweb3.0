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
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    if (isset($_REQUEST['id_producto'])) {
        $id_producto = $_REQUEST['id_producto'];

        if ($id_producto == "-1") {
            $id_producto = "";
        }
    } else {
        $id_producto = "0";
    }

    if (isset($_REQUEST['grupo'])) {
        $grupo = $_REQUEST['grupo'];

        if ($grupo == "-1") {
            $grupo = "";
        }
    } else {
        $grupo = "0";
    }
    $nombre = "";
    $garantia = "";
    $id_proveegarantia = "";
    $id_tipo_activo = "";
    $cadena = "SELECT a.id_producto, a.nombre, b.garantia,b.id_proveegarantia,a.id_tipo_activo
    FROM u116753122_cw3completa.producto a , u116753122_cw3completa.producto_activofijo b
    where  a.id_producto =  b.id_producto 
    and a.id_producto = " . $id_producto;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        if ($numerfiles2 >= 1) {
            $id_producto = trim($filaP2['id_producto']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
            $nombre = $filaP2['nombre'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
            $garantia = $filaP2['garantia'];
            $id_proveegarantia = $filaP2['id_proveegarantia'];
            $id_tipo_activo = $filaP2['id_tipo_activo'];
        }
    }
    if ($id_tipo_activo == null) {
        $id_tipo_activo = 0;
    }


    date_default_timezone_set('America/Bogota');
    $fechaActual = date('d-m-Y');
?>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="text-align: center;background-color: rgb(22,64,133);color:white;">
                    <h5 style="text-align:center;"><strong>Crear Evento</strong></h5>
                    <button type="button" class="close" style="color:white" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modalshow" name="modalshow">

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <label>Nombre Evento:</label>
                            <input type="input" class="form-control" name="evento1" id="evento1" grupo="<?php echo $grupo; ?>" required></input>
                            <div id="evento1x"></div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <label>Descripcion:</label>
                            <textarea class="form-control required" name="desc1" id="desc1" required></textarea>
                            <div id="desc1x"></div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-6 col-lg-6">
                            <label>Fecha Inicio:</label>
                            <input type="date" class="form-control required" name="finicio1" id="finicio1" required></input>
                            <div id="finicio1x"></div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>Repetir Cada:</label>

                            <select class="form-control required" aria-label="Default select example" name="periodicidad1" id="periodicidad1" onchange="seleccionar1(this)" required>
                                <option value="D">Dia</option>
                                <option value="S">Semana</option>
                                <option value="M">Mes</option>
                                <option value="A">Año</option>
                            </select>
                            <div id="periodicidad1x"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6" id="period1">

                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-6 col-lg-6">
                            <label>Proveedor:</label>
                            <select class="form-control required" name="proveegarantia1" id="proveegarantia1" >
                                <option selected="true" disabled="disabled" required></option>
                                <?php

                                $cadenax = "SELECT id_proveedores,nombre_comercial
                                                    FROM u116753122_cw3completa.proveedores ";
                                $resultadP2ax = $conetar->query($cadenax);
                                $numerfiles2ax = mysqli_num_rows($resultadP2ax);
                                if ($numerfiles2ax >= 1) {
                                    while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
                                        // $id_producto = trim($filaP2x['id_producto']);
                                        echo "<option value='" . trim($filaP2ax['id_proveedores']) . "'";
                                        echo '>' . $filaP2ax['nombre_comercial'] . "</option>";
                                    }
                                }

                                ?>
                            </select>
                            <div id="proveegarantia1x"></div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>Responsable:</label>
                            <select class="form-control required" name="responsable" id="responsable" required>
                                <option selected="true"  value="" required></option>
                                <?php

                                $cadenax = "SELECT a.id_persona, a.nombre_1,a.nombre_2,a.apellido_1,a.apellido_2
                                                    FROM u116753122_cw3completa.persona a ";
                                $resultadP2ax = $conetar->query($cadenax);
                                $numerfiles2ax = mysqli_num_rows($resultadP2ax);
                                if ($numerfiles2ax >= 1) {
                                    while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
                                        // $id_producto = trim($filaP2x['id_producto']);
                                        echo "<option value='" . trim($filaP2ax['id_persona']) . "'";
                                        echo '>' . $filaP2ax['nombre_1'] . " " . $filaP2ax['nombre_2'] . " " . $filaP2ax['apellido_1'] . " " . $filaP2ax['apellido_2'] . "</option>";
                                    }
                                }

                                ?>
                            </select>
                            <div id="responsablex"></div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" id="acep" > Crear Evento</button>

                    
                    </div>


                </div>
            </div>
        </div>


    <?php } ?>


    <script>
        function seleccionar1(sel) {
            var caso = $('option:selected', sel).attr('value');


            $("#period1").load('/cw3/conlabweb3.0/apps/evento/periodicidad1.php', {
                caso: caso
            })


        }

        function recorrerGrupoact1() {
            var max = $('input[name="fileselect231"]').val();


            for (let i = 1; i <= max; i++) {
                if ($('#fileselect4' + [i]).prop("checked")) {
                    var id_producto = $('input[name="fileselect23' + [i] + '"]').attr('id_producto');
                    crearEvento1(id_producto);
                }
            }
            alert("¡Evento Creado Exitosamente!");
        }

        function crearEvento1(id_producto) {
            rep1 = $("#rep1").val();
            periodicidad1 = $("#periodicidad1").val();
            finicio1 = $("#finicio1").val();
            desc1 = $("#desc1").val();
            evento1 = $("#evento1").val();
            mesoption1 = $("#mesoption1").val();
            responsable = $("#responsable").val();
            proveegarantia1 = $("#proveegarantia1").val();
            // var id_producto = $('input[name="evento1"]').attr('id_producto');
            var idgra = $('input[name="fileselect231"]').attr('idgra');
            var grupo = $('input[name="evento1"]').attr('grupo');
            sunday = $('input:checkbox[name=sunday1]:checked').val();
            monday = $('input:checkbox[name=monday1]:checked').val();
            tuesday = $('input:checkbox[name=tuesday1]:checked').val();
            wednesday = $('input:checkbox[name=wednesday1]:checked').val();
            thursday = $('input:checkbox[name=thursday1]:checked').val();
            friday = $('input:checkbox[name=friday1]:checked').val();
            saturday = $('input:checkbox[name=saturday1]:checked').val();
            if (sunday == null) {
                sunday = "N";
            } else {
                sunday + ",";
            }
            if (monday == null) {
                monday = "N";
            }
            if (tuesday == null) {
                tuesday = "N";
            }
            if (wednesday == null) {
                wednesday = "N";
            }
            if (thursday == null) {
                thursday = "N";
            }
            if (friday == null) {
                friday = "N";
            }
            if (saturday == null) {
                saturday = "N";
            }
            diassemana = sunday + "," + monday + "," + tuesday + "," + wednesday + "," + thursday + "," + friday + "," + saturday;

            $.ajax({
                type: 'POST',
                url: '/cw3/conlabweb3.0/apps/evento/crud.php',
                data: {
                    rep: rep1,
                    periodicidad: periodicidad1,
                    finicio: finicio1,
                    desc: desc1,
                    evento: evento1,
                    diassemana: diassemana,
                    mesoption: mesoption1,
                    id_producto: id_producto,
                    grupo: grupo,
                    idgra: idgra,
                    responsable: responsable,
                    proveegarantia1: proveegarantia1
                },
                success: function(data) {

                    if (grupo == 'N') {
                        alert("¡Evento Creado Exitosamente!")
                    }
                    $("#tableevento").load('/cw3/conlabweb3.0/apps/evento/table_eventos.php');
                }
            })


        }
        $(document).ready(function() {
            $('#acep').click(function() {
                var evento1 = $('#evento1').val();
                var desc1 = $('#desc1').val();
                var finicio1 = $('#finicio1').val();
                var periodicidad1 = $('#periodicidad1').val();
                var proveegarantia1 = $('#proveegarantia1').val();
                var responsable = $('#responsable').val();
                
                if(proveegarantia1==null){
                    proveegarantia1='';
                }
                if(responsable==null){
                    responsable='';
                }
                if (evento1.trim() === '') {
                    $("#evento1").css("border", "thin solid red");
                    $("#evento1x").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#evento1").css("border", "thin solid rgb(233,236,239)");
                    $("#evento1x").empty();
                }

                if (desc1.trim() === '') {
                    $("#desc1").css("border", "thin solid red");
                    $("#desc1x").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#desc1").css("border", "thin solid rgb(233,236,239)");
                    $("#desc1x").empty();
                }

                if (finicio1.trim() === '') {
                    $("#finicio1").css("border", "thin solid red");
                    $("#finicio1x").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#finicio1").css("border", "thin solid rgb(233,236,239)");
                    $("#finicio1x").empty();
                }

                if (proveegarantia1.trim() === ''  || proveegarantia1 == null) {
                    $("#proveegarantia1").css("border", "thin solid red");
                    $("#proveegarantia1x").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#proveegarantia1").css("border", "thin solid rgb(233,236,239)");
                    $("#proveegarantia1x").empty();
                }

                if (responsable.trim() === '' ) {
                    $("#responsable").css("border", "thin solid red");
                    $("#responsablex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#responsable").css("border", "thin solid rgb(233,236,239)");
                    $("#responsablex").empty();
                }

                
                    if (<?php echo $grupo ?> == 'N') {
                        crearEvento1(<?php echo $id_producto ?>);
                    } else {
                        recorrerGrupoact1();
                    }

            });
        });
    </script>