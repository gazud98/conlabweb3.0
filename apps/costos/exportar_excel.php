<?php
// Obtener datos de la tabla HTML
$tableHTML = $_POST['tableHTML'];

// Crear un archivo Excel
$fileName = 'datos.xlsx';
$file = fopen($fileName, 'w');
fwrite($file, $tableHTML);
fclose($file);

// Devolver la ruta del archivo Excel generado
echo $fileName;
?>
