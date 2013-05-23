<?php
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */

$this->breadcrumbs=array(
	'Banns Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BannsRecord', 'url'=>array('index')),
	array('label'=>'Create BannsRecord', 'url'=>array('create')),
	array('label'=>'Update BannsRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BannsRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BannsRecord', 'url'=>array('admin')),
);
?>

<h1>View BannsRecord #<?php echo $model->id; ?></h1>


<?php
if (!isset($model->groom_parish)) {
	$model->groom_parish = Yii::app()->params['parishName'];
}
if (!isset($model->bride_parish)) {
	$model->bride_parish = Yii::app()->params['parishName'];
}
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'groom_name',
		'groom_parent',
		'groom_parish',
		'bride_name',
		'bride_parent',
		'bride_parish',
		'banns_dt1',
		'banns_dt2',
		'banns_dt3',
	),
)); ?>
