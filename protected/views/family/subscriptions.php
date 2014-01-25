<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
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
	'Subscriptions' => array('/subscription/index'),
	'Family Subscriptions'
);

if (isset($family)) {
	$this->menu=array(
		array('label'=>'Create Subscription', 'url'=>array('subscription/create','fid'=>$family->id)),
		array('label'=>'List Subscriptions', 'url'=>array('subscription/index','fid'=>$family->id)),
		array('label'=>'Manage Subscriptions', 'url'=>array('subscription/admin','fid'=>$family->id)),
		array('label'=>'View Family','url'=>array('view','id'=>$family->id)),
	);
} else {
	$this->menu=array(
		array('label'=>'Create Subscription', 'url'=>array('subscription/create')),
	);
}

?>

<?php if (isset($family)) { ?>

<h1>Subscriptions: <?php echo $family->head()->fullname() . "'s family"; ?></h1>

<?php
$now = new DateTime();
$this_yr = date_format($now, 'Y');
$this_mth = date_format($now, 'm');
$reg_yr = date('Y', CDateTimeParser::parse($family->reg_date, Yii::app()->locale->getDateFormat('short')));
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

} else { ?>

<h1>Family Subscriptions</h1>

<?php

$fam_list = array();
$paid = array();
$due = array();
$now = new DateTime('now');
foreach($families as $family) {
	array_push($fam_list, $family->head_name);
	$reg = new DateTime;
	$reg->setTimestamp(CDateTimeParser::parse(
		$family->reg_date,
		Yii::app()->locale->getDateFormat('short')
	));
	$sub_till = new DateTime();
	$st_dt = $family->sub_till;
	$fmt = Yii::app()->locale->getDateFormat('short');
	if (preg_match('/^\d{4}-\d\d$/', $st_dt)) {
		$st_dt .= "-15";
		$fmt = 'yyyy-MM-dd';
	}
	$sub_till->setTimestamp(CDateTimeParser::parse($st_dt, $fmt));
	$diff = $sub_till->diff($reg);
	array_push($paid, $diff->format('%y') * 12 + $diff->format('%m'));
	$diff = $sub_till->diff($now);
	array_push($due, $diff->format('%y') * 12 + $diff->format('%m'));
}
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options' => array(
		'chart' => array('type' => 'bar'),
		'title' => array('text' => 'Subsrciptions Paid/Due'),
		'xAxis' => array(
			'categories' => $fam_list
		),
		'yAxis' => array(
			'min' => 0,
			'title' => array('text' => 'Subscription months'),
		),
		'plotOptions' => array(
			'series' => array('stacking' => 'normal'),
		),
		'series' => array(
			array(
				'name' => 'Due',
				'data' => $due,
				'color' => '#aa1919',
			),
			array(
				'name' => 'Paid',
				'data' => $paid,
				'color' => '#a4d53a',
			),
		),
	)
));

} ?>
