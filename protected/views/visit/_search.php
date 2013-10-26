<?php
/* @var $this VisitController */
/* @var $model Visits */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pastor_id'); ?>
		<?php echo $form->textField($model,'pastor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visit_dt'); ?>
		<?php echo $form->textField($model,'visit_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purpose'); ?>
		<?php echo $form->textField($model,'purpose'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'family_id'); ?>
		<?php echo $form->textField($model,'family_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
