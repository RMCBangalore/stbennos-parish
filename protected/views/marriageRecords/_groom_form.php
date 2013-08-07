
	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_name'); ?>
		<?php echo $form->textField($model,'groom_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_name'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "groom_baptism_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'groom_baptism_dt'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_status'); ?>
		<?php echo $form->dropDownList($model,'groom_status', array(
			'Married' => 'Married',
			'Widowed' => 'Widowed',
			'Divorced' => 'Divorced'), array('prompt' => '-- Select --')); ?>
		<?php echo $form->error($model,'groom_status'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_rank_prof'); ?>
		<?php echo $form->textField($model,'groom_rank_prof',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'groom_rank_prof'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_fathers_name'); ?>
		<?php echo $form->textField($model,'groom_fathers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_fathers_name'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_mothers_name'); ?>
		<?php echo $form->textField($model,'groom_mothers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_mothers_name'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "groom_dob",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'groom_dob'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_residence'); ?>
		<?php echo $form->textField($model,'groom_residence',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'groom_residence'); ?>
	</span>
	</div>


