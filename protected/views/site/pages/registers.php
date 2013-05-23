<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);

$this->menu=array(
	array('label' => 'Create Family', 'url' => array('family/create')),
	array('label' => 'Manage Families', 'url' => array('family/admin'))
);
?>
<h1>Registers</h1>

<p>
	<?php echo CHtml::link('Marriage Register', array('marriageRecords/index')); ?>
</p><p>
	<?php echo CHtml::link('Baptism Register', array('baptismRecords/index')); ?>
</p><p>
	<?php echo CHtml::link('First Communion Register', array('firstCommunionRecords/index')); ?>
</p><p>
	<?php echo CHtml::link('Confirmation Register', array('confirmationRecords/index')); ?>
</p><p>
	<?php echo CHtml::link('Death Register', array('deathRecords/index')); ?>
</p><p>
	<?php echo CHtml::link('Banns Register', array('bannsRecords/index')); ?>
</p>
