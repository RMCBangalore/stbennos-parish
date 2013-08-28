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
	echo '<th>' . $val . '</th>';
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
		echo '<td>';
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
