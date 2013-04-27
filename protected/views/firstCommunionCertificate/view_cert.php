<?php
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */

	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
								'P', 'cm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("First Communion Certificate");
	$pdf->SetSubject("First Communion Certificate");
	$pdf->SetKeywords("PDF");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont("times", "R", 19);
	$pdf->Cell(0,19,"",0,1);
	$pdf->Cell(0,0,"Remembrance Of First Holy Communion",0,1,'C');
	$pdf->SetFont("courier", "I", 11);
	$firstCommunion = $model->firstCommunion;
	$pdf->Cell(0,1,'',0,1);

	$pdf->Cell(4,0,"",0,0);

$count = 0;

function date_ind($dt) {
	return date_format(new DateTime($dt), 'd/m/Y');
}

function draw_line($pdf,$x1=5.0) {
	global $count;
	$pdf->Line($x1,22.6+$count*0.8,16,22.6+$count*0.8,array('width' => 0.01, 'dash' => 3));
	++$count;
}

	$pdf->Cell(0,0.8,$firstCommunion->name,0,1,'L');
	draw_line($pdf);
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.8,"received First Holy Communion on " . date_ind($firstCommunion->communion_dt),0,1,'L');
	draw_line($pdf,12.7);
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.8,"in " . Yii::app()->params['parishName'],0,1,'L');
	draw_line($pdf,5.7);

	$pdf->Cell(0,1,'',0,1);
#	$pdf->Cell(10,1,'DATE: '.$model->cert_dt,0,1,'C');
	$pdf->Line(8,25.8,12,25.8,array('width'=>0.01, 'dash'=>3));
	$pdf->Cell(0,0,'P. Priest/Pastor                 ',0,0,'R');
	$id = $model->id;
	$pdf->Output("first-communion-cert-$id.pdf", "I");
	Yii::app()->end();

?>
