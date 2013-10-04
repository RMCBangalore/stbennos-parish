<?php
	$data = array();
	$parms = array('id'=>'Subscription_till','prompt' => '-- Select --');
	if (isset($start_dt)) {
		$dt = $start_dt;
		$now = new DateTime();
		for ($i = 1; $dt <= $now; ++$i) {
			$data[$i] = date_format($dt, 'M Y') . ' (' . $i . ' months)';
			$dt->add(new DateInterval("P1M"));
		}
	} else {
		$parms['disabled'] = true;
	}
	echo CHtml::dropDownList('Subscription[till]',null,$data,$parms);
?>

