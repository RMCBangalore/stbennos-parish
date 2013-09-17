	<?php if (!$data) { ?>
		No data exists
	<?php } else { ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('mid')); ?>:</b>
	<?php echo CHtml::encode($data->mid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode(isset($data->sex) ? FieldNames::value('sex', $data->sex) : ''); ?>
	<br />
	
	<?php if ('child' == $data->role) { ?>
	
	<?php $father = $data->family->husband; if (isset($father)) { ?>

	<b>Father's <?php echo CHtml::encode($father->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($father->fname); ?>
	<br />
	
	<b>Father's <?php echo CHtml::encode($father->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($father->lname); ?>
	<br />
	
	<?php } ?>

	<?php } ?>

	<?php } ?>
