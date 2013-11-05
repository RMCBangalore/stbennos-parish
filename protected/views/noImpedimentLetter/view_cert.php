<?php

	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
								'P', 'cm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("No Impediment Letter");
	$pdf->SetSubject("No Impediment Letter");
	$pdf->SetKeywords("PDF");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();

$line = 0;

function date_ind($dt) {
	return date_format(new DateTime($dt), 'd/m/Y');
}

function draw_line($pdf, $x1 = 0, $x2 = 14.9) {
	global $line;
	$pdf->Line(3.1+$x1,10.8+$line*0.8,3.1+$x2,10.8+$line*0.8,array('width' => 0.01, 'dash' => 3));
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

function get_parish($parish) {
	if (ctype_digit($parish)) {
		return Parish::get()->name;
	} else {
		return $parish;
	}
}

	$pdf->Cell(0,4,"",0,1);
	$pdf->SetFont("times", "R", 14);
	$pdf->Cell(2,0,'',0,0);
	$pdf->Cell(0,0,'J.M.J.A.T.',0,1,'L');
	$pdf->Cell(0,0,"Date: " . date_ind($model->letter_dt) . "                     ",0,1,'R');
	$pdf->Cell(0,1,"",0,1);
	$pdf->Cell(2,0,'',0,0);
	$pdf->Cell(0,0,"Dear Rev. Father,",0,1,'L');
	$pdf->Cell(0,0.1,'',0,1);
	$pdf->Cell(3,0,'',0,0);
	$pdf->Cell(0,0,'With regard to the proposed marriage between',0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("times", "R", 14);
	$banns = $model->banns;
	show_field($pdf, $banns->groom_name);
	show_field_ln($pdf, '', ', ');
	show_field_ln($pdf, $banns->groom_parent, 'S/o    ');
	show_field($pdf, get_parish($banns->groom_parish), 'of  ');
	show_field_ln($pdf, '', ' parish');
/*	$pdf->Cell(2,0,"",0,0);
	$pdf->Cell(0,0.8,get_parish($banns->groom_parish). ' Parish and ',0,1,'L');
*/	
	show_field_ln($pdf, '', '        and');
	show_field($pdf, $banns->bride_name, '');
	show_field_ln($pdf, '', ', ');
	show_field_ln($pdf, $banns->bride_parent, 'D/o  ');
	show_field($pdf, get_parish($banns->bride_parish), 'of  ');
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
	show_field_ln($pdf, '', 'The banns have been published, and no');
	show_field_ln($pdf, '', 'impediment has been brought to our notice. Nor do');
	show_field_ln($pdf, '', 'we know of any objection to this marriage.');

	show_field_ln($pdf,'','');
	show_field_ln($pdf, '', '        You may kindly bless this Marriage.');
	show_field_ln($pdf, '', '        Nubant in Christo Domino.');

	show_field_ln($pdf,'','');
	$pdf->Cell(0,0,'Yours truly in Christ,                      ',0,1,'R');
	show_field_ln($pdf,'','');
	show_field_ln($pdf,'','');
	$pdf->SetFont("times", "I", 14);
	$pdf->Cell(0,0,'Parish Priest                        ',0,1,'R');

	$pdf->SetFont("courier", "R", 11);
	$mid = $model->id;
	$pdf->Output("no-impediment-letter-$mid.pdf", "I");
	Yii::app()->end();

?>
