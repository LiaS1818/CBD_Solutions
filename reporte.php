<?php

require 'vendor/autoload.php';

use App\Usuario;
use App\Producto;

    session_start();
    $id_sesion = session_id();
    $user = Usuario::findByUser($_SESSION['id']);
    $productos = Producto::obtenerCantidadProductos($id_sesion);

use Fpdf\Fpdf;


class PDF extends Fpdf
{
// Page header
function Header()
{
    // Logo
    $this->Image('img/logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // // Position at 1.5 cm from bottom
    // $this->SetY(-15);
    // // Arial italic 8
    // $this->SetFont('Arial','I',8);
    // // Page number
    // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage(); //A{ade la pagina en blanco
$pdf->SetFont('Times','',12);

foreach( $productos as $acciones ):

      echo $acciones->id_producto; 
      echo $acciones->nombre; 
      echo $acciones->precio; 
      echo $acciones->imagen; 
 
 endforeach; 

// $pdf->Image('img/logo.png', 10, 8, 33); //imagen(archivo, png/jpg, x, y)
$pdf->Ln(50);
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,utf8_decode('Imprimiendo linea número'),0,1);
$pdf->Output();