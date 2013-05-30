<?php

  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.imgareaselect.min.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.imgareaselect/imgareaselect-default.css');

$this->breadcrumbs=array(
	'People'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Crop Person <?php echo $model->id; ?> Photo</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'people-photo-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

<?php
	$src = Yii::app()->request->baseUrl . '/images/uploaded/' . $pfile;
	$alt = $model->fname . "'s photo";
	echo CHtml::image($src, $alt, array('id' => 'photo', 'width' => $width, 'height' => $height));
	echo CHtml::hiddenField('x1', null, array('id' => 'x1'));
	echo CHtml::hiddenField('y1', null, array('id' => 'y1'));
	echo CHtml::hiddenField('width', null, array('id' => 'width'));
	echo CHtml::hiddenField('height', null, array('id' => 'height'));
	echo CHtml::hiddenField('zoom', $zoom, array('id' => 'zoom'));
	echo CHtml::hiddenField('pfile', $pfile, array('id' => 'pfile'));
?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
$('#photo').imgAreaSelect( {
	x1: 0,
	y1: 0,
	x2: 150,
	y2: 200,
	aspectRatio: '3:4',
	handles: true,
	onSelectEnd: function(img, selection) {
		var zoom = $('#zoom').val();
		$('#x1').val(selection.x1 / zoom);
		$('#y1').val(selection.y1 / zoom);
		$('#width').val(selection.width / zoom);
		$('#height').val(selection.height / zoom);
	} 
} );
</script>

