<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.imgareaselect.min.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.imgareaselect/imgareaselect-default.css');

$this->breadcrumbs=array(
	'Families'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

/* $this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Create Family', 'url'=>array('create')),
	array('label'=>'View Family', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Families', 'url'=>array('admin')),
); */
?>

<h1>Crop Family <?php echo $model->id; ?> Photo</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-photo-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php
	$src = Yii::app()->request->baseUrl . '/images/uploaded/' . $pfile;
	$alt = "Family photo";
	echo CHtml::image($src, $alt, array('id' => 'photo', 'width' => $width, 'height' => $height));
	echo CHtml::hiddenField('x1', null, array('id' => 'x1'));
	echo CHtml::hiddenField('y1', null, array('id' => 'y1'));
	echo CHtml::hiddenField('width', null, array('id' => 'width'));
	echo CHtml::hiddenField('height', null, array('id' => 'height'));
	echo CHtml::hiddenField('zoom', $zoom, array('id' => 'zoom'));
	echo CHtml::hiddenField('pfile', $pfile, array('id' => 'pfile'));
?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
<?php
	$x1 = $width / 2 - 200;
	$y1 = $height / 2 - 138;
	$x2 = $x1 + 400;
	$y2 = $y1 + 275;
?>
$('#families-photo-form').submit(function(e) {
	if ('' == $('#width').val()) {
		alert("Image needs to be cropped. Please crop and submit");
		return false;
	}
	return true;
} );
$('#photo').imgAreaSelect( {
	x1: <?php echo $x1 ?>,
	y1: <?php echo $y1 ?>,
	x2: <?php echo $x2 ?>,
	y2: <?php echo $y2 ?>,
	aspectRatio: '16:11',
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

