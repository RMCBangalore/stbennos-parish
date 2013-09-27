<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */
/* @var $form CActiveForm */

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
	'config'=>array(),
));

Yii::app()->clientScript->registerScript('findMatches', "
function set_find() {
	$('#findMatchForm').submit(function() {
		$.get('" . Yii::app()->request->baseUrl . "/family/findMatch', {
			'key': $('#key').val()
		}, function(data) {
			$('#fancybox-content').html(data);
			set_find();
			set_sort();
			set_select();
		} );
		return false;
	} );
	$('#key').focus();
}
function set_sort() {
	$('a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#fancybox-content').html(data);
			set_find();
			set_sort();
			set_select();
		} );
		return false;
	} );
}
function update_family(f) {
	$('#Subscription_family_head').val(f.head_name);
	$('#Subscription_family_id').val(f.id);
	$.get('" . Yii::app()->createUrl('/subscription/tillDate') . "?family=' + f.id, function(data) {
		$('#spn_till_month').html(data);
		$('#Subscription_till').attr('disabled', false);
	} );
	$.fancybox.close();
}
function set_select() {
	$('#submitMatch').click(function() {
		$.fancybox.close();
		$.post('" . Yii::app()->request->baseUrl . "/family/findMatch". "', {
			'family': $('input:checked').val()
		}, update_family, 'json' );
	} );
}
$('#family-search').fancybox( {
	'onComplete': function() {
		set_find();
		set_sort();
		set_select();
	}
} );
function set_clear_fields(id) {
	$('#family-clear').click(function() {
		$('#Subscription_family_head').val('');
		$('#Subscription_family_id').val('');
		$('#Subscription_till').attr('disabled', false);
		return false;
	} );
}
");

$gridScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));
Yii::app()->clientScript->registerCssFile($gridScriptUrl.'/gridview/styles.css');  

$pagerScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('system.web.widgets.pagers'));
Yii::app()->clientScript->registerCssFile($pagerScriptUrl.'/pager.css');  

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscription-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php
		if (isset($family)) {
			$fid = $family->id;
			$head_name = $family->head_name;
		} else {
			$fid = $head_name = '';
		}
		echo CHtml::label('Family of', 'Subscription_family_head', array('required'=>true,'style'=>'display:inline'));
		echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png','family search',array('height'=>14,'width'=>'14')),
			array('/family/findMatch'), array('id' => 'family-search'));
		echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/clear.png','family clear',array('height'=>14,'width'=>14)),
			array('#'), array('id' => 'family-clear', 'title' => 'Clear family fields')) . '<br />';
		echo CHtml::textField('head_name', $head_name, array(
			'id'=>'Subscription_family_head', 'size'=>60, 'maxlength'=>99, 'readonly'=>true));
		echo $form->hiddenField($model,'family_id',array('value'=>$fid)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paid_by'); ?>
		<?php echo $form->textField($model,'paid_by',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'paid_by'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('Till Month', 'Subscription_till', array('required'=>true)); ?>
		<?php $parms = array();
			if (isset($start_dt)) {
				$parms['start_dt'];
			}
			echo '<span id="spn_till_month">';
			$this->renderPartial('_till_month', $parms);
			echo '</span>'; ?>
	</span>

	<span class="rightHalf">
		<?php echo CHtml::label('Amount per month', 'Subscription_amount', array('required' => true)); ?>
		<?php echo CHtml::textField('Subscription[amount]','',array('id'=>'Subscription_amount')); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
