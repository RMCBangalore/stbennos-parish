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
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Banns Records'=>array('index'),
	$model->id,
);

Yii::app()->clientScript->registerScript('createBannsLetters', "
$('#banns-letter-form a').click(function(e) {
	frm = $('#banns-letter-form');
	frm.attr('action', $(this).attr('href'));
	frm.submit();
	return false;
} );
");

$this->menu=array(
	array('label'=>'List BannsRecord', 'url'=>array('index')),
	array('label'=>'Create BannsRecord', 'url'=>array('create')),
	array('label'=>'Update BannsRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BannsRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BannsRecord', 'url'=>array('admin')),
	array('label'=>'View Banns Requests', 'url'=>array('/bannsRequest/byRecord', 'id'=>$model->id)),
	array('label'=>'View Banns Responses', 'url'=>array('/bannsResponse/byRecord', 'id'=>$model->id)),
	array('label'=>'View No Impediment Letters', 'url'=>array('/noImpedimentLetter/byRecord', 'id'=>$model->id)),
);

?>

<div class="view">

<h1><?php echo $model->groom_name . ' & ' . $model->bride_name ?>: #<?php echo $model->id; ?></h1>

<?php
	$letters = false;
	if (ctype_digit($model->groom_parish) xor ctype_digit($model->bride_parish)) {
		$letters = true;
	}
$model->groom_parish = BannsRecord::get_parish($model->groom_parish);
$model->bride_parish = BannsRecord::get_parish($model->bride_parish);

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'groom_parent',
		'groom_parish',
		'bride_parent',
		'bride_parish',
		'banns_dt1',
		'banns_dt2',
		'banns_dt3',
	),
));

echo '<br />';
echo CHtml::link('Edit', array('bannsRecords/update', 'id'=>$model->id));

if ($letters) {
	if ($model->requests) {
		echo ' | ';
		echo CHtml::link('View Request Letters', array('bannsRequest/byRecord', 'id' => $model->id));
	}
	if ($model->responses) {
		echo ' | ';
		echo CHtml::link('View Response Letters', array('bannsResponse/byRecord', 'id' => $model->id));
	}
	if ($model->noImpedimentLetters) {
		echo ' | ';
		echo CHtml::link('View No Impediment Letters', array('noImpedimentLetter/byRecord', 'id' => $model->id));
	}
}
 ?>
</div><!-- view -->

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'banns-letter-form',
	'enableAjaxValidation' => false,
));
echo CHtml::hiddenField('banns_id', $model->id, array('id'=>'banns_id'));
echo CHtml::hiddenField('cert_dt', Yii::app()->dateFormatter->formatDateTime(time(), 'short', null), array('id'=>'cert_dt'));
if ($letters) {
	echo CHtml::link('Create Request Letter', array('bannsRequest/create', 'bid' => $model->id), array('class' => 'request'));
	echo ' | ';
	echo CHtml::link('Create Response Letter', array('bannsResponse/create', 'bid' => $model->id), array('class' => 'response'));
	echo ' | ';
	echo CHtml::link('Create No Impediment Letter', array('noImpedimentLetter/create', 'bid' => $model->id), array('class' => 'noImpediment'));
	echo '<br />';
}
$this->endWidget();
?>
