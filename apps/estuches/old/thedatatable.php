<?php
    $limiteinf = $_REQUEST['limiteinf'];
    $limitinpantalla = $_REQUEST['limitinpantalla'];
   $filterfrom="";
   $filterwhere="";


include("../../config/accesosystems.php");
// echo __FILE__.'>dd.....<br>';

 //echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
 $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
 if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
 }else{
?>
<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Reactivo</th>
        </tr>
    </thead>
    <tbody>

        <?php
        /**/
        //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena="SELECT id_estuche, id_reactivo,reactivo,descripcion,instrumento,fecha_apertura,fecha_expiracion,presentacion,no_lote,fabricante,referencia_fabricante,pruebas_nominales,valor_reactivo,usuario,estado
                    FROM  u116753122_cw3completa.estuches".
                            $filterfrom.
                    " where 1=1".
                        $filterwhere.
                    " order by 2
                    Limit ".$limiteinf.",".$limitinpantalla;
                   // echo $cadena;
                     /**/
            $resultadP2=$conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if($numerfiles2>=1){
                $thefile=0;
                while($filaP2=mysqli_fetch_array($resultadP2)){
                    $id_estuche=trim($filaP2['id_estuche']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $id_reactivo=$filaP2['id_reactivo'];       //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $reactivo=$filaP2['reactivo'];                  
                    $descripcion=$filaP2['descripcion'];
                    $instrumento=$filaP2['instrumento'];
                    $fecha_apertura=$filaP2['fecha_apertura'];
                    $fecha_expiracion=$filaP2['fecha_expiracion'];
                    $presentacion=$filaP2['presentacion'];
                    $no_lote=$filaP2['no_lote'];
                    $fabricante=$filaP2['fabricante'];
                    $referencia_fabricante=$filaP2['referencia_fabricante'];
                    $pruebas_nominales=$filaP2['pruebas_nominales'];
                    $valor_reactivo=$filaP2['valor_reactivo'];
                    $usuario=$filaP2['usuario'];
                    $estado=$filaP2['estado'];
                    $thefile=$thefile+1;

                    echo '<tr style="';
                            if($estado=="0"){ echo ' background-color:#DCD9B5; '; }
                        echo '"';
                        echo ' name="thefileselected'.trim($thefile).'" id="thefileselected'.trim($thefile).'"';
                    echo '>';

                        echo '<td style="font-size:0.8rem;"';
                                echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                                echo '>';
                                echo '<input type="radio" name="fileselect" id="fileselect'.$thefile.'" value="'.$id_estuche.'" style="display:none;" >';
                                echo $id_estuche;
                        echo '</td>';

                        echo '<td style="font-size:0.8rem;"';
                            echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                            echo '>';
                            echo $reactivo;
                            if($estado=="0"){ echo '<br><span style="color:red;">No esta habilitado</span>'; }
                        echo '</td>';

                    echo '</tr>';

                }
            }
            /**/
    ?>
    </tbody>
</table>
<?php
} /**/
?>
