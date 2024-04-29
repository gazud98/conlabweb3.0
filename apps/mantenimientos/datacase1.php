<?php
//si hay consulta
//     presntadio n par todos los departamento

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

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');

    //echo '..............................'.$_REQUEST['id'].'...';

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "1"; //esa ctivo fijo
    $daño = "";
    $accidentada = "";
    $respuestos = "";
    $valor_servicio = "";
    $empresa = "";
    $precio = "";
    $telefono = "";
    $tecnico = "";
    $equipo = "";
    $mano_obra = "";
    $valor_factura = "";
    $estado = "";
    if ($id != "") {
        $cadena = "select P.id,P.daño,P.accidentada,P.respuestos,P.valor_servicio,P.empresa,P.precio,telefono,
        P.tecnico,P.mano_obra,P.valor_factura,P.estado,P.equipo
                from cw3completa.correctivo P
                where 1=1
                    and P.id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $daño = trim($filaP2['daño']);
            $accidentada = trim($filaP2['accidentada']);
            $respuestos = trim($filaP2['respuestos']);
            $valor_servicio = trim($filaP2['valor_servicio']);
            $empresa = trim($filaP2['empresa']);
            $precio = trim($filaP2['precio']);
            $telefono = trim($filaP2['telefono']);
            $tecnico = trim($filaP2['tecnico']);
            $mano_obra = trim($filaP2['mano_obra']);
            $equipo = trim($filaP2['equipo']);
            $valor_factura = trim($filaP2['valor_factura']);
            $estado = trim($filaP2['estado']);
        }
    }

