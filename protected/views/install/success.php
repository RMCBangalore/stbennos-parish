<?php
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
You have successfully installed St. Bennos Parish Software!!<br />
You may now delete the file <?php echo $inst_path ?>.
Kindly click the following link to login: <a href="<?php echo Yii::app()->createUrl('/site/login') ?>">Login</a>
</p>

</div><!-- form -->
