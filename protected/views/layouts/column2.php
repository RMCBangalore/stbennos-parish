<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

$this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$contr = ucfirst($this->uniqueid);
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		foreach($this->menu as $i => $mitem) {
			if (preg_match('?^/?', $mitem['url'][0])) {
				$action = preg_replace('?^/?', '', $mitem['url'][0]);
				$action = ucfirst(preg_replace('?/?', '.', $action));
			} else {
				$action = "$contr." . ucfirst($mitem['url'][0]);
			}
			if (!Yii::app()->user->checkAccess($action)) {
				unset($this->menu[$i]);
			}
		}
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
		if (!Yii::app()->user->isGuest and 'array' == gettype($this->breadcrumbs)
				and !isset($this->breadcrumbs['Admin']) and isset($this->breadcrumbs[0])
				and $this->breadcrumbs[0] != 'Admin') {
			$iconmenu = Yii::app()->params['iconMenu'];
			echo '<table>';
			$i = 0;
			foreach($iconmenu as $icon) {
				if (isset($icon['role'])) {
					$role = $icon['role'];
					if (preg_match('/^!/', $role)) {
						$role = preg_replace('/^!/', '', $role);
						if (Yii::app()->user->checkAccess($role)) {
							continue;
						}
					} elseif (!Yii::app()->user->checkAccess($role)) {
						continue;
					}
				}
				$iconUrl = $icon['url'];
				if (preg_match('?^/?', $iconUrl[0])) {
					$action = preg_replace('?^/?', '', $iconUrl[0]);
				}
				$action = ucwords(preg_replace('?/?', '.', $action));
				if (!preg_match('/^Site\./', $action) and !Yii::app()->user->checkAccess($action)) {
					continue;
				}
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
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
