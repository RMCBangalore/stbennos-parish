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
		<?php echo $form->dropDownList($model,'zone',FieldNames::values('zones'),array('prompt'=>'--- Select ---')); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'reg_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => "reg_date",
				'options'       => array(
						'dateFormat' => 'yy-mm-dd',
						'changeYear' => true,
						'maxDate'		=> 0,
				),
				'htmlOptions' => array(
						'size' => '10',         // textField size
						'maxlength' => '10',    // textField maxlength
				),
		)); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model, 'reg_yrs'); ?>
		<?php echo $form->textField($model,'reg_yrs',array('size'=>4,'maxlength'=>8)); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bpl_card'); ?>
		<?php echo $form->dropDownList($model,'bpl_card',array(0=>'No',1=>'Yes'),array('prompt'=>' -- Select -- ')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marriage_church'); ?>
		<?php echo $form->textField($model,'marriage_church',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'marriage_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => "marriage_date",
				'options'       => array(
						'dateFormat' => 'yy-mm-dd',
						'changeYear' => true,
						'maxDate'		=> 0,
				),
				'htmlOptions' => array(
						'size' => '10',         // textField size
						'maxlength' => '10',    // textField maxlength
				),
		)); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model, 'marriage_yrs'); ?>
		<?php echo $form->textField($model,'marriage_yrs',array('size'=>4,'maxlength'=>8)); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marriage_type'); ?>
		<?php echo $form->dropDownList($model,'marriage_type',FieldNames::values('marriage_type'),array('prompt'=>'--- Select ---')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marriage_status'); ?>
		<?php echo $form->dropDownList($model,'marriage_status',FieldNames::values('marriage_status'),array('prompt'=>'--- Select ---')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monthly_income'); ?>
		<?php echo $form->textField($model,'monthly_income',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('id' => 'submit-button')); ?>
		<?php echo CHtml::submitButton('Excel Export', array('name' => 'export')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
