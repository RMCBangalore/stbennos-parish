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

$openQuestion = array();
foreach ($openQuestions as $ni) {
	$openQuestion[$ni->id] = $ni;
}

$openCount = array();
$openTot = array();
$openVal = array();
foreach ($openDist as $openRow) {
	$qid = $openRow->question_id;
	$qv = $openRow->value;

	if ('' == $qv) {
		$qv = 'Not set';
	}

	if (!isset($openCount[$qid])) {
		$openCount[$qid] = array();
		$openTot[$qid] = 0;
	}

	if (!isset($openVal[$qv])) {
		$openVal[$qv] = 1;
	}

	if (!isset($openCount[$qid][$qv])) {
		$openCount[$qid][$qv] = $openRow->val_count;
		$openTot[$qid] += $openRow->val_count;
	}
}

?>

<table class="cellular">
<thead>
<tr>
	<th rowspan="2">Open Question</th>
	<th colspan="<?php echo count($openVal) ?>">Answer Percentage (Count)</th>
	<th rowspan="2">Total</th>
</tr>
<tr>
<?php
foreach ($openVal as $qv => $val) {
	echo '<th class="option">' . $qv . '</th>';
} ?>
</tr>
</thead>
<tbody>

<?php

foreach ($openCount as $qid => $openRow) {
	echo '<tr>';
	echo '<th>' . $openQuestion[$qid]->text . '</th>';

	$tot = 0;
	foreach ($openVal as $qv => $val) {
		echo '<td class="count">';
		if (isset($openCount[$qid][$qv])) {
			$nc = $openCount[$qid][$qv];
			printf("%.2f%% (%d)", 100 * $nc / $openTot[$qid], $nc);
			$tot += $openCount[$qid][$qv];
		} else {
			echo 0;
		}
	}
	echo '<td>' . $tot . '</td>';
	echo '</tr>';
}

?>

</tbody>
</table>
