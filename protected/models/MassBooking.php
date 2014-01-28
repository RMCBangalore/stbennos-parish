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
 * This is the model class for table "mass_bookings".
 *
 * The followings are the available columns in table 'mass_bookings':
 * @property integer $id
 * @property integer $mass_id
 * @property string $booked_by
 * @property string $intention
 * @property integer $trans_id
 * @property string $mass_dt
 * @property string $type
 *
 * The followings are the available model relations:
 * @property MassSchedule $mass
 * @property Transactions $trans
 */
class MassBooking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MassBooking the static model class
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
		return 'mass_bookings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mass_dt, mass_id, intention', 'required'),
			array('mass_id, trans_id', 'numerical', 'integerOnly'=>true),
			array('booked_by, intention', 'length', 'max'=>99),
			array('type', 'length', 'max'=>20),
			array('mass_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, mass_id, booked_by, intention, trans_id, mass_dt, type', 'safe', 'on'=>'search'),
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
			'mass' => array(self::BELONGS_TO, 'MassSchedule', 'mass_id'),
			'trans' => array(self::BELONGS_TO, 'Transaction', 'trans_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mass_id' => 'Mass',
			'booked_by' => 'Booked By',
			'intention' => 'Intention',
			'trans_id' => 'Trans',
			'mass_dt' => 'Mass Dt',
			'type' => 'Type',
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
		$criteria->compare('mass_id',$this->mass_id);
		$criteria->compare('booked_by',$this->booked_by,true);
		$criteria->compare('intention',$this->intention,true);
		$criteria->compare('trans_id',$this->trans_id);
		if (isset($this->mass_dt) and $this->mass_dt) {
			$criteria->compare('mass_dt', date('Y-m-d',
				CDateTimeParser::parse($this->mass_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		$criteria->compare('type',$this->type,true);

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
}
