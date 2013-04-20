<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Administer <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>
<?php echo CHtml::link('Manage Users', array('users/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Rights', array('rights/assignment/view')); ?>
</p><p>
<?php echo CHtml::link('Manage Satisfaction Items', array('satisfactionItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Awareness Items', array('awarenessItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Need Items', array('needItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Questions', array('openQuestions/admin')); ?>
</p>

<p>
