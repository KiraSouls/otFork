<?php
require '../fpdf/fpdf.php';

class PDF extends FPDF
{

    function Header()
    {
        //$sucursal= $_GET['client_name'];

        $today = date('Y-m-d', time());
        $this->Image('http://scinformatica.cl/site/public/img/banner/logo-large.png', '5', '5', 30);
        $this->SetFont('Arial', '', 9);
        $this->Cell(30);
        $this->Cell(120, 10, utf8_decode('Informe técnico'), 0, 0, 'C');
        $this->Ln(15);

        $this->Cell(70, 6, utf8_decode('Número de orden: ' . $_GET['ot_number']), 0, 0, 'L', 0);
        $this->Cell(50, 6, ' ', 0, 0, 'C', 0);
        $this->Cell(70, 6, ' ', 0, 1, 'C', 0);
        $this->Cell(70, 6, utf8_decode('Cliente:                   ' . $_GET['client_name']), 0, 0, 'L', 0);
        $this->Cell(50, 6, ' ', 0, 0, 'C', 0);
        $this->Cell(70, 6, ' ', 0, 1, 'C', 0);
        $this->Cell(70, 6, utf8_decode('Sucursal:                ' . $_GET['name_branch'] . ' ' . $_GET['location']), 0, 0, 'L', 0);
        $this->Cell(50, 6, ' ', 0, 0, 'C', 0);
        $this->Cell(70, 6, ' ', 0, 1, 'C', 0);
        $this->Cell(70, 6, utf8_decode('Encargado:             ' . $_GET['leader']), 0, 0, 'L', 0);
        $this->Cell(50, 6, ' ', 0, 0, 'C', 0);
        $this->Cell(70, 6, ' ', 0, 1, 'C', 0);
        $this->Cell(70, 6, 'Fecha de orden:     ' . $_GET['created_at'] . ' ', 0, 0, 'L', 0);
        $this->Cell(50, 6, ' ', 0, 0, 'C', 0);
        $this->Cell(70, 6, 'Fecha de documento:' . " " . $today, 0, 1, 'C', 0);

        $this->Ln(15);
    }


    function Footer()
    {
        $this->SetY(-40);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(100, 6, utf8_decode('Teléfono: 02-8864200'), 0, 0, 'L', 0);
        $this->Cell(10, 6, ' ', 0, 0, 'C', 0);
        $this->Cell(160, 6, utf8_decode('Nombre Cliente: ' . $_GET['client_name']), 0, 1, 'L', 0);

        $this->Cell(100, 6, 'Fax: 02-8840171', 0, 0, 'L', 0);
        $this->Cell(10, 6, '', 0, 0, 'C', 0);
        $this->Cell(160, 6, utf8_decode('Contacto: ' . $_GET['contact_name']), 0, 1, 'L', 0);

        $this->Cell(70, 6, 'Email: servicios@scinformatica.cl', 0, 0, 'L', 0);
        $this->Cell(10, 6, '', 0, 0, 'C', 0);
        $this->Cell(70, 6, ' ', 0, 1, 'L', 0);
        $this->Cell(70, 6, '', 0, 0, 'L', 0);
        $this->Cell(10, 6, '', 0, 0, 'C', 0);
        $this->Cell(70, 6, '', 0, 1, 'L', 0);

        $this->Cell(70, 6, 'Firma Scinformatica_______________', 0, 0, 'L', 0);
        $this->Cell(40, 6, '', 0, 0, 'C', 0);
        $this->Cell(70, 6, 'Firma cliente_________________', 0, 0, 'R', 0);
    }
}