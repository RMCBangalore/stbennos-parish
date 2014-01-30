<?php
/* @var $this CollectionController */

$this->breadcrumbs=array(
	'Collection'=>array('/collection'),
	'Create',
);
?>
<h1>Create Collection</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
