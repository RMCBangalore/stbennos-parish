<?php
/* @var $this MarriageCertificateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Marriage Certificates',
);

$this->menu=array(
	array('label'=>'Manage MarriageCertificate', 'url'=>array('admin')),
);
?>

<h1>Marriage Certificates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_summ',
)); ?>
