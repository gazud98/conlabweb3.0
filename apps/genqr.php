<?php
 /*   //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__DIR__).'/appsdata/qr/';//;dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    if (!file_exists($PNG_TEMP_DIR)) { echo 'noexiste'; } //mkdir($PNG_TEMP_DIR);
    //html PNG location prefix
    $PNG_WEB_DIR = 'appsdata/qr/';
    include "../../assets/plugins/phpqrcode/qrlib.php";
    $filename = $PNG_TEMP_DIR.'qrgenerate.png';
    unlink($filename);
    //processing form input
    //remember to sanitize user input in real-life solution !!!-- 'L','M','Q','H'
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 3;  //de q q 10
  */  $xxnumber =rand().time();
  /*  if (isset($parametroacodificar)) {
        //it's very important!
        if (trim($parametroacodificar) == ''){
            echo "<img src='assets/image/qr.png?nocache=".$xxnumber."' style='width:100px; height:auto;'>";
        }else{
            QRcode::png($parametroacodificar, $filename, $errorCorrectionLevel, $matrixPointSize, 2);// user data
            echo '<img src="'.$PNG_WEB_DIR.basename($filename)."?nocache=".$xxnumber.'" style="width:100px; height:auto;"/>';
        }
    } else {
   */     echo "<img src='appsdata/qr/qr.png?nocache=".$xxnumber."' style='width:100px; height:auto;'>";//default data
  /*  }

/* */
?>
