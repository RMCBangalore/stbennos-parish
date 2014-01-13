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
	<th rowspan="2">Awareness Item</th>
	<th colspan="<?php 

$fv = FieldNames::values('awareness_level');
echo count($fv);

		?>">Awareness Level Percentage (Count)</th>
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
$awarenessCount = array();
$awarenessTot = array();
foreach ($awarenessDist as $awarenessRow) {
	$nid = $awarenessRow->awareness_id;
	$nv = $awarenessRow->value;
	if (!isset($awarenessCount[$nid])) {
		$awarenessCount[$nid] = array();
		$awarenessTot[$nid] = 0;
	}

	if (!isset($awarenessCount[$nid][$nv])) {
		$awarenessCount[$nid][$nv] = $awarenessRow->val_count;
		$awarenessTot[$nid] += $awarenessRow->val_count;
	}
}

$awarenessItem = array();
foreach ($awarenessItems as $ni) {
	$awarenessItem[$ni->id] = $ni->text;
}

echo '<tbody>';
foreach ($awarenessCount as $nid => $awarenessRow) {
	echo '<tr>';
	echo '<th>' . $awarenessItem[$nid] . '</th>';

	$tot = 0;
	foreach ($fv as $nv => $val) {
		echo '<td class="count">';
		if (isset($awarenessCount[$nid][$nv])) {
			$nc = $awarenessCount[$nid][$nv];
			printf("%.2f%% (%d)", 100 * $nc / $awarenessTot[$nid], $nc);
			$tot += $awarenessCount[$nid][$nv];
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

