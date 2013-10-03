<?php
/* @var $this SubscriptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subscriptions',
);

$this->menu=array(
	array('label'=>'Create Subscription', 'url'=>array('subscription/create','fid'=>$family->id)),
	array('label'=>'List Subscriptions', 'url'=>array('subscription/index','fid'=>$family->id)),
	array('label'=>'Manage Subscriptions', 'url'=>array('subscription/admin','fid'=>$family->id)),
	array('label'=>'View Family','url'=>array('view','id'=>$family->id)),
);
?>

<h1>Subscriptions: <?php echo $family->head()->fullname() . "'s family"; ?></h1>

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
for ($yr = $start_yr; $yr <= $this_yr; ++$yr) {
	$subs[$yr] = array();
}

$in = false;
foreach ($subscriptions as $sub) {
	if (!$in and $sub->end_year >= $start_yr) {
		$in = true;
		$yr = $start_yr;
	}

	if ($in) {
		if ($yr == $sub->start_year) {
			if ($sub->end_year == $yr) {
				for ($mth = $sub->start_month; $mth <= $sub->end_month; ++$mth) {
					$subs[$yr][$mth] = $sub->amount;
				}
			} else {
				for ($mth = $sub->start_month; $mth <= 12; ++$mth) {
					$subs[$yr][$mth] = $sub->amount;
				}
			}
			++$yr;
		}
		while ($yr < $sub->end_year) {
			for ($mth = 1; $mth <= 12; ++$mth) {
				$subs[$yr][$mth] = $sub->amount;
			}
			++$yr;
		}
		for ($mth = 1; $mth <= $sub->end_month; ++$mth) {
			$subs[$yr][$mth] = $sub->amount;
		}
	}
}

for ($yr = $this_yr; $yr >= $start_yr; --$yr) {
	echo '<tr>';
	echo "<th>$yr</th>";
	for ($mth = 1; $mth <= 12; ++$mth) {
		echo '<td>';
		if (isset($subs[$yr][$mth])) {
			echo $subs[$yr][$mth];
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
