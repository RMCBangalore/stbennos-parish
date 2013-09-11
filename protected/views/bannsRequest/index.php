<?php
/* @var $this BannsRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Banns Requests',
);

$this->menu=array(
	array('label'=>'Create BannsRequest', 'url'=>array('create')),
	array('label'=>'Manage BannsRequest', 'url'=>array('admin')),
);
?>

<h1>Banns Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
