<?php
/* @var $this InstallController */

$this->breadcrumbs=array(
	'Install',
);
?>
<h1>Welcome to St. Bennos Parish Software</h1>

<p>
If you are seeing this page, it means you are ready to install St. Bennos Parish Software!<br /> Doing this is as simple as 1, 2, 3.
</p>

<h2>Step 1: Configure your database</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'db-setup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php $err = Yii::app()->user->getFlash('error');
	if (!empty($err)) {
		echo '<div class="errorSummary">' . $err . '</div>';
	} ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('Database Type', 'driver'); ?>
		<?php echo CHtml::textField('driver', 'mysql', array('readonly' => true, 'size'=>15,'maxlength'=>30)); ?>
	</span>
	<span class="rightHalf">
		<?php echo CHtml::label('Database Name', 'dbname', array('required'=>empty($dbname))); ?>
		<?php echo CHtml::textField('dbname', $dbname, array('readonly' => !empty($dbname), 'size'=>15,'maxlength'=>30)); ?>
	</span>
	</div>

	<div class="row">
		<?php echo CHtml::label('Database Username', 'dbuser', array('required'=>true)); ?>
		<?php echo CHtml::textField('dbuser', '', array('size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('Database Password', 'dbpass', array('required'=>true)); ?>
		<?php echo CHtml::passwordField('dbpass', '', array('size'=>15,'maxlength'=>30)); ?>
	</span>
	<span class="rightHalf">
		<?php echo CHtml::label('Re-enter Password', 'reenter_pass', array('required'=>true)); ?>
		<?php echo CHtml::passwordField('reenter_pass', '', array('size'=>15,'maxlength'=>30)); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Next'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
