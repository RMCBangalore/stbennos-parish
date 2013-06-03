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
} elseif (isset($local)) {
	$parms = array('model'=>$model, 'local' => $local);
	if ('both' == $local) {
		$parms['bride'] = $bride;
		$parms['groom'] = $groom;
	} else {
		$parms[$local] = ${$local};
	}
	echo $this->renderPartial('_form', $parms);
} else {
	echo $this->renderPartial('_sel_local', array('model'=>$model));
}
 ?>