?>

    <style>
        .form-formcontrol1 {
            display: block;
            height: 2%;
            width: 100%;
            padding: 2px;
            font-size: 13px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;

            border-radius: 0.25rem;
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .table-txt-tip {
            width: 100%;
        }

        .table-txt-order tr,
        tr td {
            width: 100px;
            padding-left: 10px;
        }
    </style>

    <div name="formcontrol1" id="formcontrol1" style="width:100%;padding:1%;">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


        <div class="row">

            <table class="table-txt-tip col-md-6 container">
                <tr>
                    <td>
                        <div id="tp">
                        <label style="font-size: 12px;">Seleccione Tipo de Mantenimiento:</label>
                        <select class="form-control" onchange="changeMaintenance(this)">
                            <option selected="true" disabled="disabled"></option>
                            <option value="C">Correctivo</option>
                            <option value="P">Preventivo</option>
                        </select>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="choose-maintenance">

        </div>
        <hr>

    </div>



    <script>
        function changeMaintenance(sel) {
            var tm = $('option:selected', sel).attr('value');
            var status = $("#modeeditstatus").val();
            if (tm == 'C') {
                $("#choose-maintenance").load("https://cw3.tierramontemariana.org/apps/mantenimientos/correctivo.php", {
                    status: status
                });
            } else if (tm == 'P') {
                $("#choose-maintenance").load("https://cw3.tierramontemariana.org/apps/mantenimientos/preventivo.php", {
                    status: status
                });
            }

        }

        function executeMaintenance() {
            var tipmant = $("#tipmant").val();

           

            if (tipmant == 'C') {
                var daño = $("#daño").val();
                //var valor_servicio = $("#valor_servicio").val();
                var accidentada = $("#accidentada").val();
                var respuestos = $("#respuestos").val();
                var empresa = $("#empresa").val();
                //var precio = $("#precio").val();
                var telefono = $("#telefono").val();
                var tecnico = $("#tecnico").val();
                //var mano_obra = $("#mano_obra").val();
                var equipo = $("#equipo").val();
                var valor_factura = $("#valor_factura").val();

                if (equipo == null) {
                    equipo = '';
                }


                if (equipo.trim() === '') {
                    $("#equipo").css("border", "thin solid red");
                    $("#equipox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#equipo").css("border", "thin solid rgb(233,236,239)");
                    $("#equipox").empty();
                }
                if (daño.trim() === '') {
                    $("#daño").css("border", "thin solid red");
                    $("#dañox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#daño").css("border", "thin solid rgb(233,236,239)");
                    $("#dañox").empty();
                }

                /*if (valor_servicio.trim() === '') {
                    $("#valor_servicio").css("border", "thin solid red");
                    $("#valor_serviciox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#valor_servicio").css("border", "thin solid rgb(233,236,239)");
                    $("#valor_serviciox").empty();
                }*/

                /*if (accidentada.trim() === '') {
                    $("#accidentada").css("border", "thin solid red");
                    $("#accidentadax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#accidentada").css("border", "thin solid rgb(233,236,239)");
                    $("#accidentadax").empty();
                }*/
                if (respuestos.trim() === '') {
                    $("#respuestos").css("border", "thin solid red");
                    $("#respuestosx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#respuestos").css("border", "thin solid rgb(233,236,239)");
                    $("#respuestosx").empty();
                }
                if (empresa.trim() === '') {
                    $("#empresa").css("border", "thin solid red");
                    $("#empresax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#empresa").css("border", "thin solid rgb(233,236,239)");
                    $("#empresax").empty();
                }
                /*if (precio.trim() === '') {
                    $("#precio").css("border", "thin solid red");
                    $("#preciox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#precio").css("border", "thin solid rgb(233,236,239)");
                    $("#preciox").empty();
                }*/
                if (telefono.trim() === '') {
                    $("#telefono").css("border", "thin solid red");
                    $("#telefonox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#telefono").css("border", "thin solid rgb(233,236,239)");
                    $("#telefonox").empty();
                }
                if (tecnico.trim() === '') {
                    $("#tecnico").css("border", "thin solid red");
                    $("#tecnicox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#tecnico").css("border", "thin solid rgb(233,236,239)");
                    $("#tecnicox").empty();
                }
                /*if (mano_obra.trim() === '') {
                    $("#mano_obra").css("border", "thin solid red");
                    $("#mano_obrax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#mano_obra").css("border", "thin solid rgb(233,236,239)");
                    $("#mano_obrax").empty();
                }*/
                if (valor_factura.trim() === '') {
                    $("#valor_factura").css("border", "thin solid red");
                    $("#valor_facturax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#valor_factura").css("border", "thin solid rgb(233,236,239)");
                    $("#valor_facturax").empty();
                }



                collapseanshow('A');
            } else if (tipmant == 'P') {
                var equipo = $("#equipo").val();
                var localizacion = $("#localizacion").val();
                var fecha_comienzo = $("#fecha_comienzo").val();
                var id_proveedor = $("#id_proveedor").val();
                var meses_garantia = $("#meses_garantia").val();
                //var meses_garantia_ext = $("#meses_garantia_ext").val();
                var id_tipo_mantenimiento = $("#id_tipo_mantenimiento").val();
                //var desc_mantenimiento = $("#desc_mantenimiento").val();
                var responsable = $("#responsable").val()
                var periodicidad = $("#periodicidad").val();
                var comenzar = $("#comenzar").val();
                var rve = $("#rve").val();
                var resp_mantenimiento = $("#resp_mantenimiento").val();
                var dir_resp = $("#dir_resp").val();
                var tef_resp = $("#tef_resp").val();




                if (equipo == null) {
                    equipo = '';
                }
                if (id_proveedor == null) {
                    id_proveedor = '';
                }
                if (id_tipo_mantenimiento == null) {
                    id_tipo_mantenimiento = '';
                }
                if (periodicidad == null) {
                    periodicidad = '';
                }
                if (responsable == null) {
                    responsable = '';
                }
                if (resp_mantenimiento == null) {
                    resp_mantenimiento = '';
                }
                if (equipo.trim() === '') {
                    $("#equipo").css("border", "thin solid red");
                    $("#equipox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#equipo").css("border", "thin solid rgb(233,236,239)");
                    $("#equipox").empty();
                }

                if (localizacion.trim() === '') {
                    $("#localizacion").css("border", "thin solid red");
                    $("#localizacionx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#localizacion").css("border", "thin solid rgb(233,236,239)");
                    $("#localizacionx").empty();
                }

                /*if (fecha_comienzo.trim() === '') {
                    $("#fecha_comienzo").css("border", "thin solid red");
                    $("#fecha_comienzox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#fecha_comienzo").css("border", "thin solid rgb(233,236,239)");
                    $("#fecha_comienzox").empty();
                }*/
                if (id_proveedor.trim() === '') {
                    $("#id_proveedor").css("border", "thin solid red");
                    $("#id_proveedorx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#id_proveedor").css("border", "thin solid rgb(233,236,239)");
                    $("#id_proveedorx").empty();
                }
                if (meses_garantia.trim() === '') {
                    $("#meses_garantia").css("border", "thin solid red");
                    $("#meses_garantiax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#meses_garantia").css("border", "thin solid rgb(233,236,239)");
                    $("#meses_garantiax").empty();
                }
                /*if (meses_garantia_ext.trim() === '') {
                    $("#meses_garantia_ext").css("border", "thin solid red");
                    $("#meses_garantia_extx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#meses_garantia_ext").css("border", "thin solid rgb(233,236,239)");
                    $("#meses_garantia_extx").empty();
                }*/
                if (responsable.trim() === '') {
                    $("#responsable").css("border", "thin solid red");
                    $("#responsablex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#responsable").css("border", "thin solid rgb(233,236,239)");
                    $("#responsablex").empty();
                }
                if (id_tipo_mantenimiento.trim() === '') {
                    $("#id_tipo_mantenimiento").css("border", "thin solid red");
                    $("#id_tipo_mantenimientox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#id_tipo_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                    $("#id_tipo_mantenimientox").empty();
                }
                /*if (desc_mantenimiento.trim() === '') {
                    $("#desc_mantenimiento").css("border", "thin solid red");
                    $("#desc_mantenimientox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#desc_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                    $("#desc_mantenimientox").empty();*/
                }
                if (periodicidad.trim() === '') {
                    $("#periodicidad").css("border", "thin solid red");
                    $("#periodicidadx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#periodicidad").css("border", "thin solid rgb(233,236,239)");
                    $("#periodicidadx").empty();
                }
                if (comenzar.trim() === '') {
                    $("#comenzar").css("border", "thin solid red");
                    $("#comenzarx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#comenzar").css("border", "thin solid rgb(233,236,239)");
                    $("#comenzarx").empty();
                }
                
                if (resp_mantenimiento.trim() === '') {
                    $("#resp_mantenimiento").css("border", "thin solid red");
                    $("#resp_mantenimientox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#resp_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                    $("#resp_mantenimientox").empty();
                }
                if (dir_resp.trim() === '') {
                    $("#dir_resp").css("border", "thin solid red");
                    $("#dir_respx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#dir_resp").css("border", "thin solid rgb(233,236,239)");
                    $("#dir_respx").empty();
                }
                if (tef_resp.trim() === '') {
                    $("#tef_resp").css("border", "thin solid red");
                    $("#tef_respx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#tef_resp").css("border", "thin solid rgb(233,236,239)");
                    $("#tef_respx").empty();
                }


                collapseanshow('A');

            }
        
    </script>
<?php
}
?>