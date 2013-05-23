<?php
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */

$this->breadcrumbs=array(
	'Banns Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BannsRecord', 'url'=>array('index')),
	array('label'=>'Manage BannsRecord', 'url'=>array('admin')),
);
?>

<h1>Create BannsRecord</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>