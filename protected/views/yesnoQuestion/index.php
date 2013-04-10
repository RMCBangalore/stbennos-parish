<?php
/* @var $this YesnoQuestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Yesno Questions',
);

$this->menu=array(
	array('label'=>'Create YesnoQuestions', 'url'=>array('create')),
	array('label'=>'Manage YesnoQuestions', 'url'=>array('admin')),
);
?>

<h1>Yesno Questions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
