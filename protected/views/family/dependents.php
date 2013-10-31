<?php
/* @var $this FamilyController */
/* @var $model Families */

$this->breadcrumbs=array(
	'Families'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Create Family', 'url'=>array('create')),
	array('label'=>'View Families', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>Family <?php echo $model->id; ?>: More Dependents</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php
	$tabs = array(
	);
	$dependents = $model->dependents();
	for($i = 0; $i < 7; ++$i) {
		$n = 2 + $i;
		$j = 3 + $i;
		$dependent = isset($dependents[$j-1]) ? $dependents[$j-1] : new People();
		$tabs["tab$n"] = array(
			'title' => "Dependent $j",
			'view'	=> '../person/_person_form',
			'data'	=> array(
				'form'		=> $form,
				'person'	=> "dependent][$i",
				'model'		=> $dependent
			)
		);
	}
?>
    <?php $this->widget('CTabView',array(
    'tabs'=>$tabs
	)); ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
