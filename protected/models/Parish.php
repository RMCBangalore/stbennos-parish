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
 * This is the model class for table "parish".
 *
 * The followings are the available columns in table 'parish':
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $pin
 * @property integer $est_year
 * @property double $mass_book_basic
 * @property double $mass_book_sun
 * @property integer $isset
 * @property string $logo_src
 * @property integer $logo_width
 * @property integer $logo_height
 * @property string $phone
 * @property string $website
 * @property integer $cert_header
 */
class Parish extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Parish the static model class
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
		return 'parish';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, city, pin, est_year, mass_book_basic, mass_book_sun', 'required'),
			array('est_year, isset, logo_width, logo_height, cert_header', 'numerical', 'integerOnly'=>true),
			array('mass_book_basic, mass_book_sun', 'numerical'),
			array('name, logo_src', 'length', 'max'=>50),
			array('city', 'length', 'max'=>25),
			array('pin', 'length', 'max'=>10),
			array('phone', 'length', 'max'=>12),
			array('website', 'length', 'max'=>20),
			array('currency', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, address, city, pin, est_year, mass_book_basic, mass_book_sun, isset, logo_src, logo_width, logo_height, phone, website', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'address' => 'Address',
			'city' => 'City',
			'pin' => 'Pin',
			'est_year' => 'Established Year',
			'mass_book_basic' => 'Mass Booking Amount (Weekdays)',
			'mass_book_sun' => 'Mass Booking (Sundays / Feast days)',
			'isset' => 'Isset',
			'logo_src' => 'Logo Src',
			'logo_width' => 'Logo Width',
			'logo_height' => 'Logo Height',
			'phone' => 'Phone',
			'website' => 'Website',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('pin',$this->pin,true);
		$criteria->compare('est_year',$this->est_year);
		$criteria->compare('mass_book_basic',$this->mass_book_basic);
		$criteria->compare('mass_book_sun',$this->mass_book_sun);
		$criteria->compare('isset',$this->isset);
		$criteria->compare('logo_src',$this->logo_src,true);
		$criteria->compare('logo_width',$this->logo_width);
		$criteria->compare('logo_height',$this->logo_height);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('website',$this->website,true);

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
		    if ($column->dbType == 'date')
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

	public static function get() {
		return Parish::model()->find();
	}

	public static function get_name() {
		$parish = Parish::get();
		if (isset($parish)) {
			return $parish->name;
		} else {
			return Yii::app()->name;
		}
	}
}
