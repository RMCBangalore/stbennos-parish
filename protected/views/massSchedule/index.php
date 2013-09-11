<?php
/* @var $this MassScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Mass Schedules',
);

$this->menu=array(
	array('label'=>'Create MassSchedule', 'url'=>array('create')),
	array('label'=>'Manage MassSchedule', 'url'=>array('admin')),
);
?>

<h1>Mass Schedule</h1>

<?php

$day_masses = array();
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

?>

<table class='cellular'>
<thead>
<th>Day of Week</th>
<th>Time</th>
<th>Language</th>
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
			CHtml::encode(FieldNames::value('languages', $mass['language'])) .
			"</td></tr>";
	}
}

?>

</table>

