<script src="assets/plugins/jquery/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('input[type="input"],input[type="text"] ').on('keyup', function() {
            var texto = $(this).val();
            var palabras = texto.split(' ');

            for (var i = 0; i < palabras.length; i++) {
                var primeraLetra = palabras[i].charAt(0).toUpperCase();
                var restoPalabra = palabras[i].slice(1).toLowerCase();
                palabras[i] = primeraLetra + restoPalabra;
            }

            var textoFormateado = palabras.join(' ');
            $(this).val(textoFormateado);
        });
    });

    function selectthefile(caso, estado) {

        document.getElementById("fileselect" + caso).checked = true;
        try {
            if (caso == 1) {
                document.getElementById("thefileselected1").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected1").style.border = 'thin solid transparent';
            }
        } catch (err) {}

        try {
            if (caso == 2) {
                document.getElementById("thefileselected2").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected2").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 3) {
                document.getElementById("thefileselected3").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected3").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 4) {
                document.getElementById("thefileselected4").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected4").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 5) {
                document.getElementById("thefileselected5").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected5").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 6) {
                document.getElementById("thefileselected6").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected6").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 7) {
                document.getElementById("thefileselected7").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected7").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 8) {
                document.getElementById("thefileselected8").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected8").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 9) {
                document.getElementById("thefileselected9").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected9").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 10) {
                document.getElementById("thefileselected10").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected10").style.border = 'thin solid transparent';
            }
        } catch (err) {}

        try {
            if (caso == 11) {
                document.getElementById("thefileselected11").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected11").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 12) {
                document.getElementById("thefileselected12").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected12").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 13) {
                document.getElementById("thefileselected13").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected13").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 14) {
                document.getElementById("thefileselected14").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected14").style.border = 'thin solid  transparent';
            }
        } catch (err) {}

        try {
            if (caso == 15) {
                document.getElementById("thefileselected15").style.border = '2px solid #E54646';
            } else {
                document.getElementById("thefileselected15").style.border = 'thin solid  transparent';
            }
        } catch (err) {}



        let elementoActivo = document.querySelector('input[name="fileselect"]:checked');
        if (elementoActivo) {
            id = elementoActivo.value;





            //Cargo forma con valaores pa aedita o eliminar
            $("#newbtn").css("display", "block");
            $("#modbtn").css("display", "block");


            if (estado == '0') {
                $("#delbtn").html("Habilitar");
                $("#accionejec").html("<span style='color:red'>Habilitar Registro</span>");
            } else {
                $("#delbtn").html("Inhabilitar");
            }


            $("#delbtn").css("display", "block");


            <?php
            if ($sctrl1 == "") {
                $sctrl1 = "0";
            }
            if ($sctrl2 == "") {
                $sctrl2 = "0";
            }
            if ($sctrl3 == "") {
                $sctrl3 = "0";
            }
            if ($sctrl4 == "") {
                $sctrl4 = "0";
            }
            if ($sctrl5 == "") {
                $sctrl5 = "0";
            }
            if ($sctrl6 == "") {
                $sctrl6 = "0";
            }
            ?>

            $("#divappshow").load("<?php echo base_url . '/apps/' . $p . '/thedatashow.php'; ?>", {
                p: "<?php echo $p; ?>",
                id: id,
                sctrl1: <?php echo $sctrl1; ?>,
                sctrl2: <?php echo $sctrl2; ?>,
                sctrl3: <?php echo $sctrl3; ?>,
                sctrl4: <?php echo $sctrl4; ?>,
                sctrl5: <?php echo $sctrl5; ?>,
                sctrl6: <?php echo $sctrl6; ?>
            });


        } else {
            $("#newbtn").css("display", "none");
            $("#modbtn").css("display", "none");
            $("#delbtn").css("display", "none");
        }
        $("#successbtn").css("display", "none");
        $("#cancelbtn").css("display", "none");
        $("#accionejec").css("display", "none");
        $("#accionejec").html("");


    }
    // ..........................................................................................

    function collapseanshow(caso) {
        var permitego = "N";
        $("#filesentry").css("display", "none");
        $("#tablefiles").css("display", "none");
        $("#agregar-subir").css("display", "none");
        $("#tabletipo").css("display", "none");
        $("#tablemod").css("display", "none");
        $('input[type="input"],input[type="text"] ').on('keyup', function() {
            var texto = $(this).val();
            var palabras = texto.split(' ');

            for (var i = 0; i < palabras.length; i++) {
                var primeraLetra = palabras[i].charAt(0).toUpperCase();
                var restoPalabra = palabras[i].slice(1).toLowerCase();
                palabras[i] = primeraLetra + restoPalabra;
            }

            var textoFormateado = palabras.join(' ');
            $(this).val(textoFormateado);
        });
        if (caso == "X") { //cancelar....
            inhabilitacmpos(); //inhabilita camnoos
            $("#newbtn").css("display", "block");
            $("#modbtn").css("display", "none");
            $("#delbtn").css("display", "none");
            $("#successbtn").css("display", "none");
            $("#cancelbtn").css("display", "none");

        } else {
            if (caso == "A") { //ejecuta eoces de guardar
                savedata(); //'a guardar e inhabilita cmapso';
                $("#newbtn").css("display", "block");
                $("#modbtn").css("display", "none");
                $("#delbtn").css("display", "none");
                $("#successbtn").css("display", "none");
                $("#cancelbtn").css("display", "none");


            } else {
                habilitacmpos(); //habilitacamposfrm;
                $("#newbtn").css("display", "none");
                $("#modbtn").css("display", "none");
                $("#delbtn").css("display", "none");
                $("#successbtn").css("display", "block");
                $("#cancelbtn").css("display", "block");
                $("#filesentry").css("display", "block");
                $("#tablefiles").css("display", "block");
                $("#agregar-subir").css("display", "block");
                $("#tabletipo").css("display", "block");
                $("#tablemod").css("display", "block");
                if (caso == "C") {
                    $("#accionejec").html("Crear Registro");
                    $("#filesentry").css("display", "none");
                    $("#tablefiles").css("display", "none");
                    $("#agregar-subir").css("display", "none");
                    $("#tabletipo").css("display", "none");
                    $("#tablemod").css("display", "none");
                    $('input[type="text"]').val('');
                    $('input[type="input"]').val('');
                    $('input[type="number"]').val('');
                    $('input[type="date"]').val('');
                    $('select').val('');
                    $('input[type="email"]').val('');
                    $('textarea').val('');
                    $("#tp").css("display", "block");
                    $("#btones").css("display", "block");

                }
                if (caso == "E") {
                    $("#accionejec").html("Modificar Registro");
                    $("#filesentry").css("display", "block");
                    $("#tablefiles").css("display", "block");
                    $("#agregar-subir").css("display", "block");
                    $("#tabletipo").css("display", "block");
                    $("#tablemod").css("display", "block");
                   
                }
                if (caso == "D") {
                    nom = $("#delbtn").text();

                    if (nom == "Inhabilitar") {
                        $("#accionejec").html("<span style='color:red'>Inhabilitar Registro</span>");
                        $("#delbtn").text("Inhabilitar");
                    } else {
                        $("#accionejec").html("<span style='color:red'>Habilitar Registro</span>");
                        $("#delbtn").text("Habilitar");

                    }
                    $("#filesentry").css("display", "block");
                    $("#tablefiles").css("display", "block");
                    $("#agregar-subir").css("display", "block");
                    $("#tabletipo").css("display", "block");
                    $("#tablemod").css("display", "block");
                }

                $("#accionejec").css("display", "block");

            } //es acepatr?
        } //e cancelar?
        accionesespecificas(caso);
        $("#modeeditstatus").val(caso);
        $("#modeeditstatus1").val(caso);
    }



    // ..........................................................................................
    function paginattion(gotopage) {


        //alert(gotopage);

        var limiteinf = ((gotopage * <?php echo limitinpantalla; ?>) + 1) - <?php echo limitinpantalla; ?>;

        //alert(limiteinf);
        <?php
        if ($sctrl1 == "") {
            $sctrl1 = "0";
        }
        if ($sctrl2 == "") {
            $sctrl2 = "0";
        }
        if ($sctrl3 == "") {
            $sctrl3 = "0";
        }
        if ($sctrl4 == "") {
            $sctrl4 = "0";
        }
        if ($sctrl5 == "") {
            $sctrl5 = "0";
        }
        if ($sctrl6 == "") {
            $sctrl6 = "0";
        }
        ?>



        $("#thenavigation").load("<?php echo base_url . '/apps/thedatanavigation.php'; ?>", {
            p: "<?php echo $p; ?>",
            limiteinf: limiteinf,
            cantrgt: <?php echo $cantrgt; ?>,
            limitinpantalla: <?php echo limitinpantalla; ?>,
            sctrl1: <?php echo $sctrl1; ?>,
            sctrl2: <?php echo $sctrl2; ?>,
            sctrl3: <?php echo $sctrl3; ?>,
            sctrl4: <?php echo $sctrl4; ?>,
            sctrl5: <?php echo $sctrl5; ?>,
            sctrl6: <?php echo $sctrl6; ?>
        });

    }

    $(document).ready(function() {

        $('.content-table-data-top').load("<?php echo base_url . 'apps/' . $p . '/buscardatosv1.php'; ?>");

    })

    function enviar_datos_1(id_info_kit) {
        $.post("<?php echo base_url . 'apps/' . $p . '/buscardatosv1.php'; ?>", {
            id_kit_live: id_info_kit
        }, function(data) {

            $('.content-table-data-top').html(data)

        });
    }

    paginattion('1'); /**/
</script>