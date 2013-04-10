<?php
/* @var $this NeedDataController */
/* @var $model NeedData */

$this->breadcrumbs=array(
	'Need Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NeedData', 'url'=>array('index')),
	array('label'=>'Create NeedData', 'url'=>array('create')),
	array('label'=>'Update NeedData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NeedData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NeedData', 'url'=>array('admin')),
);
?>

<h1>View NeedData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'family_id',
		'id',
		'need_id',
		'need_value',
	),
)); ?>
