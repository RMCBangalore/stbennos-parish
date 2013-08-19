<?php
/* @var $this PersonController */
/* @var $model People */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'people-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fname'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'lname'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->dropDownList($model,'sex',FieldNames::values('sex'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'dob',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'maxDate'	=> 0,
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'dob'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'domicile_status'); ?>
		<?php echo $form->dropDownList($model,'domicile_status',FieldNames::values('domicile_status')); ?>
		<?php echo $form->error($model,'domicile_status'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'education'); ?>
		<?php echo $form->dropDownList($model,'education',FieldNames::values('education')); ?>
		<?php echo $form->error($model,'education'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'profession'); ?>
		<?php echo $form->textField($model,'profession',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'profession'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'occupation'); ?>
		<?php echo $form->textField($model,'occupation',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'occupation'); ?>
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
		<?php echo $form->labelEx($model,'lang_pri'); ?>
		<?php echo $form->dropDownList($model,'lang_pri',FieldNames::values('languages')); ?>
		<?php echo $form->error($model,'lang_pri'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'lang_lit'); ?>
		<?php echo $form->dropDownList($model,'lang_lit',FieldNames::values('languages')); ?>
		<?php echo $form->error($model,'lang_lit'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'lang_edu'); ?>
		<?php echo $form->dropDownList($model,'lang_edu',FieldNames::values('languages')); ?>
		<?php echo $form->error($model,'lang_edu'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'rite'); ?>
		<?php echo $form->dropDownList($model,'rite',FieldNames::values('rite'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'rite'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'baptism_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true,
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt >= $.datepicker.parseDate("yy-mm-dd", $("#People_dob").val()),
					"", "Cannot be before date of birth"); }'
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'baptism_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'baptism_church'); ?>
		<?php echo $form->textField($model,'baptism_church',array('size'=>25,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'baptism_church'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'baptism_place'); ?>
		<?php echo $form->textField($model,'baptism_place',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'baptism_place'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'god_parents'); ?>
		<?php echo $form->textField($model,'god_parents',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'god_parents'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'first_comm_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'first_comm_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt >= $.datepicker.parseDate("yy-mm-dd", $("#People_baptism_dt").val()),
					"", "Cannot be before baptism date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'first_comm_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'confirmation_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'confirmation_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt >= $.datepicker.parseDate("yy-mm-dd", $("#People_baptism_dt").val()),
					"", "Cannot be before baptism date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'confirmation_dt'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'marriage_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'marriage_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt >= $.datepicker.parseDate("yy-mm-dd", $("#People_confirmation_dt").val()),
					"", "Cannot be before confirmation date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'marriage_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'cemetery_church'); ?>
		<?php echo $form->textField($model,'cemetery_church',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'cemetery_church'); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
