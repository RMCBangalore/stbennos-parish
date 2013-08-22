<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscription-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'family_id',array('value'=>$family->id)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'paid_by'); ?>
		<?php echo $form->textField($model,'paid_by',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'paid_by'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('Till Month', 'Subscription_till'); ?>
		<?php
			$dt = $start_dt;
			$now = new DateTime();
			$data = array();
			for ($i = 1; true; ++$i) {
				$dt->add(new DateInterval("P1M"));
				if ($dt > $now) {
					break;
				}

				$data[$i] = date_format($dt, 'M Y') . ' (' . $i . ' months)';
			}
			echo CHtml::dropDownList('Subscription[till]',null,$data,array('id'=>'Subscription_till','prompt' => '-- Select --')); ?>
	</span>

	<span class="rightHalf">
		<?php echo CHtml::label('Amount per month', 'Subscription_amount'); ?>
		<?php echo CHtml::textField('Subscription[amount]','',array('id'=>'Subscription_amount')); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
