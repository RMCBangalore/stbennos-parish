
	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'bride_name'); ?>
		<?php echo $form->textField($model,'bride_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_name'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'bride_baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "bride_baptism_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'bride_baptism_dt'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'bride_status'); ?>
		<?php echo $form->dropDownList($model,'bride_status', array(
			'Married' => 'Married',
			'Widowed' => 'Widowed',
			'Divorced' => 'Divorced'), array('prompt' => '-- Select --')); ?>
		<?php echo $form->error($model,'bride_status'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'bride_rank_prof'); ?>
		<?php echo $form->textField($model,'bride_rank_prof',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'bride_rank_prof'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'bride_fathers_name'); ?>
		<?php echo $form->textField($model,'bride_fathers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_fathers_name'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'bride_mothers_name'); ?>
		<?php echo $form->textField($model,'bride_mothers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_mothers_name'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'bride_dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "bride_dob",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'bride_dob'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'bride_residence'); ?>
		<?php echo $form->textField($model,'bride_residence',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'bride_residence'); ?>
	</span>
	</div>


