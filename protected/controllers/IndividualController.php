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

class IndividualController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights',
/*			'rights', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
*/		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
/*			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','children', 'survey'),
				'users'=>array('@'),
			),
*/			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$uri = Yii::app()->request->baseUrl . '/css/family-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
		$uri = Yii::app()->request->baseUrl . '/css/person-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionLocate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['Individuals'])) {
			$gmurl = $_POST['Individuals']['gmap_url'];
			$gmurl = preg_replace('/&/', '&amp;', $gmurl);
			$gmurl .= "&amp;output=embed";
			$model->gmap_url = $gmurl;
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('locate',array(
			'model'=>$model,
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id = null, $step = 0)
	{
		Yii::trace("IC.actionCreate called", 'application.controllers.IndividualController');
		if (!isset($id) and $_POST and isset($_POST['Individuals']) and isset($_POST['Individuals']['id'])) {
			$id = $_POST['Individuals']['id'];
		}
		$model = isset($id) ? $this->loadModel($id) : new Individuals;
		$cur_model = $model;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		switch ($step) {
		case 1:
			$this->performAjaxValidation($model);
			if (isset($_POST['Individuals'])) {
				if (isset($_POST['Units'])) {
					$unit = new Units;
					$unit->attributes = $_POST['Units'];
					if ($unit->save()) {
						$model->attributes=$_POST['Individuals'];
						$model->id = $unit->id;
						if ($model->save()) {
							++$step;
						}
					}
				}
			}
			break;
		case 2: 
			$p = new People();
			$cur_model = $p;
			$this->performAjaxValidation($p);
			$person = 'member';
			if(isset($_POST['People'][$person])) {
				$p->attributes = $_POST['People'][$person];
				$p->unit_id = $model->id;
				$p->role = $person;
				if ($p->save()) {
					++$step;
					$model->saveAttributes(array(
						'member_id' => $p->id
					));
				}
			}
			break;
		default:
			++$step;
		}

		if ($step > 2 and isset($model->id)) {
			$this->redirect(array('view','id'=>$model->id));
		}

		Yii::trace("IC.actionCreate rendering", 'application.controllers.IndividualController');
		$ppl_ac = People::getAutoCompleteFields();
		$this->render('create',array(
			'model'=>$model,
			'ppl_ac'=>$ppl_ac,
			'step'=>$step,
			'cur_model'=>$cur_model,
		));
		Yii::trace("IC.actionCreate exiting", 'application.controllers.IndividualController');
	}

	public function actionDisable($id) {
		$model=$this->loadModel($id);
		if (Yii::app()->request->isPostRequest) {
			foreach($_POST as $key => $value) {
				Yii::trace("POST data: $key: $value", 'application.controllers.IndividualController');
			}
			if (isset($_POST['leaving_date'])) {
				Yii::trace("POST Individuals received", 'application.controllers.IndividualController');
				$unit = $model->unit;
				$unit->disabled = 1;
				$unit->leaving_date = $_POST['leaving_date'];
				if ($unit->save(false)) {
					if(!isset($_GET['ajax']))
						$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				}
			}
			return;
		}
		Yii::trace("FC.actionDisable GET", 'application.controllers.IndividualController');
		$now = date_format(new DateTime(), 'Y-m-d');
		$this->renderPartial('leaving_date', array(
			'model'=>$model,
			'now'=>$now,
		));
	}

	public function actionEnable($id) {
		$model=$this->loadModel($id);
		$unit = $model->unit;
		$unit->disabled = 0;
		$unit->leaving_date = null;
		if ($unit->save(false)) {
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Individuals']))
		{
			$model->attributes=$_POST['Individuals'];
			$unit = $model->unit;
			$unit->attributes = $_POST['Units'];
			$models = array($model);
			$person = 'member';
			if(isset($_POST['People'][$person])) {
				$p = new People();
#						$pid = $_POST['People'][$person]['id'];
				if ($pid = $_POST['People'][$person]['id']) {
					$p = People::model()->findByPk($pid);
				}
				$p->attributes = $_POST['People'][$person];
				$p->role = $person;
				$member = $p;
				array_push($models, $p);
			}

			$this->performAjaxValidation($models);

			if ($model->save()) {
				$unit->save();
				$member->unit_id = $model->id;
				$member->save();
				if (!isset($model->member_id)) {
					$model->saveAttributs(array('member_id' => $member->id));
				}
				$model=$this->loadModel($id);
			}
		}

		$ppl_ac = People::getAutoCompleteFields();

		$this->render('update',array(
			'model'	=>$model,
			'ppl_ac'=>$ppl_ac,
		));
	}

	public function actionPhoto($id) {
		$model = $this->loadModel($id);
		$model->scenario = 'photo';
		Yii::trace("FC.actionPhoto called", 'application.controllers.IndividualController');

		if (Yii::app()->params['photoManip']) {
			if (isset($_POST['x1'])) {
				$x1 = $_POST['x1'];
				$y1 = $_POST['y1'];
				$width = $_POST['width'];
				$height = $_POST['height'];
				$pfile = $_POST['pfile'];
				$sdir = './images/uploaded/';
				$size = getimagesize($sdir . $pfile);
				if ($size) {
					list($w, $h, $t) = $size;
				} else {
					Yii::trace("FR.actionPhoto crop call to getimagesize failed for image " . $sdir . $pfile . " returned $size", 'application.controllers.IndividualController');
				}
				Yii::trace("FC.actionPhoto crop received $x1, $y1, $width, $height, $w, $h, $t", 'application.controllers.IndividualController');
				switch ($t) {
				case 1: $img = imagecreatefromgif($sdir . $pfile); break;
				case 2: $img = imagecreatefromjpeg($sdir . $pfile); break;
				case 3: $img = imagecreatefrompng($sdir . $pfile); break;
				case IMAGETYPE_BMP: $img = ImageHelper::ImageCreateFromBMP($sdir . $pfile); break;
				case IMAGETYPE_WBMP: $img = imagecreatefromwbmp($sdir . $pfile); break;
				default: Yii::trace("FC.actionPhoto crop unknown image type $t", 'application.controllers.IndividualController');
				}
				if (function_exists('imagecrop')) { # untested
					$cropped = imagecrop($img, array('x1' => $x1, 'y1' => $y1, 'width' => $width, 'height' => $height));
					$scaled = imagescale($cropped, 400);
				} else {
					$h = $height * 400 / $width;
					$scaled = imagecreatetruecolor(400, $h);
					imagecopyresized($scaled, $img, 0, 0, $x1, $y1, 400, $h, $width, $height);
				}
				$dir = './images/families/';
				$fname = preg_replace('/\.[a-z]+$/i', '', $pfile);
				$fext = ".jpg";
				if (file_exists($dir . $pfile)) {
					$fname .= "_01";
					while (file_exists($dir. $fname . $fext)) {
						++$fname;
					}
				}
				$dest = $dir . $fname . $fext;
				imagejpeg($scaled, $dest, 90);
				imagedestroy($scaled);
				imagedestroy($img);
				unlink($sdir . $pfile); 
				$model->photo = $fname . $fext;
				$model->save(false);
				Yii::trace("FC.actionPhoto saved to $pfile", 'application.controllers.IndividualController');
				$this->redirect(array('view', 'id' => $model->id));
				return;
			} elseif (isset($_FILES['Individuals'])) {
				Yii::trace("FC.actionPhoto _FILES[Individuals] set", 'application.controllers.IndividualController');
				$files = $_FILES['Individuals'];
				$filename = $files['name']['raw_photo'];
				if (isset($filename) and '' != $filename) {
					Yii::trace("FC.actionPhoto filename $filename", 'application.controllers.IndividualController');
					$tmp_path = $files['tmp_name']['raw_photo'];
					if (isset($tmp_path) and '' != $tmp_path) {
						Yii::trace("FC.actionPhoto tmp_path $tmp_path", 'application.controllers.IndividualController');
						$dir = "./images/uploaded/";
						$dest = $dir . $filename;
						list($width, $height) = getimagesize($tmp_path);
						if ($width < 900) {
							$w = $width;
							$h = $height;
							$zoom = 1;
						} else {
							$w = 900;
							$h = $height * 900 / $width;
							$zoom = $w / $width;
						}
						$w = ($width < 900) ? $width : 900;
						
						move_uploaded_file($tmp_path, $dest);
						$this->render('crop', array('model'=>$model,'pfile'=>$filename, 'width' => $w, 'height' => $h, 'zoom' => $zoom));
						return;
					} else {
						$errors = array(
							1 => "Size exceeds max_upload",
							2 => "FORM_SIZE",
							3 => "No tmp dir",
							4 => "can't write",
							5 => "error extension",
							6 => "error partial",
						);
						$error = $errors[$files['error']['raw_photo']];
						Yii::trace("FC.actionPhoto file error $error", 'application.controllers.IndividualController');
					}
				}
			}
		} elseif (isset($_FILES['Individuals'])) {
			$files = $_FILES['Individuals'];
			$filename = $files['name']['photo'];
			if (isset($filename) and '' != $filename) {
				$tmp_path = $files['tmp_name']['photo'];
				if (isset($tmp_path) and '' != $tmp_path) {
					$dir = "./images/families/";
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
					$model->photo = $fname . $fext;
					if ($model->save()) {
						move_uploaded_file($tmp_path, $dest);
						$this->redirect(array('view', 'id' => $model->id));
						return;
					}
				} else {
					$model->addError('photo', $files['error']['photo']);
				}
			}
		}

		$this->render('photo', array(
			'model' => $model,
		));
	}

	public function actionChildren($id) {
		$model = $this->loadModel($id);
		
		if (isset($_POST['People']['child'])) {
			for($i = 0; $i < 10; ++$i) {
				if (isset($_POST['People']['child'][$i])) {
					if ($pid = $_POST['People']['child'][$i]['id']) {
						$p = People::model()->findByPk($pid);
					} else {
						$p = new People();
					}
					$p->attributes = $_POST['People']['child'][$i];
					$p->unit_id = $model->id;
					$p->role = 'child';
					$p->save();
				}
			}
		}

		$ppl_ac = People::getAutoCompleteFields();
		$this->render('children',array(
			'model'=>$model,
			'ppl_ac'=>$ppl_ac,
		));
	}

	public function actionDependents($id) {
		$model = $this->loadModel($id);
		
		if (isset($_POST['People']['dependent'])) {
			for($i = 0; $i < 10; ++$i) {
				if (isset($_POST['People']['dependent'][$i])) {
					if ($pid = $_POST['People']['dependent'][$i]['id']) {
						$p = People::model()->findByPk($pid);
					} else {
						$p = new People();
					}
					$p->attributes = $_POST['People']['dependent'][$i];
					$p->unit_id = $model->id;
					$p->role = 'dependent';
					$p->save();
				}
			}
		}

		$ppl_ac = People::getAutoCompleteFields();
		$this->render('dependents',array(
			'model'=>$model,
			'ppl_ac'=>$ppl_ac,
		));
	}

	public function actionSurvey($id) {
		$model = $this->loadModel($id);

		if (isset($_POST['SatisfactionData'])) {
			foreach($_POST['SatisfactionData'] as $sid => $value) {
				$sd = SatisfactionData::model()->findByAttributes(array(
					'unit_id' => $id,
					'satisfaction_item_id' => $sid
				));
				if (!$sd) {
					$sd = new SatisfactionData();
				}
				$sd->attributes = $value;
				$sd->unit_id = $id;
				$sd->satisfaction_item_id = $sid;
				$sd->save();
			}
		}

		if (isset($_POST['NeedData'])) {
			foreach($_POST['NeedData'] as $nid => $value) {
				$nd = NeedData::model()->findByAttributes(array(
					'unit_id' => $id,
					'need_id' => $nid
				));
				if (!$nd) {
					$nd = new NeedData();
				}
				$nd->attributes = $value;
				$nd->unit_id = $id;
				$nd->need_id = $nid;
				$nd->save();
			}
		}

		if (isset($_POST['AwarenessData'])) {
			Yii::trace("FC.survey awareness reached", 'application.controllers.IndividualController');
			$awarenessItems = AwarenessItem::model()->findAll();

			foreach($awarenessItems as $aRow) {
				$aid = $aRow->id;
				$value = isset($_POST['AwarenessData'][$aid])
					? $_POST['AwarenessData'][$aid] : 1;

				$ad = AwarenessData::model()->findByAttributes(array(
					'unit_id' => $id,
					'awareness_id' => $aid
				));

				if (!$ad) {
					$ad = new AwarenessData();
				}

				$ad->value = $value;
				$ad->unit_id = $id;
				$ad->awareness_id = $aid;
				$ad->save();
			}
		}

		if (isset($_POST['OpenData'])) {
			foreach($_POST['OpenData'] as $qid => $value) {
				$od = OpenData::model()->findByAttributes(array(
					'unit_id' => $id,
					'question_id' => $qid
				));
				if (!$od) {
					$od = new OpenData();
				}
				$od->attributes = $value;
				$od->unit_id = $id;
				$od->question_id = $qid;
				$od->save();
			}
		}

		$satisfactionItems = SatisfactionItem::model()->findAll();
		$needItems = NeedItem::model()->findAll();
		$openQuestions = OpenQuestion::model()->findAll(array('order' => 'seq'));
		$awarenessItems = AwarenessItem::model()->findAll();

		$this->render('survey', array(
			'model' => $model,
			'satisfactionItems' => $satisfactionItems,
			'satisfactionData' => Individuals::satisfactionData($id),
			'needItems' => $needItems,
			'needData' => Individuals::needData($id),
			'awarenessItems' => $awarenessItems,
			'awarenessData' => Individuals::awarenessData($id),
			'openQuestions' => $openQuestions,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->husband_id = null;
		$model->wife_id = null;
		$model->save();
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Individuals', array(
			'criteria' => array('condition' => 'u.disabled = 0', 'join' => 'INNER JOIN units u ON t.id = u.id'),
		));
		$uri = Yii::app()->request->baseUrl . '/css/family-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionSearch()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$model=$this->loadModel($id);
			if (preg_match('/^\d+$/', $id)) {
				$this->redirect(array('view','id'=>$model->id));
			}
		} elseif (isset($_GET['key'])) {
			$key = $_GET['key'];
			$crit = new CDbCriteria();
			if (preg_match('/^\d+$/', $key)) {
				$crit->mergeWith(array('condition' => "id = $key"), 'OR');
			}
			$crit->mergeWith(array('condition' => "fid = '$key'"), 'OR');

			$fams = new CActiveDataProvider('Individuals', array(
				'criteria' => $crit
			));

			if ($fams->itemCount > 0)
				$this->renderPartial('index', array(
					'dataProvider' => $fams
				));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Individuals('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Individuals']))
			$model->attributes=$_GET['Individuals'];

		if (isset($_GET['export'])) {
			header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
			header( "Content-Disposition: inline; filename=\"family-report.xls\"" );

			$dataProvider = $model->search();
			$dataProvider->pagination = false;

			$fields = array('id', 'fid', 'head', 'addr_nm', 'addr_stt', 'addr_area', 'addr_pin', 'zone', 'reg_date', 'marriage_church', 'marriage_date');

			$fval = array();
			$labels = $model->attributeLabels();
			foreach($fields as $field) {
				if ('head' == $field) {
					array_push($fval, 'Individual head');
				} else {
					array_push($fval, $labels[$field]);
				}
			}
			echo implode("\t", $fval) . "\n";

            foreach( $dataProvider->data as $data ) {
				$fval = array();
				foreach($fields as $field) {
					if ('head' == $field) {
						$head = $data->head();
						$head_name = '';
						if ($head) {
							$head_name = $head->fullname();
						}
						array_push($fval, $head_name);
					} else {
						array_push($fval, $data->$field);
					}
				}
				echo implode("\t", $fval) . "\n";
			}

			Yii::app()->end();
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionSubscriptions($id = null) {
		$parms = array();
		if (isset($id)) {
			$family = Individuals::model()->findByPk($id);
			$parms['family'] = $family;
			
			$parms['subscriptions'] = Subscription::model()->findAllByAttributes(array(
									'unit_id' => $family->id
								), array(
									'order' => 'end_year ASC, end_month ASC'	
								));
		} else {
			$parms['families'] = Individuals::model()->findAllByAttributes(array('disabled' => false));
		}

		$this->render('subscriptions', $parms);
	}

	public function actionVisits($id) {
		$dataProvider=new CActiveDataProvider('Visits', array(
			'criteria' => array('condition' => "unit_id = $id")
		));
		$this->render('visits',array(
			'dataProvider'=>$dataProvider,
			'fid'=>$id
		));
	}

	public function actionFindMatch()
	{
		if (Yii::app()->request->isPostRequest) {
			Yii::trace("PC.findMatch POST request", 'application.controllers.IndividualController');
			foreach($_POST as $k => $v) {
				Yii::trace("PC.findMach $k: $v", 'application.controllers.IndividualController');
			}
			$model = Individuals::model()->findByPk($_POST['family']);
			$family = array(
				'id' => $model->id,
				'head_name' => $model->head_name,
				'marriage_date' => $model->marriage_date,
			);
			echo CJSON::encode($family);
			return;
		}
		$crit = array(
			'condition' => ""
		);
		if (isset($_GET['key'])) {
			$key = $_GET['key'];
			$crit = array(
				'condition' => "t.id = '$key' or t.fid = '$key' or " .
						"h.fname like '%$key%' or h.lname like '%$key%' or " .
						"w.fname like '%$key%' or w.lname like '%$key%'",
				'join' => "LEFT OUTER JOIN people h ON t.husband_id IS NOT NULL " .
						"AND h.id = t.husband_id " .
					"LEFT OUTER JOIN people w ON t.wife_id IS NOT NULL " .
						"AND w.id = t.wife_id",
			);
		}
		$families = new CActiveDataProvider('Individuals', array('criteria' => $crit));

		$this->renderPartial('find_match', array(
			'families' => $families
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Individuals the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Individuals::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Individuals $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		Yii::trace("FC.performAjaxValidation called for " . gettype($model), 'application.controllers.IndividualController');
		if(isset($_POST['ajax']) && $_POST['ajax']==='families-form')
		{
			echo CActiveForm::validate($model);
			Yii::trace("FC.performAjaxValidation done for " . gettype($model), 'application.controllers.IndividualController');
			Yii::app()->end();
		}
	}
}
