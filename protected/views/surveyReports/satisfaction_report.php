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
?>

<table class="cellular">
<thead>
<tr>
	<th rowspan="2">Satisfaction Item</th>
	<th colspan="<?php 

$fv = FieldNames::values('satisfaction_level');
echo count($fv);

		?>">Satisfaction Level Percentage (Count)</th>
	<th rowspan="2">Total</th>
</tr>
<tr>
<?php
foreach ($fv as $nv => $val) {
	echo '<th class="option">' . $val . '</th>';
} ?>
</tr>
</thead>

<?php
$satisfactionCount = array();
$satisfactionTot = array();
foreach ($satisfactionDist as $satisfactionRow) {
	$nid = $satisfactionRow->satisfaction_item_id;
	$nv = $satisfactionRow->satisfaction_value;
	if (!isset($satisfactionCount[$nid])) {
		$satisfactionCount[$nid] = array();
		$satisfactionTot[$nid] = 0;
	}

	if (!isset($satisfactionCount[$nid][$nv])) {
		$satisfactionCount[$nid][$nv] = $satisfactionRow->val_count;
		$satisfactionTot[$nid] += $satisfactionRow->val_count;
	}
}

$satisfactionItem = array();
foreach ($satisfactionItems as $ni) {
	$satisfactionItem[$ni->id] = $ni->text;
}

echo '<tbody>';
foreach ($satisfactionCount as $nid => $satisfactionRow) {
	echo '<tr>';
	echo '<th>' . $satisfactionItem[$nid] . '</th>';

	$tot = 0;
	foreach ($fv as $nv => $val) {
		echo '<td class="count">';
		if (isset($satisfactionCount[$nid][$nv])) {
			$nc = $satisfactionCount[$nid][$nv];
			printf("%.2f%% (%d)", 100 * $nc / $satisfactionTot[$nid], $nc);
			$tot += $satisfactionCount[$nid][$nv];
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
