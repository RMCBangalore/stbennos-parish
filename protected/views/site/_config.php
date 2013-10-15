
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parish-config-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php $err = Yii::app()->user->getFlash('error');
	if (!empty($err)) {
		echo '<div class="errorSummary">' . $err . '</div>';
	} ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('Parish Name', 'parish_name', array('required'=>true)); ?>
		<?php echo CHtml::textField('parish_name', '', array('size'=>15,'maxlength'=>30)); ?>
	</span>
	<span class="rightHalf">
		<?php echo CHtml::label('Parish Logo', 'parish_logo'); ?>
		<?php echo CHtml::fileField('parish[logo]', '', array('id'=>'parish_logo','size'=>15,'maxlength'=>30)); ?>
	</span>
	</div>

	<div class="row">
		<?php echo CHtml::label('Parish Address', 'parish_addr', array('required'=>true)); ?>
		<?php echo CHtml::textArea('parish_addr', '', array('rows'=>3,'cols'=>30)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('City', 'parish_city', array('required'=>true)); ?>
		<?php echo CHtml::textField('parish_city', '', array('size'=>15,'maxlength'=>30)); ?>
	</span>
	<span class="rightHalf">
		<?php echo CHtml::label('PIN Code', 'parish_pin', array('required'=>true)); ?>
		<?php echo CHtml::textField('parish_pin', '', array('size'=>15,'maxlength'=>30)); ?>
	</span>
	</div>

	<div class="row">
		<?php echo CHtml::label('Mass Booking Amount', 'mass_book_amt', array('required'=>true)); ?>
		<?php echo CHtml::textField('mass_book_amt', '', array('size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

