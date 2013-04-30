<?php
/* @var $this FamilyController */
/* @var $model Families */

$this->breadcrumbs=array(
	'Families'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>Create Family</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php
	$husband = new People();
	$husband->sex = 1;
	$wife = new People();
	$wife->sex = 2;
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
            'title'=>'Dependent 1',
            'view'=>'../person/_person_form',
            'data'=>array(
				'form'=>$form,
				'person'=>'dependent][0',
                'model'=>$dependent
			),
		),
        'tab5'=>array(
            'title'=>'Dependent 2',
            'view'=>'../person/_person_form',
            'data'=>array(
				'form'=>$form,
				'person'=>'dependent][1',
                'model'=>$dependent
			),
		),
	);
	for($i = 0; $i < 3; ++$i) {
		$n = 6 + $i;
		$j = 1 + $i;
		$tabs["tab$n"] = array(
			'title' => "Child $j",
			'view'	=> '../person/_person_form',
			'data'	=> array(
				'form'		=> $form,
				'person'	=> "child][$i",
				'model'		=> new People()
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
