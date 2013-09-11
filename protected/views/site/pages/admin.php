<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Admin',
);
?>

<h1>Administer <i><?php echo CHtml::encode(Yii::app()->params['parishName']); ?></i></h1>

<table>
<tr><td>
<p>
<?php echo CHtml::link('Manage Users', array('users/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Rights', array('rights/assignment/view')); ?>
</p><p>
<?php echo CHtml::link('Mass Schedule', array('massSchedule/index')); ?>
</p><p>
<?php echo CHtml::link('Manage Satisfaction Items', array('satisfactionItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Awareness Items', array('awarenessItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Need Items', array('needItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Questions', array('openQuestions/admin')); ?>
</p>
<?php
function show_admin_fv($type) {
	echo "<p>";
	$lbl = ucwords(implode(' ', explode('_', $type)));
	echo CHtml::link("Manage $lbl", array("fieldValue/admin", "type" => $type));
	echo "</p>";
}

foreach(array("marriage_type", "marriage_status") as $type) show_admin_fv($type);
?>
</td><td>
<?php foreach(array("languages", "zones", "education", "domicile_status",
	"rite", "satisfaction_level", "need_level", "awareness_level",
	"monthly_household_income") as $type) show_admin_fv($type);
?>
</td></tr>
</table>

<p>
