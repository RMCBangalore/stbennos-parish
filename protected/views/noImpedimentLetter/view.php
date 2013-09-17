<?php
/* @var $this NoImpedimentLetterController */
/* @var $model NoImpedimentLetter */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'No Impediment Letters'=>array('index'),
	$model->id,
);

$this->menu=array(
 	array('label'=>'Create BannsRecord', 'url'=>array('/bannsRecords/create')),
	array('label'=>'List NoImpedimentLetter', 'url'=>array('index')),
	array('label'=>'Update NoImpedimentLetter', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NoImpedimentLetter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NoImpedimentLetter', 'url'=>array('admin')),
);
?>

<h1>View NoImpedimentLetter #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $model->banns)); ?>

<b><?php echo CHtml::encode($model->getAttributeLabel('letter_dt')); ?>:</b>
<?php echo CHtml::encode($model->letter_dt); ?>
<br />

<?php echo CHtml::link('Download Letter', array('viewCert', 'id' => $model->id), array('target' => '_blank')) ?>
