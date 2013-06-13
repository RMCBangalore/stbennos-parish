<?php ?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_name')); ?>:</b>
	<?php echo CHtml::encode($data->groom_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parent')); ?>:</b>
	<?php echo CHtml::encode($data->groom_parent); ?>
	<br />

	<?php if (ctype_digit($data->groom_parish)) { ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parish')); ?>:</b>
	<?php echo BannsRecord::get_parish($data->groom_parish); ?>
	<br />

	<b><?php echo 'Groom DOB' ?>:</b>
	<?php echo $data->groom()->dob; ?>
	<br />

	<b><?php echo 'Groom Baptism Date' ?>:</b>
	<?php echo $data->groom()->baptism_dt; ?>
	<br />

	<?php } else {?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parish')); ?>:</b>
	<?php echo CHtml::encode($data->groom_parish); ?>
	<br />

	<?php } ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_name')); ?>:</b>
	<?php echo CHtml::encode($data->bride_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_parent')); ?>:</b>
	<?php echo CHtml::encode($data->bride_parent); ?>
	<br />

	<?php if (ctype_digit($data->bride_parish)) {
		echo '<b>' . CHtml::encode($data->getAttributeLabel('bride_parish')) . ':</b> ';
		echo BannsRecord::get_parish($data->bride_parish);
		echo '<br />';

		echo '<b>Bride DOB:</b> ';
		echo $data->bride()->dob;
		echo '<br />';

		echo '<b>Bride Baptism Date:</b> ';
		echo $data->bride()->baptism_dt;
		echo '<br />';

	} else {
		echo '<b>' . CHtml::encode($data->getAttributeLabel('bride_parish')) . ':</b> ';
		echo BannsRecord::get_parish($data->bride_parish);
		echo '<br />';
	} ?>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt1')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt2')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt3')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt3); ?>
	<br />

	*/ ?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'banns-response-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'res_dt'); ?>
		<?php echo $form->textField($model,'res_dt',array('size'=>15,'maxlength'=>75,'value'=>$now, 'readonly' => 1)); ?>
		<?php echo $form->error($model,'res_dt'); ?>
	</div>

		<?php echo $form->hiddenField($model,'banns_id',array('value'=>$data->id)); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
