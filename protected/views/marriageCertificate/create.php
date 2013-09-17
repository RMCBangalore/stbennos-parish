<?php
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Marriage Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
 	array('label'=>'Create MarriageRecord', 'url'=>array('/marriageRecords/create')),
	array('label'=>'List MarriageCertificate', 'url'=>array('index')),
	array('label'=>'Manage MarriageCertificate', 'url'=>array('admin')),
);

?>

<h1>Create Marriage Certificate</h1>

<?php echo $this->renderPartial('../marriageRecords/_form_cert', array('model'=>$model, 'data' => $data, 'now' => $now)); ?>


