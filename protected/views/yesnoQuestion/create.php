<?php
/* @var $this YesnoQuestionController */
/* @var $model YesnoQuestions */

$this->breadcrumbs=array(
	'Yesno Questions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List YesnoQuestions', 'url'=>array('index')),
	array('label'=>'Manage YesnoQuestions', 'url'=>array('admin')),
);
?>

<h1>Create YesnoQuestions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>