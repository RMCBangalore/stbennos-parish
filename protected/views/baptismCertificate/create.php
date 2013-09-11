<?php
/* @var $this BaptismCertificateController */
/* @var $model BaptismCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Baptism Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaptismCertificate', 'url'=>array('index')),
	array('label'=>'Manage BaptismCertificate', 'url'=>array('admin')),
);
?>

<h1>Create Baptism Certificate</h1>

<?php echo $this->renderPartial('_form_full', array('model' => $model, 'data' => $data, 'now' => $now)); ?>
