<?php

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include '../conn/connn.php';

$number_ot = $_GET['ot_number'];

$today = date("Y-m-d H:i:s");

// Se inicializan las opciones de dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

// Se crea una instancia de dompdf
$dompdf = new Dompdf($options);
$dompdf->setPaper('A4', 'portrait');

$today = date('Y-m-d', time());
$created_at = $_GET['created_at'];




$palabra = "&nbsp;"; // Tu palabra a repetir
$espacioBlancoCliente = "";
$espacioBlancoContacto = "";

$longitudPalabraCliente = strlen($_GET['client_name'], 'UTF-8');
$longitudPalabraContacto = strlen($_GET['contact_name']);

// Establecer la cantidad de repeticiones basado en la longitud de la palabra
$cantidadRepeticiones = 69 - $longitudPalabraCliente + 1;
for ($i = 0; $i < $cantidadRepeticiones; $i++) {
    $espacioBlancoCliente .= $palabra . " ";
}

// Establecer la cantidad de repeticiones basado en la longitud de la palabra
$cantidadRepeticiones = 79 - $longitudPalabraContacto + 1;
for ($i = 0; $i < $cantidadRepeticiones; $i++) {
    $espacioBlancoContacto .= $palabra . " ";
}




$imageUrl = '../img/SC-INFORMATICA(LOGO).png';
$imageData = file_get_contents($imageUrl);
$base64Image = 'data:image/png;base64,' . base64_encode($imageData);


// Contenido HTML que será convertido a PDF
$html = '
<html>
<head>
    <style>
    @font-face {
        font-weight: bold;
        font-style: normal;
    }
    body {
        margin: 0;
        padding: 0;
        color: #333;
        font-size: 14px;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .texto {
        text-align: left;
    }

    .texto p,
    h2 {
        margin: 1px;
        font-weight: bold;
    }

    .titulo h3 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 3px;
        font-size: 11px;
    }

    th {
        background-color: #f2f2f2;
    }

    .info-tabla-adicional p {
        margin-bottom: 3px;
        font-size: 12px;
        font-weight: bold;
    }

    .datos-vendedor,
    .datos-del-pago,
    .info-extra {
        margin-top:10px;
        margin-bottom: 20px;
    }

    .datos-del-pago {
        display: grid;
        grid-template-columns: max-content max-content;
        grid-gap: 10px;
        background-color: #f2f2f2;
        /* Color similar al de las tablas */
        padding: 10px;
        border: 1px solid #ddd;
        /* Borde similar al de las celdas de la tabla */
    }

    .datos-del-pago p {
        margin: 0;
    }

    .datos-vendedor p,
    .datos-del-pago p,
    .info-extra p {
        margin: 2px;
        font-size: 13px;
    }

    .nombre-vendedor {
        font-weight: bold;
    }

    .condicion-pago {
        font-weight: bold;
    }

    .observaciones {
        color: #888;
        font-size: 12px;
    }

    .info-extra p:first-child {
        margin-top: 0;
    }

    @media print {
        body {
            color: #000;
        }

        .container {
            box-shadow: none;
        }
    }

    @page {
        margin-top: 4.2cm;
        margin-bottom: 1.1cm;
    }

    #header {
        position: fixed;
        margin-top: -4.2cm;
        left: 0cm;
        flex-grow: 1;
    }

    .imgHeader {
        float: right;
        width: 6cm;
        margin-right: -13cm;
    }

    .infoHeader {
        float: left;
        margin-left: 0px;
    }

    #footer {
        position: fixed;
        bottom: -2;
        left: 0;
        right: 0;
    }


    .textFooter {
        text-align: center;
    }

    .infoHeader h3,
    .infoHeader p {
        line-height: 1;
        margin: 3px;
    }

    .infoCliente h4,
    .infoCliente p {
        line-height: 1;
        margin: 3px;
        font-weight: bold;
    }

    tr:nth-child(14n) {
        page-break-after: always;
    }

    .firma-cliente {
        font-size: 14px;
        margin-top: 20px;
        line-height: 1.5;
    }

    .firma-cliente span {
        border-bottom: 1px solid #000;
        padding-bottom: 2px;
        margin-right: 20px;
        margin-right: 5px; /* Ajusta este valor según tu preferencia */
        margin-left: 5px;
    }
    </style>
