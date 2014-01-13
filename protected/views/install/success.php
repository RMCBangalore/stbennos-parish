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
/* @var $this InstallController */

$this->breadcrumbs=array(
	'Install',
);

$dir = dirname(__FILE__);
$inst_path = preg_replace('?views/install?', 'controllers/InstallController.php', $dir);

# we will manually delete this install controller file. later plan to do this on first login

?>
<h1>Congrats! Installation Complete!!</h1>

<p>
You have successfully installed Alive Parish Software!!<br />
You may now delete the file <?php echo $inst_path ?>.
Kindly click the following link to login: <a href="<?php echo Yii::app()->createUrl('/site/login') ?>">Login</a>
</p>

</div><!-- form -->
