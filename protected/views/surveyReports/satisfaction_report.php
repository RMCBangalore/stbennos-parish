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
	echo '<th>' . $val . '</th>';
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
		echo '<td>';
		if (isset($satisfactionCount[$nid][$nv])) {
			$nc = $satisfactionCount[$nid][$nv];
			echo 100 * $nc / $satisfactionTot[$nid] . '% ';
			echo "($nc)";
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
