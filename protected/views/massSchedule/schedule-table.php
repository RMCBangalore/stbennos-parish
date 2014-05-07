<?php

$day_masses = array();
foreach ($schedule as $data) {
	$day = $data->day;
	$mass = array(
		'id' => $data->id,
		'time' => $data->time,
		'language' => $data->language);

	if (!isset($day_masses[$day])) {
		$day_masses[$day] = array($mass);
	} else {
		array_push($day_masses[$day], $mass);
	}
}

?>

<table class='cellular'>
<thead>
<th>Day of Week</th>
<th>Time</th>
<th>Language</th>
<?php if (Yii::app()->user->checkAccess('MassSchedule.Delete')): ?>
	<th style="width:30px">Del</th>
<?php endif ?>
</thead>

<?php
foreach ($day_masses as $day => $masses) {
	$wday = FieldNames::value('weekdays', $day);
	$nm = count($masses);
	echo "<tr><th rowspan='$nm'>$wday</th>";
	foreach ($masses as $i => $mass) {
		if ($i > 0) {
			echo "<tr>";
		}
		echo "<td>" .
			CHtml::encode(date_format(new DateTime($mass['time']), 'g:i a')) .
			"</td><td>" .
			CHtml::encode(FieldNames::value('languages', $mass['language']));
			if (Yii::app()->user->checkAccess('MassSchedule.Delete')) {
				echo "</td><td>" .
				CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/del.png', 'Del'), array('/massSchedule/delete', 'id'=>$mass['id']), array('class'=>'del'));
			}
			echo "</td></tr>";
	}
}

?>

</table>

