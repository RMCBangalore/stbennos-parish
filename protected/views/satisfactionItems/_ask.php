<?php
/* @var $this SatisfactionItemController */
/* @var $data SatisfactionItems */
?>

	<b><?php echo CHtml::encode($data->text); ?>:</b>

	<?php $sid = $data->id;
		echo $form->dropDownList($model, "[SatisfactionData][$sid]value", FieldNames::values('satisfaction_level'));
	<br />
