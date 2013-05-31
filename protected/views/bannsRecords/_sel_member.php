<?php
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banns-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider' => $members,
			'columns' => array(
				array(
					'class' => 'CCheckBoxColumn',
					'selectableRows' => 1,
					'checkBoxHtmlOptions' => array(
						'name' => 'member'
					)
				),
				'fname',
				'lname',
				'dob',
				array(
					'value' => '$data->getParent()->fullname()',
					'name' => 'Parent Name'
				)
			),			
		));
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
