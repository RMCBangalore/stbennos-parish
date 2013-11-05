
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parish-config-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php $err = Yii::app()->user->getFlash('error');
	if (!empty($err)) {
		echo '<div class="errorSummary">' . $err . '</div>';
	} 
	?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'name') ?>
	</span>
	<span class="rightHalf">
		<?php echo CHtml::label('Parish Logo', 'parish_logo'); ?>
		<?php echo CHtml::fileField('Parish[logo]', '', array('id'=>'parish_logo','size'=>15,'maxlength'=>30)); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'est_year'); ?>
		<?php echo $form->textField($model, 'est_year', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'est_year') ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model, 'address'); ?>
		<?php echo $form->textArea($model, 'address', array('rows'=>3,'cols'=>30)); ?>
		<?php echo $form->error($model, 'address') ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'city'); ?>
		<?php echo $form->textField($model, 'city', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'city') ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model, 'pin'); ?>
		<?php echo $form->textField($model, 'pin', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'pin') ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'phone'); ?>
		<?php echo $form->textField($model, 'phone', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'phone') ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model, 'website'); ?>
		<?php echo $form->textField($model, 'website', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'website') ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'mass_book_basic'); ?>
		<?php echo $form->textField($model, 'mass_book_basic', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'mass_book_basic') ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model, 'mass_book_sun'); ?>
		<?php echo $form->textField($model, 'mass_book_sun', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'mass_book_sun') ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

