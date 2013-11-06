<?php
#
# This file is part of St. Benno's Parish Software
#
# St. Benno's Parish Software - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# St. Benno's Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# St. Benno's Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
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
			printf("PAID", $subs[$yr][$mth]);
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
