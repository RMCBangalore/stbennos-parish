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

<h1>Parish Profile: <?php echo CHtml::encode(Parish::get()->name); ?></h1>

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
	<td><?php echo CHtml::link($families, array('family/index')); ?></td>
	<td><?php echo CHtml::link($members, array('person/index')); ?></td>
	<td><?php echo CHtml::link($baptised, array('person/baptised')); ?></td>
	<td><?php echo CHtml::link($confirmed, array('person/confirmed')); ?></td>
	<td><?php echo CHtml::link($married, array('person/married')); ?></td>
<tr>
</tbody>
</table>
<button id="gen-report" type="button">Generate Parish Profile Report</button>
