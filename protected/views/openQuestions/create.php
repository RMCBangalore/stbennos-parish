<?php
/* @var $this OpenQuestionsController */
/* @var $model OpenQuestion */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Open Questions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OpenQuestion', 'url'=>array('index')),
	array('label'=>'Manage OpenQuestion', 'url'=>array('admin')),
);
?>

<h1>Create OpenQuestion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>