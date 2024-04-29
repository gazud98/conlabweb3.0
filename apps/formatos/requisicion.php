<?php
if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    $cadena = "SELECT nombre_empresa, ciudad, direccion,telefono,direccion_electronica
    FROM  u116753122_cw3completa.identificacion_empresa
    where 1=1";
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);

    $cadena2 = "SELECT CONCAT(p.nombre_1,' ',p.nombre_2,' ',p.apellido_1,' ',apellido_2) as nombre_solicitante
    FROM  u116753122_cw3completa.ordrequisicion od, u116753122_cw3completa.persona p
    where p.id_persona = od.id_persona and od.id =" . $id;
    $resultadP22 = $conetar->query($cadena2);
    $numerfiles22 = mysqli_num_rows($resultadP22);
    $filaP22 = mysqli_fetch_array($resultadP22);
    $nombre_solicitante = $filaP22['nombre_solicitante'];
    date_default_timezone_set('America/Bogota');
    $fechaActual = date("d/m/Y");

    if (isset ($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }

    $ide = 0;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cotización</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;

        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            color: #333;
        }

        .logo {
            width: 200px;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 30px;
        }

        .info p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .btns {
            text-align: center;
        }

        .btn1 {
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .current-date {
            font-weight: bold;

            /* Tamaño de fuente más pequeño */

            font-size: 14px;
            color: #666;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .solicitante {
            float: right;
            /* Alineación a la derecha */
            margin-left: 20px;

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class=" text-left">
                <img src="https://conlabweb3.tierramontemariana.org/assets/image/logo.png" alt="Logo" class="logo">
            </div>
            <h1>Solicitud de Cotización</h1>
        </div>
        <div class="info" style="display: flex; justify-content: space-between;">
            <?php while ($filaP2 = mysqli_fetch_array($resultadP2)) { ?>
                <div>
                    <p><strong>Dirección:</strong>
                        <?php echo $filaP2['direccion']; ?>
                    </p>
                    <p><strong>Ciudad:</strong>
                        <?php echo $filaP2['ciudad']; ?>
                    </p>
                    <p><strong>Teléfono:</strong>
                        <?php echo $filaP2['telefono']; ?>
                    </p>
                    <p><strong>Email:</strong>
                        <?php echo $filaP2['direccion_electronica']; ?>
                    </p>
                </div>
                <div>
                    <p><strong>Solicitante:</strong>
                        <?php echo $nombre_solicitante; ?>
                    </p>
                </div>
            <?php } ?>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Referencia</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cadena = "SELECT b.nombre,b.lote,b.referencia, a.cantidad
                FROM u116753122_cw3completa.producto b, u116753122_cw3completa.ordrequisicion_detalle a, u116753122_cw3completa.ordrequisicion od
                where a.id_producto = b.id_producto
                and od.id = a.id_req and a.id_req = '$id'";
                $resultadP3 = $conetar->query($cadena);
                $numerfiles3 = mysqli_num_rows($resultadP3);
                while ($filaP3 = mysqli_fetch_array($resultadP3)) { ?>
                    <tr>
                        <td>
                            <?php echo $filaP3['nombre']; ?>
                        </td>
                        <td>
                            <?php echo $filaP3['referencia']; ?>
                        </td>
                        <td>
                            <?php echo $filaP3['cantidad']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <p id="current-date" class="current-date"></p>


    </div>
    <div class="btns">
        <button class="btn1" onclick="genPDF()"><i class="fa-solid fa-file-arrow-down"></i>&nbsp;&nbsp;Descargar PDF</button>
        <a href="https://conlabweb3.tierramontemariana.org/apps/listasolicitud/modal.php?aux=1&id=<?php echo $id; ?>"
            target="_blank" class="btn1"><i class="fa-solid fa-print"></i>&nbsp;&nbsp;Imprimir</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function genPDF() {
            const element = document.querySelector('.container');
            html2pdf().from(element).save();
        }
        function updateDate() {
            const now = new Date();
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            const currentDate = now.toLocaleDateString('es-ES', options);
            document.getElementById('current-date').textContent = 'Fecha: ' + currentDate;
        }

        // Ejecuta la función una vez al cargar la página para mostrar la fecha inicial
        updateDate();
    </script>
</body>

</html>