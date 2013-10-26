<?php
/* @var $this VisitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Families'=>array('index'),
	$fid=>array('view','id'=>$fid),
	'Visits',
);

$this->menu=array(
	array('label'=>'Create Visits', 'url'=>array('visit/create','fid'=>$fid)),
);
?>

<h1>Visits to Family #<?php echo $fid ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'../visit/_view',
)); ?>
