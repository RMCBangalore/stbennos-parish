<?php
/* @var $this VisitController */
/* @var $model Visits */

$this->breadcrumbs=array(
	'Visits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Visits', 'url'=>array('index')),
	array('label'=>'Manage Visits', 'url'=>array('admin')),
);
?>

<h1>Create Visits</h1>

<?php 
$params = array('model'=>$model, 'pastors'=>$pastors);
if (isset($fid)) {
	$params['fid'] = $fid;
} else {
	$params['famData'] = $famData;
}
echo $this->renderPartial('_form', $params); ?>
