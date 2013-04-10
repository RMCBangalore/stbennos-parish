<?php
/* @var $this FirstCommunionCertificateController */
/* @var $model FirstCommunionCertificate */

$this->breadcrumbs=array(
	'First Communion Certificates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FirstCommunionCertificate', 'url'=>array('index')),
	array('label'=>'Create FirstCommunionCertificate', 'url'=>array('create')),
	array('label'=>'View FirstCommunionCertificate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FirstCommunionCertificate', 'url'=>array('admin')),
);
?>

<h1>Update FirstCommunionCertificate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>