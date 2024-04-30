<?php

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
    $id = $_REQUEST['id'];
    $cant = $_REQUEST['cant'];
    
    $bd = $_REQUEST['cant'];
    $std = $_REQUEST['std'];
    $et = $_REQUEST['et'];
    $fv = $_REQUEST['fv'];
    $nlo = $_REQUEST['nlo'];
    
    $cadena23 = "SELECT p.id_producto,p.referencia,p.lote,p.marca,p.nombre,c.descripcion,p.fecha_vencimiento 
    FROM u116753122_cw3completa.producto p, u116753122_cw3completa.condicion_almacenaje c WHERE id_producto = '$id'
    AND c.id_condicion_almacenaje = p.id_condicion_almacenaje";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $id_producto = trim($filaP23['id_producto']);
            $referencia = trim($filaP23['referencia']);
            $lote = trim($filaP23['lote']);
            $nombre = trim($filaP23['nombre']);
            $marca = trim($filaP23['marca']);
            $descripcion = trim($filaP23['descripcion']);
            $fecha_vencimiento = trim($filaP23['fecha_vencimiento']);
        }
    }
}
ob_start();
?>

<?php

$pdfContent = ob_get_clean();

require_once  'TCPDF-main/tcpdf.php';

$aux = 1;

$medidas = array(104, 60); // Ajustar aqui segun los milimetros necesarios;
$pdf = new TCPDF('L', 'mm', 'Letter', $medidas, true, 'UTF-8', false);

// Configura el documento

$pdf->SetTitle('tags-' . $id);
$pdf->setMargins(35, 5, 32);

// Agrega una página
for ($i = 0; $i < $cant; $i++) {

    $pdf->AddPage();

    // Establece el contenido del PDF (HTML y/o texto)
    //$pdf->writeHTML($pdfContent);

    $style = array(
        'position' => 'C',
        'align' => 'C',
        'stretch' => true,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => false, //array(255,255,255),
        'text' => true,
        'font' => 'helvetica',
        'fontsize' => 20,
        'stretchtext' => 0
    );

    $x = 100; // posición X
    $y = 0; // posición Y
    $w = 100; // ancho de la imagen
    $h = 0; // altura automática (0 para mantener la proporción original)

    //$pdf->Image(dirname(__FILE__) . '/image/logo.png', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
    $pdf->Image(dirname(__FILE__) . '/image/logo.png', $x, $y, $w, $h, 'PNG', '', '', false, 300, '', false, false, 0);
    $pdf->SetFont('helvetica', 'B', 25);
    $pdf->Cell(35, 5, '', 0, 1, '', '', true);
    $pdf->Cell(35, 5, '', 0, 1, '', '', true);
    $pdf->Cell(35, 5, 'Nombre: ' . $nombre, 0, 1, '', '', true);
    $pdf->Cell(35, 5, 'Referencia: ' . $referencia .'   Lote:'.$nlo.'' , 0, 1, '', '', true);
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->Cell(35, 5, 'Bodega: ' . $bd .'   Estante:'.$std.'   Entrepaño:'.$et , 0, 1, '', '', true);
    //$pdf->Cell(35, 5,'Fabricante.:'.$marca.'   Lote.:'.$lote.'', 0, 1,'','',true);
    //$pdf->Cell(55, 5,'Nivel de seguridad en nevera.:', 0, 1,'','',true);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(35, 5, '', 0, 1, '', '', true);
    $pdf->write1DBarcode($id, 'C39', '', '', '', 37, 1.5, $style, 'N');
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(35, 5, '', 0, 1, '', '', true);
    $pdf->SetFont('helvetica', 'B', 25);
    //$pdf->Cell(35, 5, 'Con./almacenamiento: ' . $descripcion . '', 0, 1, '', '', true);
    $pdf->Image(dirname(__FILE__) . '/image/reloj.png', 38, 105, 10, 0, 'PNG', '', '', false, 300, '', false, false, 0);
    //$pdf->Image(dirname(__FILE__) . '/image/congelador.png', 205, 108, 8, 0, 'PNG', '', '', false, 300, '', false, false, 0);
    $pdf->Cell(35, 5, '       ' . $fv . '                   ' . $descripcion . '', 0, 1, '', '', true);
}

//$pdf->Ln();

$ruta = __DIR__ . '/files/factura.pdf';

// Cierra y genera el PDF
$pdf->Output($ruta, 'F');

?>

<div style="width: 100%; text-align:center;">
    <a  style="
    position: abosolute;
    padding: 15px; 
    background:#DCE1F3;
    width:200px !important;
    text-decoration:none;
    font-weight:700;
    font-size:25px;
    top:50% !important;
    left:50%;
    " href="/cw3/conlabweb3.0/apps/csltaordcompra/files/factura.pdf">Imprimir Etiquetas</a>
</div>