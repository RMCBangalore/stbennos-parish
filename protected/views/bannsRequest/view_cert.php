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

	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
								'P', 'cm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("Banns Request");
	$pdf->SetSubject("Banns Request");
	$pdf->SetKeywords("PDF");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();

$line = 0;

function draw_line($pdf, $x1 = 0, $x2 = 14.9) {
	global $line;
	$pdf->Line(3.1+$x1,10.4+$line*0.8,3.1+$x2,10.4+$line*0.8,array('width' => 0.01, 'dash' => 3));
}

function show_field($pdf, $value, $text = '') {
	global $col;
	if (0 == $col) {
		$pdf->Cell(2,0,"",0,0);
	}
	$pdf->Cell((1.6*strlen($value)+strlen($text))*0.22,0.8,$text . strtoupper($value),0,0,'L');
	draw_line($pdf, ($col+strlen($text)) * 0.2,(strlen($text)+strlen($value)*1.6+$col)*0.2);
	$col += strlen($text) + strlen($value)*1.6;
}

function show_field_ln($pdf, $value, $text = '') {
	global $line, $col;
	if (0 == $col) {
		$pdf->Cell(2,0,"",0,0);
	}
	$pdf->Cell((1.6*strlen($value)+strlen($text))*0.22,0.8,$text . strtoupper($value),0,1,'L');
	draw_line($pdf, (strlen($text)+$col) * 0.2,(strlen($text)+strlen($value)*1.6+$col)*0.2);
	++$line;
	$col = 0;
}

	$pdf->Cell(0,4,"",0,1);
	$pdf->SetFont("times", "R", 14);
	$pdf->Cell(0,0,"Date: " . $model->req_dt . "              ",0,1,'R');
	$pdf->SetFont("times", "B", 14);
	$pdf->Cell(2,0,'',0,0);
	$pdf->Cell(0,0,"Dear Father,",0,1,'L');
	$pdf->SetFont("times", "I", 14);
	$pdf->Cell(0,0.1,'',0,1);
	$pdf->Cell(0,0,"Love and Peace in Jesus,",0,1,'C');
	$pdf->SetFont("times", "B", 14);
	$pdf->Cell(0,0.1,'',0,1);
	$pdf->Cell(0,0,"There is a Proposal of Marriage between",0,1,'C');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("times", "R", 14);
	$banns = $model->banns;
	show_field($pdf, $banns->groom_name);
	show_field_ln($pdf, '', ', ');
	show_field_ln($pdf, $banns->groom_parent, 'son of    ');
	show_field($pdf, BannsRecord::get_parish($banns->groom_parish), 'of  ');
	show_field_ln($pdf, '', ' parish');
/*	$pdf->Cell(2,0,"",0,0);
	$pdf->Cell(0,0.8,get_parish($banns->groom_parish). ' Parish and ',0,1,'L');
*/	show_field($pdf, $banns->bride_name, 'and  ');
	show_field_ln($pdf, '', ', ');
	show_field_ln($pdf, $banns->bride_parent, 'daughter of  ');
	show_field($pdf, BannsRecord::get_parish($banns->bride_parish), 'of  ');
	show_field_ln($pdf, '', ' parish');

	if (ctype_digit($banns->groom_parish)) {
		$local = 'groom';
		$other = 'bride';
	} elseif (ctype_digit($banns->bride_parish)) {
		$local = 'bride';
		$other = 'groom';
	} else {
		echo 'ERROR: Neither from our parish';	
	}

	show_field_ln($pdf,'','');
	show_field($pdf, $local, 'The  ');
	show_field_ln($pdf, '', ' is free to contract Marriage. Kindly');
	show_field($pdf, $other, 'let me know the freedom of the ');
	show_field_ln($pdf, '', ' to marry.');

	show_field_ln($pdf,'','');
	show_field_ln($pdf,$banns->$local()->dob,'Date of Birth: ');
	show_field_ln($pdf,$banns->$local()->baptism_dt,'Date of Bapt: ');

	show_field_ln($pdf,'','');
	show_field_ln($pdf,'','Please inform also the dates for the publication of Banns.');

	show_field_ln($pdf,'','');
	$pdf->Cell(0,0,'Thanking you,           ',0,1,'R');
	$pdf->Cell(0,0,'Yours in Christ,           ',0,1,'R');
	show_field_ln($pdf,'','');
	show_field_ln($pdf,'','');
	show_field_ln($pdf,'','');
	$pdf->Cell(0,0,'(signature)            ',0,1,'R');

	$pdf->SetFont("times", "B", 11);
	$pdf->SetFont("courier", "R", 11);
	$mid = $model->id;
	$pdf->Output("banns-request-$mid.pdf", "I");
	Yii::app()->end();

?>
