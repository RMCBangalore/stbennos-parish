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
	echo '<th>' . $val . '</th>';
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

		if (!isset($needCount[$nid][$nv])) {
			$needCount[$nid][$nv] = $need_row->val_count;
			$needTot[$nid] += $need_row->val_count;
		}
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
		echo '<td>';
		if (isset($needCount[$nid][$nv])) {
			$nc = $needCount[$nid][$nv];
			echo 100 * $nc / $needTot[$nid] . '% ';
			echo "($nc)";
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
