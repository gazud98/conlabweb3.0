<?php
//SI POOSEE CONSULTA

if( file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
}else{
    if( file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    }else{
        if( file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}



// echo __FILE__.'>dd.....<br>';

 //echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
 $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv.bbserver1);
 if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
 }else{


 include('reglasdenavegacion.php');

// echo '..............................';

?>
<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>

        <?php
        /* */
        //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena="SELECT id, nombre,estado
                    FROM  u116753122_cw3completa.cargos".
                            $filterfrom.
                    " where 1=1".
                        $filterwhere;
            $cadena=$cadena." order by 2
                    Limit ".$limiteinf.",".$limitinpantalla;
//                      echo $cadena;
                     /* */
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
                                echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                                echo '>';
                                echo '<input type="radio" name="fileselect" id="fileselect'.$thefile.'" value="'.$id.'" style="display:none;" >';
                                echo $id;
                        echo '</td>';

                        echo '<td style="font-size:0.8rem;"';
                            echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                            echo '>';
                            echo $nombre;
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
