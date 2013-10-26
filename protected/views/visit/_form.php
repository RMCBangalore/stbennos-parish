<?php
/* @var $this VisitController */
/* @var $model Visits */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'visits-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'pastor_id'); ?>
		<?php echo $form->dropDownList($model,'pastor_id',$pastors); ?>
		<?php echo $form->error($model,'pastor_id'); ?>
	</span>
	<span class="rightHalf">
		<?php if (isset($fid)) {
			echo $form->hiddenField($model,'family_id',array('value'=>$fid));
		} else {
			echo $form->labelEx($model,'family_id');
			echo $form->dropDownList($model,'family_id',$famData);
		} ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'visit_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "visit_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'visit_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'purpose'); ?>
		<?php echo $form->dropDownList($model,"purpose",FieldNames::values('visit_purpose'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'purpose'); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
