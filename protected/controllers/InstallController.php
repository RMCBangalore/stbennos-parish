<?php

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

			$this->redirect(array('config'));
		}

		$this->render('index', array(
			'dbname' => $dbname
		));
	}

	public function actionConfig()
	{
		$path = preg_replace('/controllers/', 'config/params.php', dirname(__FILE__));
		Yii::trace("IC.actionConfig called with path $path", 'application.controllers.InstallController');
		if (!is_writable($path)) {
			Yii::app()->user->setFlash("error", "WARNING: the file $path needs to be writable before submitting this form." .
				"Please change the permissions of the file or, if it does not exist, of the parent config directory");
		} elseif (isset($_POST['parish_name'])) {
			$parishName = $_POST['parish_name'];
			$_parishAddr = $_POST['parish_addr'];
			$parishAddr = explode("\n", $_parishAddr);
			$parishCity = $_POST['parish_city'];
			$parishPIN = $_POST['parish_pin'];
			$massBookAmt = $_POST['mass_book_amt'];

			$params = array(
				'parishName'	=> $parishName,
				'parishAddr'	=> $parishAddr,
				'parishCity'	=> $parishCity,
				'parishPIN'		=> $parishPIN,
				'massBookAmt'	=> $massBookAmt,
			);

			try {
			if (isset($_FILES['parish'])) {
				$files = $_FILES['parish'];
				$filename = $files['name']['logo'];

				Yii::trace("IC.actionConfig called with logo $filename", 'application.controllers.InstallController');
				if (isset($filename) and !empty($filename)) {
					$tmp_path = $files['tmp_name']['logo'];
					Yii::trace("IC.actionConfig logo temp path $tmp_path", 'application.controllers.InstallController');

					if (isset($tmp_path) and !empty($tmp_path)) {
						$dir = "images/";
						$fname = preg_replace('/\.[a-z]+$/i', '', $filename);
						preg_match('/(\.[a-z]+)$/i', $filename, $matches);
						$fext = $matches[0];
						if (file_exists($dir . $filename)) {
							$fname .= "_01";
							while (file_exists($dir. $fname . $fext)) {
								++$fname;
							}
						}
						$dest = $dir . $fname . $fext;
						$parishLogo = array();
						$parishLogo['src'] = "/$dest";
						list($width, $height) = getimagesize($tmp_path);
						Yii::trace("IC.actionConfig logo dimensions $width x $height", 'application.controllers.InstallController');
						$parishLogo['width'] = $width;
						$parishLogo['height'] = $height;
						if (is_writable($dir)) {
							move_uploaded_file($tmp_path, $dest);
							$params['parishLogo'] = $parishLogo;
						} else {
							$path = preg_replace('?protected/controllers?', $dest, dirname(__FILE__));
							throw new Exception("Path $path not writable. Please ensure write permissions");
						}
					} else {
						$errors = array(
							1 => "Size exceeds max_upload",
							2 => "FORM_SIZE",
							3 => "No tmp dir",
							4 => "can't write",
							5 => "error extension",
							6 => "error partial",
						);
						throw new Exception($errors[$files['error']['logo']]);
					}
				}
			}

			$conf = "<?php\n\nreturn " . var_export($params, true) . ";\n";
			file_put_contents($path, $conf);

			}

			catch (Exception $e) {
				 Yii::app()->user->setFlash('error', $e->getMessage());
			}

			$this->redirect(array('admin'));
		}

		$this->render('config');
	}

	public function actionAdmin()
	{
		$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
		if (isset($_POST['adm'])) {
			$admin = new User;
			$admin->attributes = $_POST['adm'];
			$admin->password = crypt($_POST['adm']['password'], CryptoHelper::blowfishSalt());
			$admin->superuser = 1;
			$admin->save();
			$authorizer->authManager->assign('Admin', $admin->id);
			if (isset($_POST['pastor'])) {
				$pastor = new User;
				$pastor->attributes = $_POST['pastor'];
				$pastor->password = crypt($_POST['pastor']['password'], CryptoHelper::blowfishSalt());
				$pastor->superuser = 0;
				$pastor->save();
				$authorizer->authManager->assign('Pastor', $pastor->id);
			}
			if (isset($_POST['staff'])) {
				$staff = new User;
				$staff->attributes = $_POST['staff'];
				$staff->password = crypt($_POST['staff']['password'], CryptoHelper::blowfishSalt());
				$staff->superuser = 0;
				$staff->save();
				$authorizer->authManager->assign('Staff', $staff->id);
			}
#			$this->redirect(array('success'));
			$this->render('success');
			return;
		}
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
