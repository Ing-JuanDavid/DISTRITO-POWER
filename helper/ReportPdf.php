<?php
namespace Helper;

require __DIR__.'/../libs/tfpdf/tfpdf.php';


class ReportPdf
{
    private $pdf;

    public function __construct()
    {
        $this->pdf = new \tFPDF();
        $this->pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->SetFont('DejaVu', '', 12);
    }

    public function addHeader($title = 'Reporte de Pagos', $logo = null)
    {
        if ($logo) {
            $this->pdf->Image($logo, 10, 6, 30);
        }
        $this->pdf->SetFont('DejaVu', 'B', 15);
        $this->pdf->Cell(80);
        $this->pdf->Cell(30, 10, $title, 0, 0, 'C');
        $this->pdf->Ln(20);
    }

    public function addFooter()
    {
        // Se puede usar si haces una subclase para sobrescribir Footer
        $this->pdf->SetY(-15);
        $this->pdf->SetFont('DejaVu', '', 8);
        $this->pdf->Cell(0, 10, 'Página '.$this->pdf->PageNo().'/{nb}', 0, 0, 'C');
    }

    public function addGeneratedDate()
    {
        $this->pdf->Cell(0, 10, 'Generado el: '.date('Y-m-d H:i'), 0, 1, 'R');
        $this->pdf->Ln(5);
    }

    public function addPaymentTable($header, $data, $total)
    {
        $this->pdf->SetFillColor(52,152,219);
        $this->pdf->SetTextColor(255);
        $this->pdf->SetDrawColor(41,128,185);
        $this->pdf->SetLineWidth(.3);
        $this->pdf->SetFont('','B');

        $w = array(30, 40, 35, 40, 40);

        foreach ($header as $i => $col) {
            $this->pdf->Cell($w[$i], 7, $col, 1, 0, 'C', true);
        }
        $this->pdf->Ln();

        $this->pdf->SetFillColor(240,240,240);
        $this->pdf->SetTextColor(0);
        $this->pdf->SetFont('');

        $fill = false;
        foreach ($data as $row) {
            $this->pdf->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->pdf->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->pdf->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
            $this->pdf->Cell($w[3],6,'$'.$row[4],'LR',0,'C',$fill);
            $this->pdf->Cell($w[4],6,$row[3],'LR',0,'C',$fill);
            $this->pdf->Ln();
            $fill = !$fill;
        }

          // Al final del método:
        $this->pdf->SetFont('', 'B');
        $this->pdf->Cell($w[0] + $w[1] + $w[2], 7, 'TOTAL', 1, 0, 'R', true);
        $this->pdf->Cell($w[3], 7, '$' . number_format($total), 1, 0, 'R', true);
        $this->pdf->Cell($w[4], 7, '', 1, 0, 'R', true);
    }

    public function output($name = 'reporte.pdf', $dest = 'I')
    {
        $this->pdf->Output($dest, $name);
    }
}



