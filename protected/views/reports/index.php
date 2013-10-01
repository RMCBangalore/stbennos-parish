<?php
/* @var $this ReportsController */

$this->breadcrumbs=array(
	'Reports',
);
?>
<div>
<span class="leftHalf">
<h1>People Reports</h1>

<?php
echo '<p>';
#echo CHtml::link('Families', array('families/report'));
#echo '</p><p>';
echo CHtml::link('Birthdays', array('reports/birthdays'));
echo '</p><p>';
echo CHtml::link('Anniversaries', array('reports/anniversaries'));
echo '</p>';
?>
</span>
<span class="rightHalf">
<?php $this->renderPartial('../surveyReports/index'); ?>
</span>
</div>
