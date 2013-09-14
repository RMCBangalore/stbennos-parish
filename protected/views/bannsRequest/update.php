<?php
/* @var $this BannsRequestController */
/* @var $model BannsRequest */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Banns Requests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BannsRequest', 'url'=>array('index')),
	array('label'=>'View BannsRequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BannsRequest', 'url'=>array('admin')),
);
?>

<h1>Update BannsRequest <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>