<?php
/* @var $this PersonController */
/* @var $model People */

$this->breadcrumbs=array(
	'Peoples'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List People', 'url'=>array('index')),
	array('label'=>'Create People', 'url'=>array('create')),
	array('label'=>'Update People', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete People', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage People', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->fullname() . ': #' . $model->id; ?></h1>

<?php

	if ($model->photo) {
		$src = Yii::app()->request->baseUrl . '/images/members/' . $model->photo;
		$alt = $model->fname . "'s photo";
		list($width, $height) = getimagesize("./images/members/" . $model->photo);
		echo CHtml::image($src, $alt, array('width' => $width, 'height' => $height));
		echo "<p>";
		echo CHtml::link('Update Photo', array('photo', 'id'=>$model->id));
	} else {
		echo "<p>";
		echo CHtml::link('Upload Photo', array('photo', 'id'=>$model->id));
	}
	echo "</p>";

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mid',
		'fname',
		'lname',
		'sex',
		'domicile_status',
		'dob',
		'education',
		'profession',
		'occupation',
		'mobile',
		'email',
		'lang_pri',
		'lang_lit',
		'lang_edu',
		'rite',
		'baptism_dt',
		'baptism_church',
		'baptism_place',
		'god_parents',
		'first_comm_dt',
		'confirmation_dt',
		'marriage_dt',
		'cemetery_church',
		'family_id',
	),
)); ?>

<?php echo CHtml::link('Create Certificate', array('membershipCertificate/create', 'id' => $model->id)) ?>
