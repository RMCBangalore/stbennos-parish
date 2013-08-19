<?php
/* @var $this SubscriptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subscriptions',
);

$this->menu=array(
	array('label'=>'Create Subscription', 'url'=>array('create')),
	array('label'=>'Manage Subscription', 'url'=>array('admin')),
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
$start_yr = $this_yr - 6;

echo "<table><tr><thead>";
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
if (isset($sub[$i])) {
	$sub = $sub[$i++];
}

for ($yr = $this_yr; $yr >= $start_yr; --$yr) {
	echo '<tr>';
	echo "<th>$yr</th>";
	for ($mth = 1; $mth <= 12; ++$mth) {
		echo '<td>';
		if (isset($sub) and $sub->year == $yr and $sub->month == $mth) {
			echo $sub->trans->amount;
			if (isset($sub[$i])) {
				$sub = $sub[$i++];
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