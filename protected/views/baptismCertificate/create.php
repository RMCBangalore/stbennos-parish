<?php
/* @var $this BaptismCertificateController */
/* @var $model BaptismCertificate */

$this->breadcrumbs=array(
	'Baptism Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaptismCertificate', 'url'=>array('index')),
	array('label'=>'Manage BaptismCertificate', 'url'=>array('admin')),
);
?>

<h1>Create BaptismCertificate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>