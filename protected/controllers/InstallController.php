<?php
#
# This file is part of St. Benno's Parish Software
#
# St. Benno's Parish Software - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# St. Benno's Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# St. Benno's Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

class InstallController extends CController
{
	public $breadcrumbs;
	public $layout = '//layouts/install';
	public $menu = array();

	public function restore_mysqldb($dbname, $dbuser, $dbpass, $filename)
	{
		if (!mysql_connect('localhost', $dbuser, $dbpass))
			throw new Exception('Error connecting to MySQL server: ' . mysql_error());
		if (!mysql_select_db($dbname))
			throw new Exception('Error selecting MySQL database: ' . mysql_error());

		$errors = array();

		# Temporary variable, used to store current query
		$templine = '';
		# Read in entire file
		$lines = file($filename);
		# Loop through each line
		foreach ($lines as $line)
		{
			# Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;
		 
			# Add this line to the current segment
			$templine .= $line;
			# If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{
				# Perform the query
				mysql_query($templine) or array_push($errors, 'Error performing query ' . $templine . ': ' . mysql_error());
				# Reset temp variable to empty
				$templine = '';
			}
		}

		if (count($errors) > 0) {
			throw new Exception(implode("\n", $errors));
		}
	}

	public function actionIndex()
	{
		if ('POST' == Yii::app()->request->requestType) {
			if (isset($_POST['accept'])) {
				$this->redirect(array('dbconf'));
			} else {
				$this->redirect('http://aliveparish.com');
			}
		}

		$this->render('index');
	}
	
	public function actionDbconf()
	{
		$path = preg_replace('/controllers/', 'config/dbconf.php', dirname(__FILE__));
		Yii::trace("IC.actionIndex called with path $path", 'application.controllers.InstallController');

		$dbname = Yii::app()->params['dbname'];
		if (!is_writable($path)) {
			Yii::app()->user->setFlash("error", "WARNING: the file $path needs to be writable before submitting this form." .
				"Please change the permissions of the file or, if it does not exist, of the parent config directory");
		} elseif (isset($_POST['dbname'])) {
			$driver = $_POST['driver'];
			$dbname = $_POST['dbname'];
			$dbuser = $_POST['dbuser'];
			$dbpass = $_POST['dbpass'];
			$db = array(
				'connectionString'	=> "$driver:host=localhost;dbname=$dbname",
				'emulatePrepare'	=> true,
				'username'			=> $dbuser,
				'password'			=> $dbpass,
				'charset'			=> 'utf8',
			);

			$dump_path = preg_replace('/controllers/', 'data/schema.mysql.sql', dirname(__FILE__));

			try {
				$adm_pass = Yii::app()->params['db_root_passwd'];
				if (!mysql_connect('localhost', 'root', $adm_pass)) 
					throw new Exception('Error connecting to MySQL server: ' . mysql_error());
				if (!mysql_query("CREATE DATABASE IF NOT EXISTS $dbname"))
					throw new Exception("Unable to create database $dbname: " . mysql_error());
				if (!mysql_query("GRANT ALL PRIVILEGES ON $dbname.* TO $dbuser@localhost IDENTIFIED BY '$dbpass'"))
					throw new Exception("Unable to grant privileges on $dbname to $dbuser: " . mysql_error());
				$this->restore_mysqldb($dbname, $dbuser, $dbpass, $dump_path);
			}

			catch(Exception $e) {
				Yii::app()->user->setFlash('error', "Error restoring MySQL database" . mysql_error());
			}

			$dbconf = "<?php\n\nreturn " . var_export($db, true) . ";\n";
			file_put_contents($path, $dbconf);

			$this->redirect(array('admin'));
		}

		$this->render('dbconf', array(
			'dbname' => $dbname
		));
	}

	public function actionConfig()
	{
		$this->forward('/site/config');
	}

	public function actionAdmin()
	{
		$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
		if (isset($_POST['adm'])) {
			if (empty($_POST['adm']['username'])) {
				Yii::app()->user->setFlash('error', "Admin user is mandatory to use the software");
				goto RENDR;
			}
			$admin = new User;
			$admin->attributes = $_POST['adm'];
			$admin->password = crypt($_POST['adm']['password'], CryptoHelper::blowfishSalt());
			$admin->superuser = 1;
			$admin->save();
			$authorizer->authManager->assign('Admin', $admin->id);
			if (isset($_POST['pastor']['username']) and !empty($_POST['pastor']['username'])) {
				$pastor = new User;
				$pastor->attributes = $_POST['pastor'];
				$pastor->password = crypt($_POST['pastor']['password'], CryptoHelper::blowfishSalt());
				$pastor->superuser = 0;
				$pastor->save();
				$authorizer->authManager->assign('Pastor', $pastor->id);
			}
			if (isset($_POST['staff']['username']) and !empty($_POST['staff']['username'])) {
				$staff = new User;
				$staff->attributes = $_POST['staff'];
				$staff->password = crypt($_POST['staff']['password'], CryptoHelper::blowfishSalt());
				$staff->superuser = 0;
				$staff->save();
				$authorizer->authManager->assign('Staff', $staff->id);
			}
			$this->redirect(array('config'));
		}
		RENDR:
		$this->render('admin');
	}

	// Uncomment the following methods and override them if needed
	
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(); # allow all actions to everyone
	}
}
