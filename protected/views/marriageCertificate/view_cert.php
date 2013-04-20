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
	$pdf->Cell(0,6,"",0,1);
	$pdf->Cell(0,0,"MARRIAGE CERTIFICATE",0,1,'C');
	$pdf->SetFont("times", "B", 11);
	$pdf->Cell(0,0,"EXTRACT FROM THE REGISTER OF MARRIAGES",0,1,'C');
	$pdf->SetFont("courier", "R", 11);
	$marriage = $model->marriage;
	$pdf->Cell(0,0.6,'',0,1);

function show_field($pdf, $label, $value) {
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.7,sprintf("%-20s: %s", strtoupper($label), strtoupper($value)),0,1,'L');
}

	show_field($pdf, "Date of Marriage", $marriage->marriage_dt);
	show_field($pdf, "Name of Bridegroom", $marriage->groom_name);
	show_field($pdf, "DATE OF BIRTH/AGE", $marriage->groom_dob);
	show_field($pdf, "Status", $marriage->groom_status);
	show_field($pdf, "Rank or Profession", $marriage->groom_rank_prof);
	show_field($pdf, "Name of father", $marriage->groom_fathers_name);
	show_field($pdf, "name of mother", $marriage->groom_mothers_name);
	show_field($pdf, "residence", $marriage->groom_residence);
	show_field($pdf, "Name of Bride", $marriage->bride_name);
	show_field($pdf, "DATE OF BIRTH/AGE", $marriage->bride_dob);
	show_field($pdf, "Status", $marriage->bride_status);
	show_field($pdf, "Rank or Profession", $marriage->bride_rank_prof);
	show_field($pdf, "Name of father", $marriage->bride_fathers_name);
	show_field($pdf, "name of mother", $marriage->bride_mothers_name);
	show_field($pdf, "residence", $marriage->bride_residence);
	show_field($pdf, "by banns or licence", ucfirst($marriage->banns_licence));
	show_field($pdf, "minister", $marriage->minister);
	show_field($pdf, "Witness 1", $marriage->witness1);
	show_field($pdf, "Witness 2", $marriage->witness2);
	show_field($pdf, 'Remarks', $marriage->remarks);

	$pdf->SetFont("courier", "R", 9);
	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(0,0,'I CERTIFY THAT THE ABOVE IS A TRUE COPY OF AN ENTRY IN THE',0,1,'C');
	$pdf->Cell(0,0,'REGISTER OF MARRIAGES KEPT AT HOLY REDEEMER CHURCH, BANGALORE',0,1,'C');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("courier", "R", 11);
	$pdf->Cell(10,1,'DATE: '.$model->cert_dt,0,1,'C');
	$pdf->Cell(0,0,'PARISH PRIEST          ',0,0,'R');
	$mid = $model->id;
	$pdf->Output("marriage-cert-$mid.pdf", "I");
	Yii::app()->end();

?>
