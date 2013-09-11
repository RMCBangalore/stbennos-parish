<?php
/* @var $this OpenQuestionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Open Questions',
);

$this->menu=array(
	array('label'=>'Create OpenQuestion', 'url'=>array('create')),
	array('label'=>'Manage OpenQuestion', 'url'=>array('admin')),
);
?>

<h1>Open Questions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
