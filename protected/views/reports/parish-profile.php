<?php
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */

	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
								'P', 'cm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("Parish Profile Report");
	$pdf->SetSubject("Parish Profile Report");
	$pdf->SetKeywords("PDF");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont("times", "B", 20);
	$pdf->Cell(0,1,"",0,1);
	$year = date_format(new DateTime(), 'Y');
	$pdf->Cell(0,0,"Annual General Statistical Questionnaire $year",0,1,'C');
	$pdf->SetFont("times", "B", 13);
	$pdf->Cell(0,0,"Situation on 1st January $year to December 31st, $year.",0,1,'C');
	$pdf->Line(1.2,3.6,19.5,3.6,array('width' => 0.03));
	$pdf->SetFont("courier", "R", 11);
	$pdf->Cell(0,2,'',0,1);

$pdf->count = 0;

function date_ind($dt) {
	return date_format(new DateTime($dt), 'd/m/Y');
}

function draw_line($pdf, $ln = 0) {
	$pdf->Line(12.5,9.7+$pdf->count*0.8,15.0,9.7+$pdf->count*0.8,array('width' => 0.01, 'dash' => 3));
	$pdf->count += 1.5;
}

function show_field($pdf, $label, $value) {
	$ln = strlen($label);
	if ($ln < 55) {
		$ln = 55;
	}
	$pdf->Cell(0,0.3,sprintf("%-${ln}s", "$label :"),0,0,'L');
	$pdf->Cell(0,0,"$value                                                ",0,1,'R');
	$pdf->Cell(0,0.6,'',0,1,'L');
	$pdf->Cell(1.6,0,"",0,0);
	draw_line($pdf, $ln);
}

	$pdf->Cell(1,0,"",0,0);
	$pdf->SetFont("times", "B", 14);
	$pdf->Cell(0,0.8,sprintf("%-20s: %s", "Name of the Parish", Parish::get()->name),0,1,'L');
