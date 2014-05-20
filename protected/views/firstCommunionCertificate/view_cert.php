<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */

	$pdf = #Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
		new CertTcPdf(				'P', 'cm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("First Communion Certificate");
	$pdf->SetSubject("First Communion Certificate");
	$pdf->SetKeywords("PDF");
	$parish = Parish::get();
	$pdf->setPrintHeader($parish->cert_header);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();
	if ($parish->cert_header) {
		$comm_src = dirname(__FILE__) . "/../../../images/holy-commn-remember.jpg";
		$pdf->Image($comm_src, 1, 6, '', 12, 'JPG', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
		$pdf->Cell(0,14,"",0,1);
	} else {
		$pdf->Cell(0,19,"",0,1);
	}
	$pdf->SetFont("times", "R", 20);
	$pdf->Cell(0,0,"Remembrance Of First Holy Communion",0,1,'C');
	$pdf->SetFont("courier", "I", 11);
	$firstCommunion = $model->firstCommunion;
	$pdf->Cell(0,1,'',0,1);

	$pdf->Cell(4,0,"",0,0);

$count = 0;

function draw_line($pdf,$x1=5.0) {
	global $count;
	$pdf->Line($x1,22.6+$count*0.8,16,22.6+$count*0.8,array('width' => 0.01, 'dash' => 3));
	++$count;
}

	$pdf->Cell(0,0.8,$firstCommunion->name,0,1,'L');
	draw_line($pdf);
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.8,"received First Holy Communion on " . $firstCommunion->communion_dt,0,1,'L');
	draw_line($pdf,12.7);
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.8,"in " . $parish->name,0,1,'L');
	draw_line($pdf,5.7);

	$pdf->Cell(0,1,'',0,1);
#	$pdf->Cell(10,1,'DATE: '.$model->cert_dt,0,1,'C');
	$pdf->Line(8,25.8,12,25.8,array('width'=>0.01, 'dash'=>3));
	$pdf->Cell(0,0,'P. Priest/Pastor                 ',0,0,'R');
	$id = $model->id;
	$pdf->Output("first-communion-cert-$id.pdf", "I");
	Yii::app()->end();

?>
