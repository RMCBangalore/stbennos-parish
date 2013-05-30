<?php
/* @var $this BannsRequestController */
/* @var $data BannsRequest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_id')); ?>:</b>
	<?php echo CHtml::encode($data->banns_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_dt')); ?>:</b>
	<?php echo CHtml::encode($data->req_dt); ?>
	<br />


</div>