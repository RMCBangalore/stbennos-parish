<?php

class SiteController extends RController
{
	public $layout = '//layouts/column2';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
/*		$fams = Families::model()->findAll();
		$ppl = People::model()->findAll();
		$baptised = People::model()->getBaptised();
		$confirmed = People::model()->getConfirmed();
		$married = People::model()->getMarried();*/
		if (!Yii::app()->params['installed'])
			$this->redirect('/install');

		$this->layout = '//layouts/main';
		$this->render('index', array(
/*			'families'	=> count($fams),
			'members'	=> count($ppl),
			'baptised'	=> count($baptised),
			'confirmed'	=> count($confirmed),
			'married'	=> count($married),*/
		));
	}

	public function actionSearch()
	{
		$this->forward('/family/search', false);
		$this->forward('/person/search', false);
		$this->forward('/baptismRecords/search', false);
		$this->forward('/confirmationRecords/search', false);
		$this->forward('/firstCommunionRecords/search', false);
		$this->forward('/marriageRecords/search', false);
		$this->forward('/deathRecords/search', false);
		$this->forward('/bannsRecords/search', false);
		$this->forward('/massBooking/search', false);
	}

	public function actionParishProfile()
	{
		$fams = Families::model()->findAll();
		$ppl = People::model()->findAll();
		$baptised = People::model()->getBaptised();
		$confirmed = People::model()->getConfirmed();
		$married = People::model()->getMarried();
		$this->render('pprofile', array(
			'families'	=> count($fams),
			'members'	=> count($ppl),
			'baptised'	=> count($baptised),
			'confirmed'	=> count($confirmed),
			'married'	=> count($married),
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!Yii::app()->params['installed'])
			$this->redirect('/install');

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionConfig()
	{
		$cont = preg_replace('?/.*$?', '', Yii::app()->getRequest()->getPathInfo());
		$path = preg_replace('/controllers/', 'config/params.php', dirname(__FILE__));
		Yii::trace("SC.actionConfig called with path $path", 'application.controllers.InstallController');
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
				'installed'		=> true,
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

			$this->render("/$cont/success");
			return;
		}

		$this->render("/$cont/config");
	}
}
