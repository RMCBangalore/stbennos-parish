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
	$pdf->SetSubject("Family subscription receipt");
	$pdf->SetKeywords("PDF");
	$pdf->SetPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->AddPage();

	$pdf->SetFont("times", "R", 16);
	$pdf->Cell(0,0.1,"",0,1);
	$pdf->Cell(0,0,strtoupper(Parish::get()->name),0,0,'C');
	$pdf->SetFont("courier", "R", 10);
	$pAddr = explode("\n", Parish::get()->address);
	array_push($pAddr, implode(' - ', array(
		Parish::get()->city,
		Parish::get()->pin)));
	foreach ($pAddr as $addr) {
		$pdf->Cell(0,0,$addr,0,1,'R');
	}
	$pdf->SetFont("courier", "R", 11);
	$pdf->Cell(0,0,"Family Subscription Receipt",0,1,'C');
	$trans = $model->trans;
	$pdf->Cell(0,1,'',0,1,'L');
	$pdf->Cell(1,0,'',0,0,'L');
	$pdf->SetFont("courier", "R", 10);
	$pdf->Cell(0,0,'Receipt No.: ' . $model->id,0,0,'L');
	$pdf->SetFont("courier", "R", 9.5);
	$pdf->Cell(0,0,$trans->created,0,1,'R');
	$pdf->SetFont("courier", "R", 11);

	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(9,0,"Received with thanks from Mr./Ms./Mrs. " . $model->paid_by . " towards",0,1,'L');
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(9,0,'the following particulars:',0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("courier", "B", 10);

$count = 0;

function draw_line($pdf) {
	global $count;
	$pdf->Line(10.2,9.6+$count*0.8,16,9.6+$count*0.8,array('width' => 0.01, 'dash' => 3));
	++$count;
}

function show_field($pdf, $label, $value) {
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.8,sprintf("%-20s: %s", strtoupper($label), strtoupper($value)),0,1,'L');
	draw_line($pdf);
}

	$pdf->Cell(1,0,'',0,0,'L');
	$pdf->Cell(0,0,sprintf("%-74s% 7s", "Item", 'Amount'),0,1,'L');
	$pdf->SetFont("courier", "R", 10);
	$pdf->Cell(1,0,'',0,0,'L');
	$trans = $model->trans;
	$pdf->Cell(0,0,sprintf("%-74s% 7s", $trans->descr,
		sprintf("%.2f", $trans->amount)),0,1,'L');
	$pdf->Cell(0,0.2,'',0,1,'L');
	$pdf->Cell(1,0,'',0,0,'L');
	$pdf->Line(15,9.1,19.3,9.1,array('width'=>0.02,'dash'=>3));
	$pdf->Cell(0,0,sprintf("% 70s% 11s",
		strtoupper(Transaction::convert_number_to_words($trans->amount)) . " ONLY",
		sprintf("%.2f", $trans->amount)),0,1,'L');

	$pdf->SetFont("courier", "B", 10);
	$pdf->Cell(1,0,'',0,0,'L');
	$pdf->Cell(0,0,sprintf("% 12s", "Signature"),0,1,'L');

	$mid = $model->id;
	$pdf->Output("family-sub-rect-$mid.pdf", "I");
	Yii::app()->end();

?>
