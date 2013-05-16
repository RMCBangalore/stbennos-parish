<?php
/* @var $this DeathCertificateController */
/* @var $model DeathCertificate */
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
		<?php echo $form->label($model,'death_id'); ?>
		<?php echo $form->textField($model,'death_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cert_dt'); ?>
		<?php echo $form->textField($model,'cert_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->