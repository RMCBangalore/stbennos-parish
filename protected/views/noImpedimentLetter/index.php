<?php
/* @var $this NoImpedimentLetterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'No Impediment Letters',
);

$this->menu=array(
 	array('label'=>'Create BannsRecord', 'url'=>array('/bannsRecords/create')),
	array('label'=>'Manage NoImpedimentLetter', 'url'=>array('admin')),
);
?>

<h1>No Impediment Letters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
