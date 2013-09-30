<?php
/* @var $this BannsRecordsController */
/* @var $data BannsRecord */

?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_name')); ?>:</b>
	<?php echo CHtml::encode($data->groom_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parent')); ?>:</b>
	<?php echo CHtml::encode($data->groom_parent); ?>
	<br />

	<?php if (ctype_digit($data->groom_parish)) { $local = 'groom' ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parish')); ?>:</b>
	<?php echo BannsRecord::get_parish($data->groom_parish); ?>
	<br />

	<b><?php echo 'Groom DOB' ?>:</b>
	<?php echo $data->groom()->dob; ?>
	<br />

	<b><?php echo 'Groom Baptism Date' ?>:</b>
	<?php echo $data->groom()->baptism_dt; ?>
	<br />

	<?php } else {?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parish')); ?>:</b>
	<?php echo CHtml::encode($data->groom_parish); ?>
	<br />

	<?php } ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_name')); ?>:</b>
	<?php echo CHtml::encode($data->bride_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_parent')); ?>:</b>
	<?php echo CHtml::encode($data->bride_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_parish')); ?>:</b>
	<?php echo BannsRecord::get_parish($data->bride_parish); ?>
	<br />

	<?php if (ctype_digit($data->bride_parish)) {

		if (isset($local)) {
			$local = 'both';
		} else {
			$local = 'bride';
		}

		echo '<b>Bride DOB:</b> ';
		echo CHtml::encode($data->bride()->dob);
		echo '<br />';

		echo '<b>Bride Baptism Date:</b> ';
		echo CHtml::encode($data->bride()->baptism_dt);
		echo '<br />';

	} ?>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt1')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt2')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt3')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt3); ?>
	<br />

	*/ ?>

	<?php if (isset($local) and 'both' != $local) {
		echo CHtml::link('Create Request', array('bannsRequest/create', 'bid' => $data->id));
		echo '<br />';
		echo CHtml::link('Create Response', array('bannsResponse/create', 'bid' => $data->id));
		echo '<br />';
		echo CHtml::link('Create No Impediment Letter', array('noImpedimentLetter/create', 'bid' => $data->id));
		echo '<br />';
	} ?>

</div>
