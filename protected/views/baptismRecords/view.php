<?php
/* @var $this BaptismRecordsController */
/* @var $model BaptismRecord */

$this->breadcrumbs=array(
	'Registers' => array('site/page', 'view' => 'registers'),
	'Baptism Records'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List BaptismRecord', 'url'=>array('index')),
	array('label'=>'Create BaptismRecord', 'url'=>array('create')),
	array('label'=>'Update BaptismRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BaptismRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaptismRecord', 'url'=>array('admin')),
	array('label'=>'View Certificates', 'url'=>array('/baptismCertificate/byRecord', 'id'=>$model->id)),
);
?>

<h1>View BaptismRecord #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_view_main', array('data' => $model));

/*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dob',
		'baptism_dt',
		'name',
		'sex',
		'fathers_name',
		'mothers_name',
		'residence',
		'godfathers_name',
		'godmothers_name',
		'minister',
	),
)); i*/ ?>
