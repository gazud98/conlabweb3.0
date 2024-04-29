<div class="row" name="thebuttoms" id="thebuttoms" >

    <?php if($nocreatebittomP!="S") { ?>

        <div class="col-md-6 col-xs-6 " style="text-align:left; " >

                <div class="btn-group " style="display:none;" >
                    <button type="button" class="btn btn-secondary btn-xs"  onclick="collapseanshow('IP')">
                        <i class="fas fa-caret-down"></i>&nbsp;&nbsp;Importar
                    </button>
                    <button type="button" class="btn btn-secondary btn-xs"  onclick="collapseanshow('EP')">
                        <i class="fas fa-caret-up"></i>&nbsp;&nbsp;Exportar
                    </button>
                    <button type="button" class="btn btn-secondary btn-xs"  onclick="collapseanshow('II')">
                        <i class="fas fa-print"></i>&nbsp;&nbsp;Imprimir
                    </button>
                </div>

        </div>

        <div class="col-md-6 col-xs-6 "  style="text-align:right;"   >

                <table>
                    <tr>
                     
                        <td>
                            <button type="button" class="btn btn-primary btn-xs" name="modbtn" id="modbtn"  onclick="collapseanshow('E')" style="display:none">
                                <i class="fas fa-pen"></i>&nbsp;&nbsp;Modificar
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-xs" name="delbtn" id="delbtn" onclick="collapseanshow('D')" style="display:none">
                                <i class="fas fa-eraser"></i>&nbsp;&nbsp;Inhabilitar
                            </button>
                        </td>
                        <!--<td>
                            <button type="button" class="btn btn-success btn-xs" name="successbtn" onclick="collapseanshow('A')" id="successbtn"style="display:none">
                                <i class="fas fa-plus"></i>&nbsp;&nbsp;Aceptar
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-xs" name="cancelbtn" id="cancelbtn"  onclick="collapseanshow('X')" style="display:none">
                                <i class="fa-solid fa-xmark"></i></i>&nbsp;&nbsp;Cancelar
                            </button>
                        </td>-->
                    </tr>
                </table>
        </div>


    <?php } ?>

</div>
