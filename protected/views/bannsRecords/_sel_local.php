<?php
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banns-record-form',
	'enableAjaxValidation'=>false,
	'method'=>'GET'
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::label('Who is from our parish?', 'local', array('required' => true)); ?>
		<?php echo CHtml::dropDownList('local','',array(
			'bride' => 'Bride',
			'groom' => 'Groom',
			'both'	=> 'Both'
		), array('size' => 3)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
