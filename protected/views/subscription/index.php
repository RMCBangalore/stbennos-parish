<?php
/* @var $this SubscriptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subscriptions',
);

$this->menu=array(
	array('label'=>'Create Subscription', 'url'=>array('create','fid'=>$family->id)),
	array('label'=>'Manage Subscription', 'url'=>array('admin','fid'=>$family->id)),
);
?>

<h1>Subscriptions</h1>

<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>

<?php
$now = new DateTime();
$this_yr = date_format($now, 'Y');
$this_mth = date_format($now, 'm');
$reg_yr = date_format(new DateTime($family->reg_date), 'Y');
$start_yr = $this_yr - 13;
if ($reg_yr > $start_yr) {
	$start_yr = $reg_yr;
}

echo "<table class='cellular'><tr><thead>";
echo "<th>Year</th>";

for ($mth = 1; $mth <= 12; ++$mth) {
	$m = new DateTime;
	$m->setDate($this_yr, $mth, date_format($now, 'd'));
	$mth_code = date_format($m, 'M');
	echo "<th>$mth_code</th>";
}
echo "</thead>";
echo "<tbody>";
$i = 0;
$subs = array();
foreach ($subscriptions as $sub) {
	array_push($subs, $sub);
}

$i = 0;
if (isset($subs[$i])) {
	$sub = $subs[$i++];
}

for ($yr = $this_yr; $yr >= $start_yr; --$yr) {
	echo '<tr>';
	echo "<th>$yr</th>";
	for ($mth = 1; $mth <= 12; ++$mth) {
		echo '<td>';
		if (isset($sub) and $sub->year == $yr and $sub->month == $mth) {
			echo $sub->trans->amount;
			if (isset($subs[$i])) {
				$sub = $subs[$i++];
			}
		} else {
			echo '-';
		}
		echo '</td>';
	}
	echo '</tr>';
}
echo '</tbody>';
echo '</table>';

?>
