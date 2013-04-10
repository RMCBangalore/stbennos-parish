<?php
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'marriage-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'marriage_dt'); ?>
		<?php echo $form->textField($model,'marriage_dt'); ?>
		<?php echo $form->error($model,'marriage_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_name'); ?>
		<?php echo $form->textField($model,'groom_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_dob'); ?>
		<?php echo $form->textField($model,'groom_dob'); ?>
		<?php echo $form->error($model,'groom_dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_status'); ?>
		<?php echo $form->textField($model,'groom_status'); ?>
		<?php echo $form->error($model,'groom_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_rank_prof'); ?>
		<?php echo $form->textField($model,'groom_rank_prof',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'groom_rank_prof'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_fathers_name'); ?>
		<?php echo $form->textField($model,'groom_fathers_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_fathers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_mothers_name'); ?>
		<?php echo $form->textField($model,'groom_mothers_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_mothers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_residence'); ?>
		<?php echo $form->textField($model,'groom_residence',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'groom_residence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_name'); ?>
		<?php echo $form->textField($model,'bride_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_dob'); ?>
		<?php echo $form->textField($model,'bride_dob'); ?>
		<?php echo $form->error($model,'bride_dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_status'); ?>
		<?php echo $form->textField($model,'bride_status'); ?>
		<?php echo $form->error($model,'bride_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_rank_prof'); ?>
		<?php echo $form->textField($model,'bride_rank_prof',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'bride_rank_prof'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_fathers_name'); ?>
		<?php echo $form->textField($model,'bride_fathers_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_fathers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_mothers_name'); ?>
		<?php echo $form->textField($model,'bride_mothers_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_mothers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_residence'); ?>
		<?php echo $form->textField($model,'bride_residence',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'bride_residence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'banns_licence'); ?>
		<?php echo $form->textField($model,'banns_licence'); ?>
		<?php echo $form->error($model,'banns_licence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'minister'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'witness1'); ?>
		<?php echo $form->textField($model,'witness1',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'witness1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'witness2'); ?>
		<?php echo $form->textField($model,'witness2',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'witness2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->