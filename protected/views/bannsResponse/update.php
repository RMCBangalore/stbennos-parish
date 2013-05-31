<?php
/* @var $this BannsResponseController */
/* @var $model BannsResponse */

$this->breadcrumbs=array(
	'Banns Responses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BannsResponse', 'url'=>array('index')),
	array('label'=>'Create BannsResponse', 'url'=>array('create')),
	array('label'=>'View BannsResponse', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BannsResponse', 'url'=>array('admin')),
);
?>

<h1>Update BannsResponse <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>