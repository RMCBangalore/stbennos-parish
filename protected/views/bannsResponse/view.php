<?php
/* @var $this BannsResponseController */
/* @var $model BannsResponse */

$this->breadcrumbs=array(
	'Banns Responses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BannsResponse', 'url'=>array('index')),
	array('label'=>'Create BannsResponse', 'url'=>array('create')),
	array('label'=>'Update BannsResponse', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BannsResponse', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BannsResponse', 'url'=>array('admin')),
);
?>

<h1>View BannsResponse #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $model->banns)); ?>

<b><?php echo CHtml::encode($model->getAttributeLabel('res_dt')); ?>:</b>
<?php echo CHtml::encode($model->res_dt); ?>
<br />

<?php echo CHtml::link('Download Letter', array('viewCert', 'id' => $model->id), array('target' => '_blank')) ?>
