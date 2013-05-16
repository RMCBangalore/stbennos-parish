<?php
/* @var $this DeathCertificateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Death Certificates',
);

$this->menu=array(
	array('label'=>'Create DeathCertificate', 'url'=>array('create')),
	array('label'=>'Manage DeathCertificate', 'url'=>array('admin')),
);
?>

<h1>Death Certificates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
