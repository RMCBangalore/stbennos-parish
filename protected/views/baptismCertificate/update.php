<?php
/* @var $this BaptismCertificateController */
/* @var $model BaptismCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Baptism Certificates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
 	array('label'=>'Create BaptismRecord', 'url'=>array('/baptismRecords/create')),
	array('label'=>'List BaptismCertificate', 'url'=>array('index')),
	array('label'=>'View BaptismCertificate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BaptismCertificate', 'url'=>array('admin')),
);
?>

<h1>Update BaptismCertificate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>