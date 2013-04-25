<?php
/* @var $this FamilyController */
/* @var $model Families */

$this->breadcrumbs=array(
	'Families'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Create Family', 'url'=>array('create')),
	array('label'=>'View Family', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>Update Family <?php echo $model->id; ?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php
	$husband = $model->husband;
	if (!isset($husband)) {
		$husband = new People();
	}
	$wife = $model->wife;
	if (!isset($wife)) {
		$wife = new People();
	}
	$children = $model->children();
	$dependent = new People();
	$tabs = array(
        'tab1'=>array(
            'title'=>'Family Data',
            'view'=>'_form_fields',
            'data'=>array(
				'form'=>$form,
                'model'=>$model,
            ),
        ),
        'tab2'=>array(
            'title'=>'Husband',
            'view'=>'../person/_person_form',
            'data'=>array(
				'form'=>$form,
				'person'=>'husband',
                'model'=>$husband,
            ),
        ),
        'tab3'=>array(
            'title'=>'Wife',
            'view'=>'../person/_person_form',
            'data'=>array(
				'form'=>$form,
				'person'=>'wife',
                'model'=>$wife,
            ),
        ),
        'tab4'=>array(
            'title'=>'Dependent',
            'view'=>'../person/_person_form',
            'data'=>array(
				'form'=>$form,
				'person'=>'dependent',
                'model'=>$dependent
			),
		),
	);
	for($i = 0; $i < 3; ++$i) {
		$n = 5 + $i;
		$j = 1 + $i;
		$child = isset($children[$i]) ? $children[$i] : new People();
		$tabs["tab$n"] = array(
			'title' => "Child $j",
			'view'	=> '../person/_person_form',
			'data'	=> array(
				'form'		=> $form,
				'person'	=> "child][$i",
				'model'		=> $child
			)
		);
	}
?>
    <?php $this->widget('CTabView',array(
    'tabs'=>$tabs
	)); ?>
<?#php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$('#Families_marriage_date').change(function(e) {
	$('#People_husband_marriage_dt').val(this.value);
	$('#People_wife_marriage_dt').val(this.value);
} );
</script>
