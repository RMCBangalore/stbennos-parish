<?php
/* @var $this BannsResponseController */
/* @var $data BannsResponse */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $data->banns)); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('res_dt')); ?>:</b>
	<?php echo CHtml::encode($data->res_dt); ?>
	<br />


</div>
