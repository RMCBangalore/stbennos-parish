<?php
/* @var $this SatisfactionDataController */
/* @var $model SatisfactionData */

$this->breadcrumbs=array(
	'Satisfaction Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SatisfactionData', 'url'=>array('index')),
	array('label'=>'Manage SatisfactionData', 'url'=>array('admin')),
);
?>

<h1>Create SatisfactionData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>