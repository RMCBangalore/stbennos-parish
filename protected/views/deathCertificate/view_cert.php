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

	$pdf = #Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
		new CertTcPdf(	'P', 'cm', 'A4', true, 'UTF-8');

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("Death Certificate");
	$pdf->SetSubject("Death Certificate");
	$pdf->SetKeywords("PDF");
	$parish = Parish::get();
	$pdf->setPrintHeader($parish->cert_header);
	$pdf->setPrintFooter(false);
	$pdf->AddPage();
	$pdf->SetFont("times", "R", 26);
	$pdf->Cell(0,5,"",0,1);
	$pdf->Cell(3,0,'',0,0);
	$pdf->Cell(0,0,"ROMAN CATHOLIC CEMETERY",0,1,'L');
	$pdf->SetFont("courier", "B", 16);
	$pdf->Cell(5,0,'',0,0);
	$pdf->Cell(0,1,"    PARTICULARS OF BURIAL",0,1,'L');
	$pdf->SetFont("courier", "R", 11);
	$death = $model->death;
	$pdf->Cell(0,1,"",0,1);
	$pdf->Cell(3.5,0,"",0,0);
	$pdf->Cell(0,0,"REF. NO.   " . $death->ref_no, 0,1,'L');
	$pdf->SetFont("courier", "R", 12);
	$pdf->Cell(0,1.9,"",0,1);

$count = 0;

function draw_line($pdf) {
	global $count;
	$pdf->Line(10.6,12.2+$count*0.8,16,12.3+$count*0.8,array('width' => 0.01, 'dash' => 3));
	++$count;
}

function show_field($pdf, $label, $value) {
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.8,sprintf("%-20s: %s", strtoupper($label), strtoupper($value)),0,1,'L');
	draw_line($pdf);
}

	show_field($pdf, 'DATE OF DEATH', $death->death_dt);
	show_field($pdf, 'CAUSE OF DEATH', $death->cause);
	show_field($pdf, 'CHRISTIAN NAME', $death->fname);
	show_field($pdf, 'SUR NAME', $death->lname);
	show_field($pdf, 'AGE', $death->age);
	show_field($pdf, 'PROFESSION', $death->profession);
	show_field($pdf, 'DATE BURIED', $death->buried_dt);
	show_field($pdf, 'minister', $death->minister);
	show_field($pdf, 'PLACE OF BURIAL', $death->burial_place);
	$pdf->Cell(0,4,"",0,1);
	$pdf->SetFont("courier", "R", 10);
	$pdf->Cell(0,0,"I CERTIFY THAT THE ABOVE IS TRUE COPY OF AN ENTRY IN THE REGISTER",0,1,'C');
	$pstr = strtoupper($parish->name . ", " . $parish->city);
	$pdf->Cell(0,0,"OF DEATHS KEPT AT $pstr",0,1,'C');

	$pdf->Cell(0,3,"",0,1);
	$pdf->Cell(10,1,'DATE: '.$model->cert_dt,0,0,'C');
	$pdf->Cell(0,1,'PARISH PRIEST          ',0,0,'R');
	#$pdf->AliasNbPages();
	$id = $model->id;
	$pdf->Output("death-cert-$id.pdf", "I");
	Yii::app()->end();

?>
