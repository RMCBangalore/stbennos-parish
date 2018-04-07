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

function draw_line($pdf, $y=20, $x1=8.5, $x2=16.0) {
	$pdf->Line($x1,$y-0.2,$x2,$y-0.2,array('width' => 0.01, 'dash' => 3));
}

	if ('child' == $member->role) {
		$rel = ( 'Male' === FieldNames::value('sex', $member->sex) ) ? 'son' : 'daughter';
		$rel_name = $member->family->head_name;
	} elseif ('Female' == FieldNames::value('sex', $member->sex)) {
		$rel = 'wife';
		$husband = $member->family->husband;
		$rel_name = $husband->fullname();
	}

	if (isset($rel)) {
		$pdf->Cell(0,1,"    This is to certify that " . sprintf("%-40s", $member->fname . " " . $member->lname) . ", $rel of",0,1,'L');
		$pdf->Cell(2,0,'',0,0);
		$pdf->Cell(0,1,"    " . sprintf("%-40s", $rel_name) . " belongs to my Parish and",0,1,'L');
		draw_line($pdf,11);
		$pdf->Cell(2,0,'',0,0);
		$pdf->Cell(0,0,"    is regular to Church services.",0,1,'L');
		draw_line($pdf,12,4.3,11.6);
	} else {
		$pdf->Cell(0,1,"    This is to certify that " . sprintf("%-40s", $member->fname . " " . $member->lname) . "",0,1,'L');
		draw_line($pdf,11);
		$pdf->Cell(2,0,'',0,0);
		$pdf->Cell(0,1,"    belongs to my Parish and is regular to Church services.",0,1,'L');
		$pdf->Cell(0,0.7,'',0,1);
	}

	$pdf->Cell(0,4,'',0,1);
	$pdf->Cell(3,0,'',0,0);
	$pdf->SetFont("courier", "I", 11);

	draw_line($pdf,17.6,11.3,17.3);
	$pdf->Cell(0,1,'Date: '.$model->cert_dt,0,1,'L');
	$pdf->Cell(0,0,'Parish Priest or Assistant            ',0,0,'R');
	$id = $member->id;
	$pdf->Output("membership-cert-$id.pdf", "I");
	Yii::app()->end();
?>