#	$pdf->Text(1.9,5.55,sprintf("%-20s: %s", "Name of the Parish", Parish::get()->name));
	$pdf->Line(6.7,6.25,10.5,6.25,array('width' => 0.01, 'dash' => 3));

	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(0,0.8,"1. Baptisms",0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("times", "R", 14);
	$pdf->Cell(1.6,0,"",0,0);
	show_field($pdf, "A. Up to 1 Year old", $baptised1);
	show_field($pdf, "B. From 1 to 7 Years old", $baptised7);
	show_field($pdf, "C. Over 7 Years old", $baptised7p);
	show_field($pdf, "Total No of Baptism (A+B+C)", $baptised);
	$pdf->Cell(0,0.5,'',0,1);
	$pdf->Cell(1,0,'',0,0);
	$pdf->SetFont("times", "B", 14);
#	$pdf->Cell(0,0.8,"2. Confirmations during the year",0,1,'L');
	$pdf->count += 0.9;
	show_field($pdf, "2. Confirmations during the year", $confirmed);
	
	$pdf->Cell(0,0.5,'',0,1);
	$pdf->Cell(1,0,'',0,0);
	$pdf->SetFont("times", "B", 14);
	$pdf->count += 0.9;
	show_field($pdf, "3. First Holy Communion during the year", $confirmed);

	$pdf->Cell(0,0.1,'',0,1);
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(0,0.8,"4. Marriages",0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("times", "R", 14);
	$pdf->Cell(1.6,0,"",0,0);
	$pdf->count += 2.9;
	show_field($pdf, "A. Between Catholics", "", 0, 1, 'L');
	show_field($pdf, "B. Between Catholic & Non Catholic", "", 0, 1, 'L');
	show_field($pdf, "Total Numbers of Marriages (A+B)", "", 0, 1, 'L');
#	draw_line($pdf);

	$pdf->SetFont("times", "B", 12);
	$y = 27;
	$pdf->Text(2,$y,'Name of the Parish Priest');
	$pdf->Text(10,$y,'Seal');
	$pdf->Text(16,$y,'Signature');

	$pdf->AddPage();

	$pdf->Cell(7,0,'',0,0);
	$pdf->SetFont("times", "B", 14);
	$pdf->SetLineStyle(array('width' => 0.01, 'dash' => 0));
	$pdf->Cell(4,1,'MASS TIMINGS','B',1,'C');

	$pdf->SetFont("times", "R", 14);
	$pdf->SetLineStyle(array('width' => 0.01, 'dash' => 3));
	$pdf->Cell(0,0.3,'',0,1,'L');
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(6.5,1,'Name & Address of the Parish',0,0,'L');
	$pdf->Cell(9,1,'','B',1);
	$pdf->Cell(7.5,0,'',0,0);
	$pdf->Cell(9,1,'','B',1);
	$pdf->Cell(7.5,0,'',0,0);
	$pdf->Cell(9,1,'','B',1);

	$pdf->Cell(0,1,'',0,1,'L');
	$pdf->Cell(1.5,0,'',0,0,'L');

$day_masses = array();
$num_masses = count($schedule);
foreach ($schedule as $data) {
	$day = $data->day;
	$mass = array(
		'time' => $data->time,
		'language' => $data->language);

	if (!isset($day_masses[$day])) {
		$day_masses[$day] = array($mass);
	} else {
		array_push($day_masses[$day], $mass);
	}
}

$fsize = intval(240 / (2+$num_masses));
if ($fsize > 16) {
	$fsize = 16;
}
$ht = $fsize / 18.0;
$pdf->SetFontSize($fsize);

	$pdf->SetLineStyle(array('width' => 0.01, 'dash' => 0));
	$pdf->Cell(4,$ht,'','LTR',0,'L');
	$pdf->Cell(12,$ht,'Holy Mass','TRB',1,'C');
	$pdf->Cell(1.5,0,'',0,0,'L');
	$pdf->Cell(4,$ht,'','LRB',0,'L');
	$pdf->Cell(6,$ht,'Time','RB',0,'C');
	$pdf->Cell(6,$ht,'Language','RB',1,'C');

foreach ($day_masses as $day => $masses) {
	$wday = FieldNames::value('weekdays', $day);
	$nm = count($masses);
	$pdf->Cell(1.5,0,'',0,0,'L');
	$pdf->Cell(4,$ht*$nm,$wday,'LRB',0,'C');
	$border = 'R';
	$nxtpref = 5.5;
	foreach($masses as $i => $mass) {
		if ($i == $nm - 1) {
			$border = 'RB';
			$nxtpref = 0;
		}
		$pdf->Cell(6,$ht,date_format(new DateTime($mass['time']), 'g:i a'),$border,0,'C');
		$pdf->Cell(6,$ht,FieldNames::value('languages', $mass['language']),$border,1,'C');
		if ($nxtpref > 0) {
			$pdf->Cell($nxtpref,0,'',0,0,'L');
		}
	}
}
	
	$pdf->SetFontSize(14);
	$pdf->SetLineStyle(array('width' => 0.01, 'dash' => 3));
	$pdf->Cell(1,0.4,'',0,1,'L');
	$pdf->Cell(1.0,0,'',0,0,'L');
	$pdf->Cell(2.5,1,'Adoration',0,0,'L');
	$pdf->Cell(10,1,'','B',1);
	$pdf->Cell(1.0,0,'',0,0,'L');
	$pdf->Cell(2.5,1,'Confession',0,0,'L');
	$pdf->Cell(10,1,'','B',1);
	$pdf->Cell(1.0,0,'',0,0,'L');
	$pdf->Cell(2.5,1,'Novena',0,0,'L');
	$pdf->Cell(10,1,'','B',1);

	$pdf->SetFont("times", "B", 12);
	$y = 27;
	$pdf->Text(2,$y,'Name of the Parish Priest');
	$pdf->Text(10,$y,'Seal');
	$pdf->Text(16,$y,'Signature');

	$pdf->AddPage();
	$pdf->Cell(0,1,'',0,1,'L');
	$pdf->Cell(6,0,'',0,0,'L');
	$pdf->SetFont("times", "B", 14);
	$pdf->Cell(8,1,'NOTE: Fill in the Details in BLOCK letters',0,1,'C');

	$pdf->SetFont("times", "R", 13);
	$pdf->ht = $ht = 0.8;
	$pdf->SetLineStyle(array('dash' => 0));
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(7,$ht,'Name of the Church','LTR',0,'L');
	$pdf->Cell(10,$ht,strtoupper(Parish::get()->name),'TR',1,'L');
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(7,$ht*4,'Address','LBR',0,'L',false,'',0,false,'T','T');
	$pAddr = Parish::get()->address;
	array_push($pAddr, implode(' - ', array(
		Parish::get()->city,
		Parish::get()->pin)));
	foreach($pAddr as $addr) {
		$pdf->Cell(10,$ht,strtoupper($addr),'R',1,'L');
		$pdf->Cell(8,0,'',0,0,'L');
	}
	$pdf->Cell(10,$ht,'','BR',1,'L');

function show_data($pdf, $label, $value='')
{
	$pdf->Cell(1,0);
	$pdf->Cell(7,$pdf->ht,$label,'BLR',0,'L');
	$pdf->Cell(10,$pdf->ht,strtoupper($value),'RB',1,'L');
}
	show_data($pdf, 'Established Year');
	show_data($pdf, 'Name of the Parish Priest');
	show_data($pdf, 'No. of Catholics', $members);
	show_data($pdf, 'No. of Families', $families);
	show_data($pdf, 'Telephone No.');
	show_data($pdf, 'Mobile No.');
	show_data($pdf, 'Email ID');
	show_data($pdf, 'Fax No.');
	show_data($pdf, 'Web Site:');
foreach(array(1,2) as $i) {
	show_data($pdf, 'Name of the Assistant Parish Priest');
	show_data($pdf, 'Telephone No.');
	show_data($pdf, 'Mobile No.');
}
	
	$pdf->SetFont("times", "B", 12);
	$y = 27;
	$pdf->Text(2,$y,'Date:');
	$pdf->Text(10,$y,'Seal');
	$pdf->Text(15,$y,'Signature & Name');

	$pdf->Output("parish-profile-$year.pdf", "I");
	Yii::app()->end();

?>
