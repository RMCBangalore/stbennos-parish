<div class="view">

<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $data)); ?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'banns-request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'letter_dt'); ?>
		<?php echo $form->textField($model,'letter_dt',array('size'=>15,'maxlength'=>75,'value'=>$now, 'readonly' => 1)); ?>
		<?php echo $form->error($model,'letter_dt'); ?>
	</div>

		<?php echo $form->hiddenField($model,'banns_id',array('value'=>$data->id)); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
