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
	$pdf->SetFont("times", "R", 16);
	$pdf->Cell(0,6,"",0,1);
	$pdf->Cell(8,0,'',0,0);
	$pdf->Cell(0,0,"    This certifies that",0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(8,0,'',0,0);
	$confirmation = $model->confirmation;
	$pdf->SetFont("courier", "R", 14);
	$pdf->Cell(0,0.8,$confirmation->name,0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("times", "R", 12);
	$pdf->Cell(9,0,'',0,0);
	$pdf->Cell(0,0,"    received",0,1,'L');
	$pdf->Cell(0,0.8,'',0,1);
	$pdf->SetFont("times", "R", 16);
	$pdf->Cell(8,0,'',0,0);
	$pdf->Cell(0,0,"The Holy Sacrament of",0,1,'L');
	$pdf->Cell(0,0.6,'',0,1);
	$pdf->Cell(8,0,'',0,0);
	$pdf->SetFont("times", "R", 26);
	$pdf->Cell(0,0,"Confirmation",0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(8,0,'',0,0);
	$pdf->SetFont("times", "R", 14);
	$dt = explode('-', $confirmation->confirmation_dt);
	$month = date_format(new DateTime($confirmation->confirmation_dt),'F');

function th($dt) {
	$dt = intval($dt);
	$ldig = $dt % 10;
	if ($ldig > 3 and $ldig <= 9 or $ldig == 0) {
		return strval($dt) . "th";
	} else {
		$sldig = $dt / 10 % 10;
		if ($sldig == 1) {
			return strval($dt) . "th";
		} else {
			switch ($ldig) {
				case 1: return strval($dt) . "st";
				case 2: return strval($dt) . "nd";
				case 3: return strval($dt) . "rd";
			}
		}
	}
}

	$pdf->Cell(0,0,"on the ".th($dt[2])." day of $month",0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(9,0,'',0,0);
	$pdf->SetFont("times", "R", 18);
	$pdf->Cell(0,0,$dt[0],0,1,'L');
#	$pdf->Cell(0,0,"on the ",0,0,'L');
#	$pdf->Cell(0,0,$dt[2],0,0,'L');
#	$pdf->Cell(0,0,"th day of",0,0,'L');
#	$pdf->Cell(0,0,$month,0,0,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(8,0,'',0,0);
	$pdf->Cell(0,0,"in the Church of",0,1,'L');
	$pdf->Cell(0,1,'',0,1);

	$pdf->Cell(8,0,'',0,0);
	$pdf->Cell(0,0.8,$confirmation->church,0,1,'L');

	$pdf->Cell(0,3,'',0,1);
#	$pdf->Cell(10,1,'DATE: '.$model->cert_dt,0,1,'C');
	$pdf->Cell(0,0,'Bishop                          ',0,0,'R');
	$id = $model->id;
	$pdf->Output("confirmation-cert-$id.pdf", "I");
	Yii::app()->end();

?>
