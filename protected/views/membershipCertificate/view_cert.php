<?php

	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
								'P', 'cm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("Membership Certificate");
	$pdf->SetSubject("Membership Certificate");
	$pdf->SetKeywords("PDF");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont("times", "IU", 22);
	$pdf->Cell(0,6,"",0,1);
	$pdf->Cell(0,0,"Certificate",0,1,'C');
	$pdf->SetFont("times", "R", 16);
	$pdf->Cell(0,2,"",0,1);
	$pdf->Cell(2,0,'',0,0);
	$member = $model->member;
	$rel = ( 'Male' === FieldNames::value('sex', $member->sex) ) ? 'son' : 'daughter';
	$pdf->Cell(0,1,"    This is to certify that " . sprintf("%-40s", $member->fname . " " . $member->lname) . ", $rel of",0,1,'L');
	$father = $member->family->husband;
	$parent = "";
	if ('child' == $member->role) {
		if (isset($father)) {
			$parent = $father->fname . " " . $father->lname;
		}
	}
	$pdf->Cell(2,0,'',0,0);
	$pdf->Cell(0,1,"    of " . sprintf("%-40s", $parent) . " belongs to my Parish and",0,1,'L');

function draw_line($pdf, $y=20, $x1=8.5, $x2=16.0) {
	$pdf->Line($x1,$y-0.2,$x2,$y-0.2,array('width' => 0.01, 'dash' => 3));
}

	draw_line($pdf,11);
	$pdf->Cell(2,0,'',0,0);
	$pdf->Cell(0,0,"    is regular to Church services.",0,1,'L');
	draw_line($pdf,12,4.3,11.6);
	$pdf->Cell(0,4,'',0,1);
	$pdf->Cell(3,0,'',0,0);
	$pdf->SetFont("courier", "I", 11);

function date_ind($dt) {
	return date_format(new DateTime($dt), 'd/m/Y');
}

	draw_line($pdf,17.6,11.3,17.3);
	$pdf->Cell(0,1,'Date: '.date_ind($model->cert_dt),0,1,'L');
	$pdf->Cell(0,0,'Parish Priest or Assistant            ',0,0,'R');
	$id = $member->id;
	$pdf->Output("membership-cert-$id.pdf", "I");
	Yii::app()->end();
