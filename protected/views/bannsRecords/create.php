<?php
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */

$this->breadcrumbs=array(
	'Banns Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BannsRecord', 'url'=>array('index')),
	array('label'=>'Manage BannsRecord', 'url'=>array('admin')),
);
?>

<h1>Create BannsRecord</h1>

<?php if (isset($members)) {
	echo $this->renderPartial('_sel_member', array('model'=>$model, 'members' => $members));
} elseif (isset($member)) {
	echo $this->renderPartial('_form', array('model'=>$model, 'member' => $member, 'local' => $local));
} else {
	echo $this->renderPartial('_sel_local', array('model'=>$model));
}
 ?>
