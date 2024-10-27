<?php
session_start();
require('../fpdf/fpdf.php');
require_once("../conexion/conexion.php");

$nameUser = $_SESSION["nombre"];
$fecha_actual = date("d-m-Y");

$queryTabla = "SELECT * FROM usuarios ORDER BY name";
$resultTabla = mysqli_query($conexion, $queryTabla) or die("Algo ha ido mal en la consulta a la base de datos" . " " . mysqli_error($conexion));

$fpdf = new FPDF();
$fpdf->AddPage('portrait', 'letter');

class pdf extends FPDF
{
    public function footer()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetY(-15);
        $this->SetTextColor(148, 150, 154);
        $this->write(5, 'prueba técnica');
        $this->SetX(-30);
        $this->SetFont('Arial', 'B', 10);
        $this->AliasNbPages('tpagina');
        $this->Write(5, $this->PageNo() . '/tpagina');
    }
}

// SE DECLARA EL REPORTE
$fpdf = new pdf('P', 'mm', 'letter', true);
$fpdf->AddPage('portrait', 'letter');

// INCIA ENCABEZADO
$fpdf->SetFont('Arial', 'B', 14);
$fpdf->SetTextColor(68, 78, 68);
$fpdf->SetX(40);
$fpdf->Ln();
$fpdf->SetX(40);
$fpdf->SetX(-80);
$fpdf->Cell(0, -5, 'Datos del reporte ', 0, 0, '');
$fpdf->Ln();

$fpdf->SetFont('Arial', 'B', 10);
$fpdf->SetY(20);
$fpdf->SetX(-80);
$fpdf->Cell(0, -10, 'fecha: ' . date("d-m-Y"), 0, 0, '');
$fpdf->Ln();

$fpdf->SetFont('Arial', 'B', 10);
$fpdf->SetY(25);
$fpdf->SetX(-80);
$fpdf->Cell(0, -10, 'Usuario: ' . $nameUser, 0, 0, '');
// TERMINA ENCABEZADO

// TITULO DE TABLA
$fpdf->SetFont('Arial', 'B', 14);
$fpdf->SetY(42);
$fpdf->SetTextColor(68, 78, 68);
$fpdf->SetFillColor(148, 150, 154);
$fpdf->cell(0, 7, 'Lista de usuarios', 0, 0, 'C');
$fpdf->SetDrawColor(148, 150, 154); 
$fpdf->SetLineWidth(2);
$fpdf->Line(70, $fpdf->GetY() + 8, 148, $fpdf->GetY() + 8); // funcion que pone una linea debajo del texto

$fpdf->SetTextColor(0, 0, 0);
$fpdf->Ln(15);
// TERMINA TITULO DE TABLA

// INICIA NOMBRE DE COLUMNAS DE TABLA
$fpdf->SetFontSize(10);
$fpdf->SetFont('Arial', 'B');
$fpdf->SetFillColor(255, 255, 255);
$fpdf->SetTextColor(68, 78, 68);
$fpdf->SetDrawColor(68, 78, 68);
$fpdf->cell(45, 10, 'Nombre', 0, 0, 'C', 1);
$fpdf->cell(30, 10, 'Télefono', 0, 0, 'C', 1);
$fpdf->cell(35, 10, 'Correo', 0, 0, 'C', 1);
$fpdf->cell(40, 10, 'RFC', 0, 0, 'C', 1);
$fpdf->cell(22, 10, 'Notas', 0, 0, 'C', 1);
$fpdf->SetDrawColor(148, 150, 154);
$fpdf->SetLineWidth(1);
$fpdf->Line(11, 65, 213, 65);
$fpdf->SetTextColor(0, 0, 0);
$fpdf->Ln(11);
//TERMINA NOMBRE DE COLUMNAS DE TABLA

//INICIA LLENADO DE LA TABLA
$fpdf->SetFillColor(240, 240, 240);
$fpdf->SetTextColor(40, 40, 40);
$fpdf->SetDrawColor(255, 255, 255);

while ($info = mysqli_fetch_assoc($resultTabla)) {
    $fpdf->cell(45, 10, $info['name'], 1, 0, 'C', 1);
    $fpdf->cell(30, 10, $info['telephone'], 1, 0, 'C', 1);
    $fpdf->cell(35, 10, $info['email'], 1, 0, 'C', 1);
    $fpdf->cell(40, 10, $info['rfc'], 1, 0, 'C', 1);
    $fpdf->cell(55, 10, $info['notes'], 1, 0, 'C', 1);
    $fpdf->Ln();
}

//TERMINA LLENADO DE LA TABLA

// EL NOMBRE CON EL QUE SE GUARDA EL REPORTE
$fpdf->OutPut('I', 'Lista Usuarios ' . date("d-m-Y") . '.pdf');
