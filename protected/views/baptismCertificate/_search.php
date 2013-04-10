<?php
/* @var $this BaptismCertificateController */
/* @var $model BaptismCertificate */
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
		<?php echo $form->label($model,'cert_dt'); ?>
		<?php echo $form->textField($model,'cert_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptism_id'); ?>
		<?php echo $form->textField($model,'baptism_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->