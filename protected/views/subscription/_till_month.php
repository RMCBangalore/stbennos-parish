<?php
	$data = array();
	$parms = array('id'=>'Subscription_till','prompt' => '-- Select --');
	if (isset($start_dt)) {
		$dt = $start_dt;
		$now = new DateTime();
		for ($i = 1; true; ++$i) {
			$dt->add(new DateInterval("P1M"));
			if ($dt > $now) {
				break;
			}

			$data[$i] = date_format($dt, 'M Y') . ' (' . $i . ' months)';
		}
	} else {
		$parms['disabled'] = true;
	}
	echo CHtml::dropDownList('Subscription[till]',null,$data,$parms);
?>

