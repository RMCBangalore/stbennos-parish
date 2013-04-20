<?php
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */

	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
								'P', 'cm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("Marriage Certificate");
	$pdf->SetSubject("Marriage Certificate");
	$pdf->SetKeywords("PDF");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont("times", "R", 22);
	$pdf->Cell(0,5,"",0,1);
	$pdf->Cell(0,0,"BAPTISM CERTIFICATE",0,1,'C');
	$pdf->SetFont("times", "B", 11);
	$pdf->Cell(0,0,"TRUE EXTRACT",0,1,'C');
	$pdf->SetFont("courier", "R", 11);
	$baptism = $model->baptism;
	$pdf->Cell(0,2,'',0,1);

function show_field($pdf, $label, $value) {
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.8,sprintf("%-20s: %s", strtoupper($label), strtoupper($value)),0,1,'L');
}

	show_field($pdf, "Name", $baptism->name);
	show_field($pdf, "sex", isset($baptism->sex) ? FieldNames::value('sex', $baptism->sex) : '');
	show_field($pdf, "DATE OF BIRTH", $baptism->dob);
	show_field($pdf, "Date of baptism", $baptism->baptism_dt);
	show_field($pdf, "Name of father", $baptism->fathers_name);
	show_field($pdf, "name of mother", $baptism->mothers_name);
	show_field($pdf, "Name of godfather", $baptism->godfathers_name);
	show_field($pdf, "name of godmother", $baptism->godmothers_name);
	show_field($pdf, "residence", $baptism->residence);
	show_field($pdf, "minister of baptism", $baptism->minister);
	show_field($pdf, "confirmed on", "no entry");
	show_field($pdf, "married to", "no entry");
	show_field($pdf, "remarks", "no entry");

	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(0,0,'I CERTIFY THAT THE ABOVE IS A TRUE COPY OF AN ENTRY IN THE',0,1,'C');
	$pdf->Cell(0,0,'REGISTER OF BAPTISM KEPT AT HOLY REDEEMER CHURCH, BANGALORE',0,1,'C');
	$pdf->Cell(0,2,'',0,1);
	$pdf->SetFont("courier", "R", 11);
	$pdf->Cell(10,1,'DATE: '.$model->cert_dt,0,1,'C');
	$pdf->Cell(0,0,'PARISH PRIEST          ',0,0,'R');
	$mid = $model->id;
	$pdf->Output("baptism-cert-$mid.pdf", "I");
	Yii::app()->end();

?>
