<?php
/* @var $this FamilyController */
/* @var $model Families */
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
		<?php echo $form->label($model,'fid'); ?>
		<?php echo $form->textField($model,'fid',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addr_nm'); ?>
		<?php echo $form->textField($model,'addr_nm',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addr_stt'); ?>
		<?php echo $form->textField($model,'addr_stt',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addr_area'); ?>
		<?php echo $form->textField($model,'addr_area',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addr_pin'); ?>
		<?php echo $form->textField($model,'addr_pin',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zone'); ?>
		<?php echo $form->textField($model,'zone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'yr_reg'); ?>
		<?php echo $form->textField($model,'yr_reg'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bpl_card'); ?>
		<?php echo $form->textField($model,'bpl_card'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marriage_church'); ?>
		<?php echo $form->textField($model,'marriage_church',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marriage_date'); ?>
		<?php echo $form->textField($model,'marriage_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marriage_type'); ?>
		<?php echo $form->textField($model,'marriage_type',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marriage_status'); ?>
		<?php echo $form->textField($model,'marriage_status',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monthly_income'); ?>
		<?php echo $form->textField($model,'monthly_income',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->