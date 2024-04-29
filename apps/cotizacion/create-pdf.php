<?php

require 'TCPDF-main/tcpdf.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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


    ob_start()

?>

    <table>

        <thead>
            <tr>
                <th>ID PRODUCTO</th>
                <th>FECHA</th>
                <th>CANTIDAD</th>
                <th>NOMBRE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_REQUEST['idr'])) {
                $idr = $_REQUEST['idr'];
            } else {
                $idr = 0;
            }

            $cadena23 = "SELECT a.id, a.id_req, a.id_producto, a.cantidad, 
            b.fecha, c.nombre FROM u116753122_cw3completa.ordrequisicion_detalle a 
            INNER JOIN u116753122_cw3completa.ordrequisicion b ON a.id_req = b.id 
            INNER JOIN u116753122_cw3completa.producto c ON a.id_producto = c.id_producto WHERE a.id_req = '$idr'";

            $resultadP23 = $conetar->query($cadena23);
            $numerfiles23 = mysqli_num_rows($resultadP23);
            if ($numerfiles23 >= 1) {
                while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            ?>
                    <tr>
                        <td><?php echo $filaP23['id_producto']; ?></td>
                        <td><?php echo $filaP23['fecha']; ?></td>
                        <td><?php echo $filaP23['cantidad']; ?></td>
                        <td><?php echo $filaP23['nombre']; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

<?php

    // Configura el documento
    $pdf->SetCreator('Tu Nombre');
    $pdf->SetAuthor('Tu Nombre');
    $pdf->SetTitle('Mi primer PDF con TCPDF');
    $pdf->SetSubject('Ejemplo de creación de PDF con TCPDF');

    // Agrega una página
    $pdf->AddPage();

    // Establece el contenido del PDF (HTML y/o texto)
    $pdf->writeHTML(ob_get_clean());

    $ruta = __DIR__ . '/files/cotizacion.pdf';

    // Cierra y genera el PDF
    $pdf->Output($ruta, 'F');
}

function sendMail(){
    
}

?>