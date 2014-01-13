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

class ProfileController extends RController
{
	public $layout='//layouts/column2';

	public function actionIndex()
	{
		$model=User::model()->findByPk(Yii::app()->user->id);
		$this->render('index', array('model' => $model));
	}

	public function actionChangePassword()
	{
	    $model = new ChangePasswordForm;
	    if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
	    {
	      echo CActiveForm::validate($model);
	      Yii::app()->end();
	    }

	    // collect user input data
	    if(isset($_POST['ChangePasswordForm']))
	    {
	      $model->attributes=$_POST['ChangePasswordForm'];
	      // Validate input of the user
	      if($model->validate() && $model->changePassword())
	      {
	       Yii::app()->user->setFlash('success', '<strong>Success!</strong> Password changed successfully.');
	       $this->redirect(array('index'));
	      }
	    }
	    $this->render('changePassword',array('model'=>$model));
	}
}

