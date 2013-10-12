<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$this->breadcrumbs = array(
	'Parish Profile'
);

Yii::app()->clientScript->registerScript('gen-report', "
$('#gen-report').click(function(e) {
	window.open('" . Yii::app()->createUrl('/reports/parishProfile') . "')
} );
")

?>

<h1>Parish Profile: <?php echo CHtml::encode(Yii::app()->params['parishName']); ?></h1>

<table class="cellular">
<thead>
	<tr>
		<th>Total Families</th>
		<th>Members</th>
		<th>Baptised</th>
		<th>Confirmed</th>
		<th>Married</th>
	</tr>
</thead>
</tbody>
<tr>
	<td><?php echo $families ?></td>
	<td><?php echo $members ?></td>
	<td><?php echo $baptised ?></td>
	<td><?php echo $confirmed ?></td>
	<td><?php echo $married ?></td>
<tr>
</tbody>
</table>
<button id="gen-report" type="button">Generate Parish Profile Report</button>
