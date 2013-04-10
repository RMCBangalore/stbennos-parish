<?php
/* @var $this AwarenessDataController */
/* @var $model AwarenessData */

$this->breadcrumbs=array(
	'Awareness Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AwarenessData', 'url'=>array('index')),
	array('label'=>'Manage AwarenessData', 'url'=>array('admin')),
);
?>

<h1>Create AwarenessData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>