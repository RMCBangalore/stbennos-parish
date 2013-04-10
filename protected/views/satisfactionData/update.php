<?php
/* @var $this SatisfactionDataController */
/* @var $model SatisfactionData */

$this->breadcrumbs=array(
	'Satisfaction Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SatisfactionData', 'url'=>array('index')),
	array('label'=>'Create SatisfactionData', 'url'=>array('create')),
	array('label'=>'View SatisfactionData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SatisfactionData', 'url'=>array('admin')),
);
?>

<h1>Update SatisfactionData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>