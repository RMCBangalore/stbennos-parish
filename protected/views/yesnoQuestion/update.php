<?php
/* @var $this YesnoQuestionController */
/* @var $model YesnoQuestions */

$this->breadcrumbs=array(
	'Yesno Questions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List YesnoQuestions', 'url'=>array('index')),
	array('label'=>'Create YesnoQuestions', 'url'=>array('create')),
	array('label'=>'View YesnoQuestions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage YesnoQuestions', 'url'=>array('admin')),
);
?>

<h1>Update YesnoQuestions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>