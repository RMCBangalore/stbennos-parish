<?php if($data->isRelevantDate) {
	$masses = $this->getMasses($data->date);
	echo '<div class="mass">';
	foreach ($masses as $mass) {
		$text = date_format(new DateTime($mass->time), 'g:ia') . '&nbsp;'
			. substr(FieldNames::value('languages', $mass->language), 0, 3);
		$bookings = $this->getMassBookings($data->date, $mass->id);
		$ttip = null;
		foreach ($bookings as $bkg) {
			if (isset($ttip)) {
				$ttip = $bkg->type . ': ' . $bkg->intention;
			} else {
				$ttip = '&#10;' . $bkg->type . ': ' . $bkg->intention;
			}
		}
		if (isset($ttip)) {
			echo "<a class='mass booked' title='$ttip' onclick='js:return confirm(" . '"Mass already booked. Still want to book?"' . ")' ";
		} else {
			echo "<a class='mass' ";
		}
		echo "href='" . Yii::app()->createUrl('/massBooking/create', array(
			'for' => date_format($data->date, 'Y-m-d '),
			'mass_id' => $mass->id)) . "'>$text</a>";
	}
	echo '</div>';
	echo '<br><br><br><a class="dt" href="' .
		Yii::app()->createUrl('/massBooking/index', array('date' => date_format($data->date, 'Y-m-d'))) .
		'">' . $data->date->format('j') . '</a>';
} else {
	echo '<br><br><br><span class="dt"> ' . $data->date->format('j') . '</span>';
} ?>

