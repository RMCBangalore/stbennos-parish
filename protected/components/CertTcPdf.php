<?php

require_once(dirname(__FILE__) . "/../extensions/tcpdf/tcpdf/tcpdf.php");
class CertTcPdf extends TCPDF {
	public function Header() {
		$parish = Parish::get();
		$logo_src = $parish->logo_src;
		if (!isset($logo_src)) {
			$logo_src = "/images/logo-new.gif";
		}

		$logo_src = dirname(__FILE__) . "/../..$logo_src";
		$size = getimagesize($logo_src);
		list($w, $h, $t) = $size;
		switch($t) {
			case 1: $type = 'GIF'; break;
			case 2: $type = 'JPEG'; break;
			case 3: $type = 'PNG'; break;
		}
		$ht = 1.95;
		if ($w / $h > 3) {
			$ht = 1.95*3 * $h / $w;
		}
		$tm = (1.95 - $ht)/2;
		$this->Image($logo_src,0.6,0.1+$tm,'',$ht,$type,'', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetTextColorArray(array(50,50,50));
		$this->SetFont("times", "B", 18);
		$topX = $this->GetX()+1.0;
		$this->SetXY($topX,0.25);
		$this->Cell(0,0,$parish->name . ", " . $parish->city,0,1,'L');
		$this->SetFont("courier", "B", 11);
		$this->SetTextColorArray(array(60,80,170));
		$this->SetX($topX);
		$web = $parish->website;
		$phone = $parish->phone;
		if (isset($web) and !empty($web)) {
			$txt = $web;
			if (isset($phone) and !empty($phone)) {
				$txt .= " | $phone";
			}
		} else {
			$txt = "Phone: $phone";
		}
		$this->Cell(0,0,$txt,0,1,'L');
		$this->SetTextColorArray(array(20,20,20));
		$this->SetFont("times", "R", 11);
		$this->SetX($topX);
		$this->Cell(0,0,$parish->address . ', ' . $parish->city . ' - ' . $parish->pin,0,1,'L');
		$currY = $this->GetY() + 0.2;
		$this->Line(1,$currY,$this->getPageWidth()-1,$currY);
	}

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

?>
