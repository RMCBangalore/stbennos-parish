<?php
/* @var $this CollectionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Collections',
);
?>
<h1>Collections</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
