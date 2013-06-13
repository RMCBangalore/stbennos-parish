<?php
/* @var $this PersonController */
/* @var $model People */

$this->breadcrumbs=array(
	'People'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List People', 'url'=>array('index')),
	array('label'=>'Create Person', 'url'=>array('create')),
	array('label'=>'View Person', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage People', 'url'=>array('admin')),
);
?>

<h1>Update Person Photo <?php echo $model->id; ?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php if (Yii::app()->params['photoManip']) {
			$field = 'raw_photo';
		} else {
			$field = 'photo';
		}
		echo $form->labelEx($model, 'photo');
		echo $form->fileField($model, $field);
	?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->
