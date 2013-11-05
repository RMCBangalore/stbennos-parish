<?php

$this->breadcrumbs=array(
	'Site Config'
);
?>

<h1>Configure Parish Data</h1>

<p>
<?php
$msg = Yii::app()->user->getFlash('msg');
if (!empty($msg)) {
	echo '<div class="msgSummary">' . $msg . '</div>';
} else {
	echo 'Use this form to configure your parish data to fine-tune St. Bennos to your parish.';
}
?>
</p>

<?php $this->renderPartial('_config', array('model' => $model)) ?>
