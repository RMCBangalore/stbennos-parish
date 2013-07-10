<?php
/* @var $this MassBookingController */
/* @var $model MassBooking */

	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
								'P', 'cm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("Mass Booking");
	$pdf->SetSubject("Mass Booking");
	$pdf->SetKeywords("PDF");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	#$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont("times", "R", 16);
	$pdf->Cell(0,1,"",0,1);
	$pdf->Cell(0,0,strtoupper(Yii::app()->params['parishName']),0,0,'C');
	$pdf->SetFont("courier", "R", 10);
	$pAddr = Yii::app()->params['parishAddr'];
	foreach ($pAddr as $addr) {
		$pdf->Cell(0,0,$addr,0,1,'R');
	}
	$pdf->SetFont("courier", "R", 11);
	$pdf->Cell(0,0,"Mass Booking Receipt",0,1,'C');
	$trans = $model->trans;
	$pdf->Cell(0,1,'',0,1,'L');
	$pdf->Cell(1,0,'',0,0,'L');
	$pdf->Cell(0,0,'Receipt No.: ' . $model->id,0,0,'L');
	$pdf->Cell(0,0,"Date: " . date_ind($trans->created),0,1,'R');
	$pdf->SetFont("courier", "R", 11);
	$mass = $model->mass;

	$pdf->Cell(0,1,'',0,1);
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(9,0,"Received with thanks from Mr./Ms./Mrs. " . $model->booked_by . " towards",0,1,'L');
	$pdf->Cell(1,0,'',0,0);
	$pdf->Cell(9,0,'the following particulars:',0,1,'L');
	$pdf->Cell(0,1,'',0,1);
	$pdf->SetFont("courier", "B", 10);

function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}

$count = 0;

function date_ind($dt) {
	return date_format(new DateTime($dt), 'd/m/Y H:i:s');
}

function date_mass($dt) {
	return date_format(new DateTime($dt), 'd/m/Y');
}

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

function format_mass($dt, $time, $lcode) {
	$s = date_format(new DateTime($dt), 'D, ');
	$s .= date_format(new DateTime($time), 'g:ia');
	$s .= ' ' . FieldNames::value('languages', $lcode);
	return $s;
}

	$pdf->Cell(1,0,'',0,0,'L');
	$pdf->Cell(0,0,sprintf("%-12s%-22s%-15s%-25s% 7s",
		"Date","Mass Timings", "Type", "Details", "Amount"),0,1,'L');
	$pdf->SetFont("courier", "R", 10);
	$pdf->Cell(1,0,'',0,0,'L');
	$pdf->Cell(0,0,sprintf("%-12s%-22s%-15s%-25s% 7s",
		date_mass($model->mass_dt),
		format_mass($model->mass_dt, $mass->time, $mass->language),
		$model->type,
		$model->intention,
		$trans->amount),0,1,'L');
	$pdf->Cell(0,0.2,'',0,1,'L');
	$pdf->Cell(1,0,'',0,0,'L');
	$pdf->SetFont("courier", "B", 10);
	$pdf->Line(15,9.5,19.3,9.5,array('width'=>0.02,'dash'=>3));
	$pdf->Cell(0,0,sprintf("% 12s% 62s% 7s", "Signature", "Total", $trans->amount),0,1,'L');

	$mid = $model->id;
	$pdf->Output("mass-booking-recpt-$mid.pdf", "I");
	Yii::app()->end();

?>
