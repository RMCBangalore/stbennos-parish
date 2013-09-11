<?php
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Banns Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BannsRecord', 'url'=>array('index')),
	array('label'=>'Create BannsRecord', 'url'=>array('create')),
	array('label'=>'View BannsRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BannsRecord', 'url'=>array('admin')),
);
?>

<h1>Update BannsRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>