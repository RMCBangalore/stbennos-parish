<?php
/* @var $this FamilyController */
/* @var $model Families */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'fid'); ?>
		<?php echo $form->textField($model,'fid',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'fid'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'addr_nm'); ?>
		<?php echo $form->textField($model,'addr_nm',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'addr_nm'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'addr_stt'); ?>
		<?php echo $form->textField($model,'addr_stt',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'addr_stt'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'addr_area'); ?>
		<?php echo $form->textField($model,'addr_area',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'addr_area'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'addr_pin'); ?>
		<?php echo $form->textField($model,'addr_pin',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'addr_pin'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'zone'); ?>
		<?php echo $form->dropDownList($model,'zone',FieldNames::values('zones'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'zone'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'yr_reg'); ?>
		<?php echo $form->textField($model,'yr_reg'); ?>
		<?php echo $form->error($model,'yr_reg'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'bpl_card'); ?>
		<?php echo $form->dropDownList($model,'bpl_card',array(0=>'No',1=>'Yes')); ?>
		<?php echo $form->error($model,'bpl_card'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'marriage_church'); ?>
		<?php echo $form->textField($model,'marriage_church',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'marriage_church'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'marriage_date'); ?>
		<?php echo $form->textField($model,'marriage_date'); ?>
		<?php echo $form->error($model,'marriage_date'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'marriage_type'); ?>
		<?php echo $form->dropDownList($model,'marriage_type',FieldNames::values('marriage_type'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'marriage_type'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'marriage_status'); ?>
		<?php echo $form->dropDownList($model,'marriage_status',FieldNames::values('marriage_status'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'marriage_status'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'monthly_income'); ?>
		<?php echo $form->dropDownList($model,'monthly_income',FieldNames::values('monthly_household_income'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'monthly_income'); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
