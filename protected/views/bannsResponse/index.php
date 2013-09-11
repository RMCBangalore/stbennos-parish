<?php
/* @var $this BannsResponseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Banns Responses',
);

$this->menu=array(
	array('label'=>'Create BannsResponse', 'url'=>array('create')),
	array('label'=>'Manage BannsResponse', 'url'=>array('admin')),
);
?>

<h1>Banns Responses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
