<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		if (!isset($this->breadcrumbs['Admin']) and isset($this->breadcrumbs[0]) and $this->breadcrumbs[0] != 'Admin') {
			$iconmenu = Yii::app()->params['iconMenu'];
			echo '<table>';
			$i = 0;
			foreach($iconmenu as $icon) {
				$iconUrl = $icon['url'];
				if (isset($iconUrl[1])) {
					$url = Yii::app()->createUrl($iconUrl[0], $iconUrl[1]);
				} else {
					$url = Yii::app()->createUrl($iconUrl[0]);
				}
				if (Yii::app()->request->getUrl() == $url) {
					continue;
				}

				if (0 == $i % 2) {
					echo '<tr>';
				}

				echo '<td><a href="' . $url . '">';
				$imgPath = preg_replace('/\./', '-70x.', $icon['icon']);
				echo CHtml::image(Yii::app()->baseUrl . $imgPath, $icon['title']);
				echo '</a></td>';

				if (0 == ++$i % 2) {
					echo '</tr>';
				}
			}
			echo '</table>';
		}
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
