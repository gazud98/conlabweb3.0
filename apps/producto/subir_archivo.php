<?php if (file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
} // echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
?>
    <div id="upload">
        <?php

        /*$directorio_destino = "/cw3/appsdata/producto/";
        $directorio = "/cw3/appsdata/producto/";

        $nombre_archivo = $_FILES["archivo"]["name"];
        $ruta_temporal = $_FILES["archivo"]["tmp_name"];
        $id = $_GET['id'];
        $ruta_completa = $directorio_destino . $nombre_archivo;

        if (file_exists($ruta_completa)) {
            echo "El archivo ya existe.";
        } else  if (move_uploaded_file($ruta_temporal, $ruta_completa)) {
            echo "El archivo ha sido cargado correctamente.";
            $sql = "INSERT INTO productos_archivo (id_producto,nombre_archivo, ruta)VALUES ('" . $id . "','" . $nombre_archivo . "', '" . $directorio . "')";

            $rest = mysqli_query($conetar, $sql);
        } else {
            echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        }*/


        $id = "";

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $directorio = "apps/producto/public/";

        if (isset($_FILES['file'])) {
            if (($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/png")
                || ($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "application/pdf")
            ) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], "public/" . $_FILES['file']['name'])) {
                    echo 'si';

                    $nombre = $_FILES["file"]["name"];
                    $url = $directorio;

                    $sql = "INSERT INTO productos_archivo (id_producto,nombre_archivo, ruta)VALUES ('" . $id . "','" . $nombre . "', '" . $url . "')";

                    $rest = mysqli_query($conetar, $sql);
                } else {
                    echo 'no';
                }
            }
        }


        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            function cargar() {
                $('#upload').load('https://cw3.tierramontemariana.org/apps/producto/form-files.php?id=<?php echo $id ?>');
            }
          

        });
    </script>
<?php } ?>