</head>
<body>

    <div id="header" class="header">
        <div class="infoHeader">
            <img src="' . $base64Image . '" alt="Logo" style="width: 130px; height: auto; margin: 5px;">
            <h3>Número de orden : ' . $_GET['ot_number'] . '</h3>
            <p>Cliente: ' . $_GET['client_name'] . '</p>
            <p>Sucursal: ' . $_GET['name_branch'] . ' ' . $_GET['location'] . '</p>
            <p>Encargado: ' . $_GET['leader'] . '</p>
            <p>Fecha de orden: ' . $created_at . ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Fecha de documento: ' .  $today . '</p>
        </div>
    </div>

    <div id="footer">
        <div class="datos-del-pago">
            <p class="condicion-pago">Teléfono: 02-8864200 ' . $espacioBlancoCliente . ' Nombre Cliente: ' . $_GET['client_name'] . '</p>
            <p class="condicion-pago">Fax: 02-8840171  ' . $espacioBlancoContacto . ' Contacto: ' . $_GET['contact_name'] . ' </p>
            <p class="condicion-pago">Email: servicios@scinformatica.cl</p>
            <p class="firma-cliente">Firma Scinformatica &nbsp; ________________________ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Firma cliente &nbsp; ________________________</p>
        </div>
    </div>

    <div class="datos-del-pago">
        <h2>Detalles de la orden:</h2>
        <p>Requerimiento: ' . $_GET['description'] . '</p>
    </div>

    <div>
        <h2>Ha realizar:</h2> <br>
        <table border="1">
            <tr>
                <th>Modelo</th>
                <th>Número de serie</th>
                <th>Tarea</th>
            </tr>';

$i = 1;
$sel2 = $con->query("SELECT * FROM tasks_equipments WHERE number_ot = '$number_ot' ");

while ($f = $sel2->fetch_assoc()) {
    $id_task = $f['id_tasks'];
    $id_equipment = $f['id_equipment'];
    $sel3 = $con->query("SELECT  name FROM tasks WHERE id = '$id_task' ");
    $sel4 = $con->query("SELECT series_number FROM equipment WHERE id = '$id_equipment'");
    $sel_inner = $con->query("SELECT id_model FROM equipment WHERE id = '$id_equipment'");

    while ($k = $sel4->fetch_assoc()) {
        while ($u = $sel_inner->fetch_assoc()) {
            $id_modelo = $u['id_model'];
            $sel_name = $con->query("SELECT name FROM model WHERE id = '$id_modelo'");
            while ($p = $sel_name->fetch_assoc()) {
                $model_name = $p['name'];
            }
        }
        $html .= '
            <tr>
                <td>' . $model_name . '</td>
                <td>' . $k['series_number'] . '</td>';

        while ($j = $sel3->fetch_assoc()) {
            $task_name = $j['name'];
            $html .= '<td>' . $task_name . '</td></tr>';

            $i++;

            if ($i == 8 or $i == 30) {
                $html .= '</table></div><div style="page-break-before: always;"></div>';
            }
        }
    }
}

$html .= '
</table>
    </div>

    <div class="datos-del-pago">
        <h2>Comentario técnico:</h2>
        <p>' . $_GET['comment'] . '</p>
    </div>';

$sel_advances = $con->query("SELECT * FROM advances WHERE ot_number = '$number_ot' ");
$row = mysqli_num_rows($sel_advances);

$u = 0;
if ($row != 0) {
    $html .= '<div style="page-break-before: always;"></div> <br>';
    $html .= '<h2>Lista de avances</h2>';

    while ($pk = $sel_advances->fetch_assoc()) {
        $fecha = $pk['created_at'];

        $html .= '
        <div class="datos-del-pago">
            <p>' . $pk['comment'] . '</p>
        </div>';

        $u++;
        if ($u == 4 or $u == 8 or $u == 12) {
            $html .= '<div style="page-break-before: always;"></div>';
        }
    }
}

$html .= '</body></html>';

$dompdf->loadHtml($html);

// Renderiza el PDF (output a pantalla)
$dompdf->render();

// Salva el contenido en un archivo PDF en el servidor
$dompdf->stream('output.pdf', array('Attachment' => 0));
