<?php

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
	echo '<th>' . $qv . '</th>';
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
		echo '<td>';
		if (isset($openCount[$qid][$qv])) {
			$nc = $openCount[$qid][$qv];
			echo 100 * $nc / $openTot[$qid] . '% ';
			echo "($nc)";
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
