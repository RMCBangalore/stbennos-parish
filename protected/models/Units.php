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
 * This is the model class for table "units".
 *
 * The followings are the available columns in table 'units':
 * @property integer $id
 * @property string $addr_nm
 * @property string $addr_stt
 * @property string $addr_area
 * @property string $addr_pin
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property integer $zone
 * @property integer $bpl_card
 * @property string $monthly_income
 * @property string $photo
 * @property string $gmap_url
 * @property string $reg_date
 * @property integer $disabled
 * @property string $leaving_date
 *
 * The followings are the available model relations:
 * @property Families[] $families
 */
class Units extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Units the static model class
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
		return 'units';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('addr_stt, addr_area, addr_pin', 'required'),
			array('zone, bpl_card, disabled', 'numerical', 'integerOnly'=>true),
			array('addr_nm, addr_area, email, photo', 'length', 'max'=>50),
			array('addr_stt', 'length', 'max'=>75),
			array('addr_pin', 'length', 'max'=>7),
			array('phone, mobile', 'length', 'max'=>10),
			array('monthly_income', 'length', 'max'=>15),
			array('gmap_url', 'length', 'max'=>1024),
			array('reg_date, leaving_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, addr_nm, addr_stt, addr_area, addr_pin, phone, mobile, email, zone, bpl_card, monthly_income, photo, gmap_url, reg_date, disabled, leaving_date', 'safe', 'on'=>'search'),
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
			'families' => array(self::HAS_MANY, 'Families', 'unit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'addr_nm' => 'House No./Name',
			'addr_stt' => 'Street Address',
			'addr_area' => 'Area',
			'addr_pin' => 'Pin Code',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'zone' => 'Zone',
			'gmap_url' => 'Google maps URL',
			'reg_date' => 'Registration Date',
			'bpl_card' => 'Bpl Card',
			'monthly_income' => 'Monthly Income',
			'photo' => 'Photo',
			'disabled' => 'Disabled',
			'leaving_date' => 'Leaving Date',
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
		$criteria->compare('addr_nm',$this->addr_nm,true);
		$criteria->compare('addr_stt',$this->addr_stt,true);
		$criteria->compare('addr_area',$this->addr_area,true);
		$criteria->compare('addr_pin',$this->addr_pin,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('zone',$this->zone);
		$criteria->compare('bpl_card',$this->bpl_card);
		$criteria->compare('monthly_income',$this->monthly_income,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('gmap_url',$this->gmap_url,true);
		$criteria->compare('reg_date',$this->reg_date,true);
		if ($this->disabled) {
			$criteria->compare('disabled',$this->disabled);
		} else {
			$criteria->addCondition('disabled = 0');
		}
		$criteria->compare('leaving_date',$this->leaving_date,true);

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
}
