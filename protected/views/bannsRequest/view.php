<?php
/* @var $this BannsRequestController */
/* @var $model BannsRequest */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Banns Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BannsRequest', 'url'=>array('index')),
	array('label'=>'Create BannsRequest', 'url'=>array('create')),
	array('label'=>'Update BannsRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BannsRequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BannsRequest', 'url'=>array('admin')),
);
?>

<h1>View BannsRequest #<?php echo $model->id; ?></h1>


<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $model->banns)); ?>

<b><?php echo CHtml::encode($model->getAttributeLabel('req_dt')); ?>:</b>
<?php echo CHtml::encode($model->req_dt); ?>
<br />

<?php echo CHtml::link('Download Letter', array('viewCert', 'id' => $model->id), array('target' => '_blank')) ?>
