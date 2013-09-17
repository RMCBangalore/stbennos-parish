<?php
/* @var $this BannsRequestController */
/* @var $model BannsRequest */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Banns Requests'=>array('index'),
	'Create',
);

$this->menu=array(
 	array('label'=>'Create BannsRecord', 'url'=>array('/bannsRecords/create')),
	array('label'=>'List BannsRequest', 'url'=>array('index')),
	array('label'=>'Manage BannsRequest', 'url'=>array('admin')),
);
?>

<h1>Create BannsRequest</h1>

<?php echo $this->renderPartial('_form_full', array(
	'model'=>$model,
	'data' => $banns,
	'now' => $now,
)); ?>

