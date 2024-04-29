<?php

 include("../../config/accesosystems.php");
// echo __FILE__.'>dd.....<br>';
 //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
if ($conetar->connect_errno) {
    $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
}else{
    $limiteinf=$_REQUEST['limiteinf'];
    if($limiteinf==""){ $limiteinf=0; }else{ if($limiteinf=="1"){ $limiteinf=0; } }

    if ( true === ( isset( $_REQUEST["filterfrom"] ) ? $_REQUEST["filterfrom"] : null ) ) {
        if($_REQUEST["filterfrom"]!=""){ $filterfrom=$_REQUEST["filterfrom"];}else{ $filterfrom=""; } 
    }else{ $filterfrom=""; } 
    if ( true === ( isset( $_REQUEST["filterwhere"] ) ? $_REQUEST["filterwhere"] : null ) ) {
        if($_REQUEST["filterwhere"]!=""){ $filterwhere=$_REQUEST["filterwhere"]; }else{ $filterwhere=""; } 
    }else{ $filterwhere=""; }
    

?>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
            <?php
                $thecolums="<th>Codigo</th>
                <th>Producto</th>
                <th>Bodega</th>
                <th>Alerta de Stock</th>
                <th>Ubicacion</th>";
                echo $thecolums ?>
            </tr>
        </thead>
        <tbody>

<?php
//******************************************************************************
    //prieemrpo la ejecutpo apra el maxio de egistro para cuadrar el paginador.   CAMBIAR CONSULTA
    $cadena="SELECT count(*) as cantidad
            FROM  desarrollo_laboratorio.productos".
                $filterfrom.
            " where 1=1".
                $filterwhere;

//                echo $cadena;

    $resultadP2=$conetar->query($cadena);
    $filaP2=mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];
    //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
    $cadena="SELECT id_productos, nombre,estado
            FROM  desarrollo_laboratorio.productos".
                    $filterfrom.
            " where 1=1".
                $filterwhere.
            " order by 2
            Limit ".$limiteinf.",".limitinpantalla;


            //echo $cadena;

    $resultadP2=$conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if($numerfiles2>=1){
        $thefile=0;
        while($filaP2=mysqli_fetch_array($resultadP2)){
            $id=trim($filaP2['id']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
            $nombre=$filaP2['nombre'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
            $estado=$filaP2['estado'];


            $thefile=$thefile+1;
            echo '<tr style="';
                    if($estado=="0"){ echo ' background-color:#DCD9B5; '; }
                echo '"';
                echo ' name="thefileselected'.trim($thefile).'" id="thefileselected'.trim($thefile).'"';
            echo '>';
                echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile('."'".trim($thefile)."'".')"  style="cursor:pointer;"';
                    echo '>';
                    echo '<input type="radio" name="fileselect" id="fileselect'.$thefile.'" value="'.$id.'" style="display:NONE;" >';
                    echo $id;
                     if($estado=="0"){ echo '<br><span style="color:red;">It is not enabled</span>'; }
            echo '</td>';

            echo '<td style="font-size:0.8rem;"';
                echo ' onclick="selectthefile('."'".trim($thefile)."'".')"  style="cursor:pointer;"';
                echo '>';
                echo $nombre;
            echo '</td>';

            echo '<td style="font-size:0.8rem;"';
                echo ' onclick="selectthefile('."'".trim($thefile)."'".')"  style="cursor:pointer;"';
                echo '>';
                echo 'Bodega Principal';
            echo '</td>';

            echo '<td style="font-size:0.8rem;"';
                echo ' onclick="selectthefile('."'".trim($thefile)."'".')"  style="cursor:pointer;"';
                echo '>';

                echo(rand(10,100));
            echo '</td>';

            echo '<td style="font-size:0.8rem;"';
                echo ' onclick="selectthefile('."'".trim($thefile)."'".')"  style="cursor:pointer;"';
                echo '>';
                echo 'Stand: '.rand(10,100).'<br>'.
                    'Entrepaño: '.rand(1,10).'<br>'.
                    'Caja: '.rand(6,40);
            echo '</td>';

            echo '</tr>';
        }
    }

?>
        </tbody>
        <tfoot class="table-border-bottom-0">
            <tr>
                <?php echo $thecolums ?>
            </tr>
        </tfoot>
    </table>



<?php
}
/**/
?>

