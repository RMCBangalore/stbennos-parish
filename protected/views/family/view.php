<?php
/* @var $this FamilyController */
/* @var $model Families */

$this->breadcrumbs=array(
	'Families'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Create Family', 'url'=>array('create')),
	array('label'=>'Update Family', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Survey Family', 'url'=>array('survey', 'id'=>$model->id)),
	array('label'=>'Delete Family', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>View Family #<?php echo $model->id; ?></h1>

<?php
	$husband = $model->husband;
	$wife = $model->wife;
	$dependents = $model->dependents();
	$children = $model->children();
	if (count($children) >= 3) {
		$this->menu[count($this->menu)] = array('label'=>'More Children', 'url'=>array('children', 'id'=>$model->id));
	}
	$tabs = array(
        'tab1'=>array(
            'title'=>'Family Data',
            'view'=>'_view',
            'data'=>array(
                'data'=>$model,
            ),
        ),
        'tab2'=>array(
            'title'=>'Husband',
            'view'=>'../person/_view',
            'data'=>array(
				'person'=>'husband',
                'data'=>$husband,
            ),
        ),
        'tab3'=>array(
            'title'=>'Wife',
            'view'=>'../person/_view',
            'data'=>array(
				'person'=>'wife',
                'data'=>$wife,
            ),
        ),
	);
	for($i = 0; isset($dependents[$i]) and $i < 2; ++$i) {
		$n = 4 + $i;
		$j = 1 + $i;
		if (isset($dependents[$i])) {
			$dep = $dependents[$i];
			$tabs["tab$n"] = array(
				'title' => "Dependent $j",
				'view'	=> '../person/_view',
				'data'	=> array(
					'person'	=> "dependent][$i",
					'data'		=> $dep
				)
			);
		}
	}
	$ntabs = 4 + $i;
	for($i = 0; $i < 3; ++$i) {
		$n = $ntabs + $i;
		$j = 1 + $i;
		if (isset($children[$i])) {
			$child = $children[$i];
			$tabs["tab$n"] = array(
				'title' => "Child $j",
				'view'	=> '../person/_view',
				'data'	=> array(
					'person'	=> "child][$i",
					'data'		=> $child
				)
			);
		}
	}
?>
    <?php $this->widget('CTabView',array(
    'tabs'=>$tabs
	)); ?>

