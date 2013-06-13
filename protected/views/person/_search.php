<?php
/* @var $this PersonController */
/* @var $model People */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sex'); ?>
		<?php echo $form->textField($model,'sex',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'domicile_status'); ?>
		<?php echo $form->textField($model,'domicile_status',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<table><tr>
		<td>
		<?php echo $form->label($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
		</td>
		<td>
		<?php echo $form->label($model, 'age'); ?>
		<?php echo $form->textField($model,'age',array('size'=>4,'maxlength'=>8)); ?>
		</td>
		</tr></table>
	</div>

	<div class="row">
		<?php echo $form->label($model,'education'); ?>
		<?php echo $form->textField($model,'education',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profession'); ?>
		<?php echo $form->textField($model,'profession',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'occupation'); ?>
		<?php echo $form->textField($model,'occupation',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang_pri'); ?>
		<?php echo $form->textField($model,'lang_pri',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang_lit'); ?>
		<?php echo $form->textField($model,'lang_lit',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang_edu'); ?>
		<?php echo $form->textField($model,'lang_edu',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rite'); ?>
		<?php echo $form->textField($model,'rite',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<table><tr>
		<td>
		<?php echo $form->label($model,'baptism_dt'); ?>
		<?php echo $form->textField($model,'baptism_dt'); ?>
		</td>
		<td>
		<?php echo $form->label($model, 'baptised_yrs'); ?>
		<?php echo $form->textField($model,'baptised_yrs',array('size'=>4,'maxlength'=>8)); ?>
		</td>
		</tr></table>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptism_church'); ?>
		<?php echo $form->textField($model,'baptism_church',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptism_place'); ?>
		<?php echo $form->textField($model,'baptism_place',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'god_parents'); ?>
		<?php echo $form->textField($model,'god_parents',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<table><tr>
		<td>
		<?php echo $form->label($model,'first_comm_dt'); ?>
		<?php echo $form->textField($model,'first_comm_dt'); ?>
		</td><td>
		<?php echo $form->label($model, 'first_comm_yrs'); ?>
		<?php echo $form->textField($model,'first_comm_yrs',array('size'=>4,'maxlength'=>8)); ?>
		</td></tr>
		</table>
	</div>

	<div class="row">
		<table>
		<tr><td>
		<?php echo $form->label($model,'confirmation_dt'); ?>
		<?php echo $form->textField($model,'confirmation_dt'); ?>
		</td><td>
		<?php echo $form->label($model, 'confirmation_yrs'); ?>
		<?php echo $form->textField($model,'confirmation_yrs',array('size'=>4,'maxlength'=>8)); ?>
		</td></tr>
		</table>
	</div>

	<div class="row">
		<table>
		<tr><td>
		<?php echo $form->label($model,'marriage_dt'); ?>
		<?php echo $form->textField($model,'marriage_dt'); ?>
		</td><td>
		<?php echo $form->label($model, 'marriage_yrs'); ?>
		<?php echo $form->textField($model,'marriage_yrs',array('size'=>4,'maxlength'=>8)); ?>
		</td></tr>
		</table>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cemetery_church'); ?>
		<?php echo $form->textField($model,'cemetery_church',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'family_id'); ?>
		<?php echo $form->textField($model,'family_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('id' => 'submit-button')); ?>
		<?php echo CHtml::submitButton('Export to TSV', array('name' => 'export')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
