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
	$pdf->SetTitle("Marriage Certificate");
	$pdf->SetSubject("Marriage Certificate");
	$pdf->SetKeywords("PDF");
	$parish = Parish::get();
	$pdf->setPrintHeader($parish->cert_header);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont("times", "R", 22);
	$pdf->Cell(0,3,"",0,1);
	$pdf->Cell(0,0,"MARRIAGE CERTIFICATE",0,1,'C');
	$pdf->SetFont("times", "B", 11);
	$pdf->Cell(0,0,"EXTRACT FROM THE REGISTER OF MARRIAGES",0,1,'C');
	$pdf->SetFont("courier", "R", 11);
	$pdf->Cell(0,0.5,'',0,1);
	$pdf->Cell(3.5,0,'',0,0);
	$marriage = $model->marriage;
	$pdf->Cell(0,0,"REF. NO. ".$marriage->ref_no);
	$pdf->Cell(0,1.1,'',0,1);

$count = 0;

function draw_line($pdf) {
	global $count;
	$pdf->Line(10.2,7.6+$count*0.7,16,7.6+$count*0.7,array('width' => 0.01, 'dash' => 3));
	++$count;
}

function show_field($pdf, $label, $value) {
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.7,sprintf("%-20s: %s", strtoupper($label), strtoupper($value)),0,1,'L');
	draw_line($pdf);
}

function show_fval($pdf, $value) {
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.7,sprintf("%-20s  %s", "", strtoupper($value)),0,1,'L');
	draw_line($pdf);
}

	show_field($pdf, "Date of Marriage", $marriage->marriage_dt);
	show_field($pdf, "Name of Bridegroom", $marriage->groom_name);
	show_field($pdf, "DATE OF BIRTH/AGE", $marriage->groom_dob);
	show_field($pdf, "Groom Baptism Date", $marriage->groom_baptism_dt);
	show_field($pdf, "Status", FieldNames::value('marital_status', $marriage->groom_status));
	show_field($pdf, "Rank or Profession", $marriage->groom_rank_prof);
	show_field($pdf, "Name of father", $marriage->groom_fathers_name);
	show_field($pdf, "name of mother", $marriage->groom_mothers_name);
	show_field($pdf, "residence", $marriage->groom_residence);
	show_field($pdf, "Name of Bride", $marriage->bride_name);
	show_field($pdf, "DATE OF BIRTH/AGE", $marriage->bride_dob);
	show_field($pdf, "Bride Baptism Date", $marriage->bride_baptism_dt);
	show_field($pdf, "Status", FieldNames::value('marital_status', $marriage->bride_status));
	show_field($pdf, "Rank or Profession", $marriage->bride_rank_prof);
	show_field($pdf, "Name of father", $marriage->bride_fathers_name);
	show_field($pdf, "name of mother", $marriage->bride_mothers_name);
	show_field($pdf, "residence", $marriage->bride_residence);
	show_field($pdf, "by banns or licence", $marriage->banns_licence);
	show_field($pdf, "minister", $marriage->minister);
	show_field($pdf, "Witness 1", $marriage->witness1);
	show_field($pdf, "Witness 2", $marriage->witness2);
	$remarks = explode("\n", wordwrap($marriage->remarks, 39));
	show_field($pdf, 'Remarks', $remarks[0]);
	if (isset($remarks[1])) {
		show_fval($pdf, $remarks[1]);
	} else {
		draw_line($pdf);
	}

	$pdf->SetFont("courier", "R", 9);
	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(0,0,'I CERTIFY THAT THE ABOVE IS A TRUE COPY OF AN ENTRY IN THE REGISTER',0,1,'C');
	$pstr = strtoupper($parish->name . ", " . $parish->city);
	$pdf->Cell(0,0,"OF MARRIAGES KEPT AT $pstr",0,1,'C');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("courier", "R", 11);
	$pdf->Cell(10,1,'DATE: '.$model->cert_dt,0,1,'C');
	$pdf->Cell(0,0,'PARISH PRIEST             ',0,0,'R');
	$pdf->Line(13,26.1,18,26.1,array('dash' => 3, 'width' => 0.01));
	$mid = $model->id;
	$pdf->Output("marriage-cert-$mid.pdf", "I");
	Yii::app()->end();

?>
