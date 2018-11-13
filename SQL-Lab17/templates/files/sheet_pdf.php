<?php

include_once '../../inc/hoja_ejercicio.php';
$id = $_GET['sheet'];
$hojaejer = new HojaEjercicio();
$hojaName = $hojaejer->getHojaById($id);
$i=0;
$ejer[$i]='';
$result = $hojaejer->getHojasYEjerciciosById($id);
while ($fila = mysqli_fetch_array($result)) {
    $ejer[$i] = $fila['enunciado'];
    $i++;
    
}
ob_end_clean();

include_once '../../fpdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTitle('Hoja de Problemas',true);
$pdf->SetAuthor('SQLab',true);

class pdf extends FPDF 
{
    
    public function footer(){
        $this->SetFont('Arial','',9);
        $this->SetY(-15);
        $this->SetX(105);
        $this->Line(40, 281, 170, 281);
        $this->Write(5,$this->PageNo());
    }
    
    public function VariasLineas($cadena, $cantidad)
    {
        while (!(strlen($cadena)==''))
        {
            $subcadena = substr($cadena, 0, $cantidad);
            $this->Ln();
            $this->Cell(100,5,$subcadena);
            $cadena= substr($cadena,$cantidad);
        }
        $this->Cell(100,0,'');
    }  
}
$pdf = new pdf();
$pdf->AddPage();
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,10,'Base de Datos',0,1,'C');
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,1,'Hoja de Problemas: '.utf8_decode($hojaName),0,1,'C');
$pdf->SetLeftMargin(30);
$pdf->SetRightMargin(30);
$pdf->Ln(15);
$pdf->SetFont('Arial','',9);
$cantidad=105;
for($j=0; $j<$i; $j++){
    $h = $j+1;
    $pdf->VariasLineas(utf8_decode($h.'. '.$ejer[$j]), $cantidad);
    $pdf->Ln(12);
}

$pdf->Output('','',true);

?> 
