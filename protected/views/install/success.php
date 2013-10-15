<?php
/* @var $this InstallController */

$this->breadcrumbs=array(
	'Install',
);

$dir = dirname(__FILE__);
$inst_path = preg_replace('?views/install?', 'controllers/InstallController.php', $dir);

if (is_writable($inst_path)) {
	unlink($inst_path);
}

?>
<h1>Congrats! Installation Complete!!</h1>

<p>
You have successfully installed St. Bennos Parish Software!!<br />
Kindly click the following link to login: <a href="<?php echo Yii::app()->createUrl('/site/login') ?>">Login</a>
</p>

</div><!-- form -->
