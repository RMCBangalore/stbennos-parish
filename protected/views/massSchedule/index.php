<?php
/* @var $this MassScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mass Schedules',
);

$this->menu=array(
	array('label'=>'Create MassSchedule', 'url'=>array('create')),
	array('label'=>'Manage MassSchedule', 'url'=>array('admin')),
);
?>

<h1>Mass Schedule</h1>

<table border="1"><tr><td>
<?php $oldDay = -1;
foreach ($schedule as $data) {
	$day = $data->day;
	if ($oldDay != -1 and $day != $oldDay) {
		$wday = FieldNames::value('weekdays', $day);
		echo "</table></td></tr>\n<tr><td>$wday</td>\n<td>";
	} elseif ($oldDay == -1) {
		$wday = FieldNames::value('weekdays', $day);
		echo "$wday</td>\n<td><table>";
	}

	echo "<tr><td>\n";
	echo CHtml::encode(date_format(new DateTime($data->time), 'g:i a'));
	echo "</td><td>\n";
	echo CHtml::encode(FieldNames::value('languages', $data->language));
	echo "</td></tr>\n";

	$oldDay = $day;
}
?>
</table></td></tr></table>
