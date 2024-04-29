<?php
//     presntadio n par todos lod produtos tipo producro en genral
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


  
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }
    if ($id != "") {
        $id_archivo = 0;
        $cadena2 = "SELECT max(id) as id
        FROM productos_archivo 
        where  id_producto=" . $id;
        $resultadP2a2 = $conetar->query($cadena2);
        $numerfiles2a2 = mysqli_num_rows($resultadP2a2);

        if ($numerfiles2a2 >= 1) {
            while ($filaP2a2 = mysqli_fetch_array($resultadP2a2)) {
                if ($filaP2a2['id'] == null) {
                    $id_archivo = 0;
                } else {
                    $id_archivo =  $filaP2a2['id'];
                }
            }
        }

        $cadena = "SELECT ruta, nombre_archivo
        FROM productos_archivo 
        where  id=" . $id_archivo;

        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);

        if ($numerfiles2a >= 1) {
            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                $ruta =  $filaP2a['ruta'];
                $nombre_archivo =  $filaP2a['nombre_archivo'];

                $ip = gethostbyname('https://cw3.tierramontemariana.org/');

                $filename = "http://$ip"  . $ruta . $nombre_archivo;
              

                // Check if the file exists

                // Output a link to the PDF file
                echo '<a href="' . $filename . '"  target="_blank"> <i class="fas fa-eye"></i></a>';
            }
        } else {
            echo "<a href='' class='disabled-link'><i class='fas fa-eye'></i></a>";
        }
    }else{
        echo "<a href='' class='disabled-link'><i class='fas fa-eye'></i></a>";
    }
?>

<?php
}
?>

