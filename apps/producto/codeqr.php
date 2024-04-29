<?php
// Incluir la biblioteca PHP QR Code
require 'phpqrcode/qrlib.php';

// Contenido del código QR


// Nombre del archivo de imagen QR
$archivo_qr = 'qr_code.png';

// Tamaño y nivel de corrección del código QR
$tamaño = 10;
$level = 'L'; // Puede ser L, M, Q o H

// Generar el código QR
QRcode::png("ss", $archivo_qr, $level, $tamaño);

// Mostrar la imagen generada
echo '<img src="' . $archivo_qr . '" alt="Código QR">';
