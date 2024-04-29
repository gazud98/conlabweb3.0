<script>
    function selectthefile(caso,estado){

         document.getElementById("fileselect"+caso).checked = true;
        try{
             if(caso==1){ document.getElementById("thefileselected1").style.border = '4px groove #dc3545';
             } else { document.getElementById("thefileselected1").style.border = 'thin solid transparent'; }
        }catch(err){
        }

        try{
             if(caso==2){ document.getElementById("thefileselected2").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected2").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==3){ document.getElementById("thefileselected3").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected3").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==4){ document.getElementById("thefileselected4").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected4").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==5){ document.getElementById("thefileselected5").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected5").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==6){ document.getElementById("thefileselected6").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected6").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==7){ document.getElementById("thefileselected7").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected7").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==8){ document.getElementById("thefileselected8").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected8").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==9){ document.getElementById("thefileselected9").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected9").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==10){ document.getElementById("thefileselected10").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected10").style.border = 'thin solid transparent'; }
        }catch(err){
        }

        try{
             if(caso==11){ document.getElementById("thefileselected11").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected11").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==12){ document.getElementById("thefileselected12").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected12").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==13){ document.getElementById("thefileselected13").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected13").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==14){ document.getElementById("thefileselected14").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected14").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        try{
             if(caso==15){ document.getElementById("thefileselected15").style.border = '4px groove #dc3545';
            } else { document.getElementById("thefileselected15").style.border = 'thin solid  transparent'; }
        }catch(err){
        }

        let elementoActivo = document.querySelector('input[name="fileselect"]:checked');
        if(elementoActivo) {
            id= elementoActivo.value;
            //Cargo forma con valaores pa aedita o eliminar
            $("#newbtn").css("display", "block");
            $("#modbtn").css("display", "block");

            if(estado=='0'){ $("#delbtn").html("Habilitar"); }else{ $("#delbtn").html("Inhabilitar"); }


            $("#delbtn").css("display", "block");


             <?php
                if($sctrl1==""){ $sctrl1="0"; }
                if($sctrl2==""){ $sctrl2="0"; }
                if($sctrl3==""){ $sctrl3="0"; }
                if($sctrl4==""){ $sctrl4="0"; }
                if($sctrl5==""){ $sctrl5="0"; }
                if($sctrl6==""){ $sctrl6="0"; }
            ?>

             $("#divappshow").load("<?php echo base_url.'apps/'.$p.'/thedatashow.php'; ?>",
                                    { p:"<?php echo $p; ?>",
                                        id:id,
                                        sctrl1:<?php echo $sctrl1; ?>,
                                        sctrl2:<?php echo $sctrl2; ?>,
                                        sctrl3:<?php echo $sctrl3; ?>,
                                        sctrl4:<?php echo $sctrl4; ?>,
                                        sctrl5:<?php echo $sctrl5; ?>,
                                        sctrl6:<?php echo $sctrl6; ?>
                                    }
                                    );


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

    function collapseanshow(caso){
            var permitego ="N";

            if(caso=="X"){ //cancelar....
                inhabilitacmpos(); //inhabilita camnoos
                $("#newbtn").css("display", "block");
                $("#modbtn").css("display", "none");
                $("#delbtn").css("display", "none");
                $("#successbtn").css("display", "none");
                $("#cancelbtn").css("display", "none");
            }else{
                if(caso=="A"){ //ejecuta eoces de guardar
                    savedata(); //'a guardar e inhabilita cmapso';
                    $("#newbtn").css("display", "block");
                    $("#modbtn").css("display", "none");
                    $("#delbtn").css("display", "none");
                    $("#successbtn").css("display", "none");
                    $("#cancelbtn").css("display", "none");
                }else{
                    habilitacmpos(); //habilitacamposfrm;
                    $("#newbtn").css("display", "none");
                    $("#modbtn").css("display", "none");
                    $("#delbtn").css("display", "none");
                    $("#successbtn").css("display", "block");
                    $("#cancelbtn").css("display", "block");

                    if(caso=="C"){
                        $("#accionejec").html("Crear Registro");
                    }
                    if(caso=="E"){ $("#accionejec").html("Modificar Registro"); }
                    if(caso=="D"){ $("#accionejec").html("<span style='color:red'>Inhabilitar Registro</span>"); }
                    $("#accionejec").css("display", "block");

                }//es acepatr?
            }//e cancelar?
            accionesespecificas(caso);
            $("#modeeditstatus").val(caso);
    }



// ..........................................................................................
    function paginattion(gotopage){


        //alert(gotopage);

        var limiteinf= ((gotopage*<?php echo limitinpantalla; ?>)+1)-<?php echo limitinpantalla; ?>;

        //alert(limiteinf);
        <?php
            if($sctrl1==""){ $sctrl1="0"; }
            if($sctrl2==""){ $sctrl2="0"; }
            if($sctrl3==""){ $sctrl3="0"; }
            if($sctrl4==""){ $sctrl4="0"; }
            if($sctrl5==""){ $sctrl5="0"; }
            if($sctrl6==""){ $sctrl6="0"; }
        ?>

         $("#thetable").load("<?php echo base_url.'apps/'.$p.'/thedatatable.php'; ?>",
                                { p:"<?php echo $p; ?>",
                                  limiteinf:limiteinf,
                                  limitinpantalla:<?php echo limitinpantalla; ?>,
                                  sctrl1:<?php echo $sctrl1; ?>,
                                  sctrl2:<?php echo $sctrl2; ?>,
                                  sctrl3:<?php echo $sctrl3; ?>,
                                  sctrl4:<?php echo $sctrl4; ?>,
                                  sctrl5:<?php echo $sctrl5; ?>,
                                  sctrl6:<?php echo $sctrl6; ?>
                                }
                        );

         $("#thenavigation").load("<?php echo base_url.'apps/thedatanavigation.php'; ?>",
                                { p:"<?php echo $p; ?>",
                                  limiteinf:limiteinf,
                                    cantrgt:<?php  echo $cantrgt; ?>,
                                    limitinpantalla:<?php echo limitinpantalla; ?>,
                                  sctrl1:<?php echo $sctrl1; ?>,
                                  sctrl2:<?php echo $sctrl2; ?>,
                                  sctrl3:<?php echo $sctrl3; ?>,
                                  sctrl4:<?php echo $sctrl4; ?>,
                                  sctrl5:<?php echo $sctrl5; ?>,
                                  sctrl6:<?php echo $sctrl6; ?>
                                }
                        );

    }

    paginattion('1'); /**/

</script>


