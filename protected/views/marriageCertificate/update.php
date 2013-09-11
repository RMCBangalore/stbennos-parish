<?php
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Marriage Certificates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MarriageCertificate', 'url'=>array('index')),
	array('label'=>'Create MarriageCertificate', 'url'=>array('create')),
	array('label'=>'View MarriageCertificate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MarriageCertificate', 'url'=>array('admin')),
);
?>

<h1>Update MarriageCertificate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>