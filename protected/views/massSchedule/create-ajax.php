<style>
fieldset {
	border: 1px solid #aaa;
	padding: 10px 20px;
}
fieldset legend {
	font-weight: bold;
	padding: 1px 4px;
}
#mass-schedule-form {
	width: 400px;
}
#mass-schedule-form span.leftThird,
#mass-schedule-form span.centerThird,
#mass-schedule-form span.rightThird {
	width: 32%;
}
div.row {
	text-align: center;
}
div.row.buttons {
	width: 98%;
}
div.row.buttons input {
	width: 270px;
	padding: 3px 10px;
	border-width: 2px;
}
</style>

<fieldset>
<legend>Add Mass</legend>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</fieldset>
