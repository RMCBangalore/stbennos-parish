<?php
/* @var $this BannsRequestController */
/* @var $data BannsRequest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	
	<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $data->banns)); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_dt')); ?>:</b>
	<?php echo CHtml::encode($data->req_dt); ?>
	<br />


</div>
