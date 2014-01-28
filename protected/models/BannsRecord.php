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

/**
 * This is the model class for table "banns".
 *
 * The followings are the available columns in table 'banns':
 * @property integer $id
 * @property string $groom_name
 * @property string $groom_parent
 * @property string $groom_parish
 * @property string $bride_name
 * @property string $bride_parent
 * @property string $bride_parish
 * @property string $banns_dt1
 * @property string $banns_dt2
 * @property string $banns_dt3
 */
class BannsRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BannsRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banns';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('groom_name, bride_name', 'required'),
			array('groom_name, groom_parent, bride_name, bride_parent', 'length', 'max'=>100),
			array('groom_parish, bride_parish', 'length', 'max'=>50),
			array('banns_dt1, banns_dt2, banns_dt3', 'safe'),
			array('groom_parish, bride_parish, banns_dt1, banns_dt2, banns_dt3', 'default', 'setOnEmpty' => true, 'value' => null),
			array('banns_dt1, banns_dt2, banns_dt3', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => Yii::app()->locale->getDateFormat('short')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, groom_name, groom_parent, groom_parish, bride_name, bride_parent, bride_parish, banns_dt1, banns_dt2, banns_dt3', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requests' => array(self::HAS_MANY, 'BannsRequest', 'banns_id'),
			'responses' => array(self::HAS_MANY, 'BannsResponse', 'banns_id'),
			'noImpedimentLetters' => array(self::HAS_MANY, 'NoImpedimentLetter', 'banns_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'groom_name' => 'Groom Name',
			'groom_parent' => 'Groom Parent',
			'groom_parish' => 'Groom Parish',
			'bride_name' => 'Bride Name',
			'bride_parent' => 'Bride Parent',
			'bride_parish' => 'Bride Parish',
			'banns_dt1' => 'Banns Date 1',
			'banns_dt2' => 'Banns Date 2',
			'banns_dt3' => 'Banns Date 3',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('groom_name',$this->groom_name,true);
		$criteria->compare('groom_parent',$this->groom_parent,true);
		$criteria->compare('groom_parish',$this->groom_parish,true);
		$criteria->compare('bride_name',$this->bride_name,true);
		$criteria->compare('bride_parent',$this->bride_parent,true);
		$criteria->compare('bride_parish',$this->bride_parish,true);
		if (isset($this->banns_dt1) and $this->banns_dt1) {
			$criteria->compare('banns_dt1', date('Y-m-d',
				CDateTimeParser::parse($this->banns_dt1,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		if (isset($this->banns_dt2) and $this->banns_dt2) {
			$criteria->compare('banns_dt2', date('Y-m-d',
				CDateTimeParser::parse($this->banns_dt2,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		if (isset($this->banns_dt3) and $this->banns_dt3) {
			$criteria->compare('banns_dt3', date('Y-m-d',
				CDateTimeParser::parse($this->banns_dt3,
				Yii::app()->locale->getDateFormat('short'))),true);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
	    if(parent::beforeSave())
	    {
		// Format dates based on the locale
		foreach($this->metadata->tableSchema->columns as $columnName => $column)
		{
		    if ($column->dbType == 'date' and isset($this->$columnName))
		    {
			$this->$columnName = date('Y-m-d',
			    CDateTimeParser::parse($this->$columnName,
			    Yii::app()->locale->getDateFormat('short')));
		    }
		}
		return true;
	    }
	    else
		return false;
	}

	protected function afterFind()
	{
	    // Format dates based on the locale
	    foreach($this->metadata->tableSchema->columns as $columnName => $column)
	    {           
		if (!strlen($this->$columnName)) continue;
	 
		if ($column->dbType == 'date')
		{ 
		    $this->$columnName = Yii::app()->dateFormatter->formatDateTime(
			    CDateTimeParser::parse(
				$this->$columnName, 
				'yyyy-MM-dd'
			    ),
			    'short',null
			);
		}
	    }
	    return parent::afterFind();
	}

	public function groom() {
		$gp = $this->groom_parish;
		if (ctype_digit($gp)) {
			return People::model()->findByPk($gp);
		} else {
			return null;
		}
	}

	public function bride() {
		$bp = $this->bride_parish;
		if (ctype_digit($bp)) {
			return People::model()->findByPk($bp);
		} else {
			return null;
		}
	}

	public static function get_parish($parish) {
		if (ctype_digit($parish)) {
			return Parish::get()->name;
		} else {
			return $parish;
		}
	}
}
