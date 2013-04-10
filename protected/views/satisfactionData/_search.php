<?php
/* @var $this SatisfactionDataController */
/* @var $model SatisfactionData */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'family_id'); ?>
		<?php echo $form->textField($model,'family_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'satisfaction_item_id'); ?>
		<?php echo $form->textField($model,'satisfaction_item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'satisfaction_value'); ?>
		<?php echo $form->textField($model,'satisfaction_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->