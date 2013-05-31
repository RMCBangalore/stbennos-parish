<?php
/* @var $this NoImpedimentLetterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'No Impediment Letters',
);

$this->menu=array(
	array('label'=>'Create NoImpedimentLetter', 'url'=>array('create')),
	array('label'=>'Manage NoImpedimentLetter', 'url'=>array('admin')),
);
?>

<h1>No Impediment Letters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
