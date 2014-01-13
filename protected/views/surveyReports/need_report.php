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
	<th rowspan="2">Need Item</th>
	<th colspan="<?php 

$fv = FieldNames::values('need_level');
echo count($fv);

		?>">Need Level Percentage (Count)</th>
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
$needCount = array();
$needTot = array();
foreach ($needDist as $need_row) {
	$nid = $need_row->need_id;
	$nv = $need_row->need_value;
	if (!isset($needCount[$nid])) {
		$needCount[$nid] = array();
		$needTot[$nid] = 0;
	}

	if (!isset($needCount[$nid][$nv])) {
		$needCount[$nid][$nv] = $need_row->val_count;
		$needTot[$nid] += $need_row->val_count;
	}
}

$needItem = array();
foreach ($needItems as $ni) {
	$needItem[$ni->id] = $ni->text;
}

echo '<tbody>';
foreach ($needCount as $nid => $needRow) {
	echo '<tr>';
	echo '<th>' . $needItem[$nid] . '</th>';

	$tot = 0;
	foreach ($fv as $nv => $val) {
		echo '<td class="count">';
		if (isset($needCount[$nid][$nv])) {
			$nc = $needCount[$nid][$nv];
			printf("%.2f%% (%d)", 100 * $nc / $needTot[$nid], $nc);
			$tot += $needCount[$nid][$nv];
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

