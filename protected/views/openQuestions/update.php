<?php
/* @var $this OpenQuestionsController */
/* @var $model OpenQuestion */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Open Questions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OpenQuestion', 'url'=>array('index')),
	array('label'=>'Create OpenQuestion', 'url'=>array('create')),
	array('label'=>'View OpenQuestion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OpenQuestion', 'url'=>array('admin')),
);
?>

<h1>Update OpenQuestion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>