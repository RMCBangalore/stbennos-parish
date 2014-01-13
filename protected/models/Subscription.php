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
 * This is the model class for table "subscriptions".
 *
 * The followings are the available columns in table 'subscriptions':
 * @property integer $id
 * @property integer $family_id
 * @property string $paid_by
 * @property integer $trans_id
 * @property integer $start_year
 * @property integer $start_month
 * @property integer $end_year
 * @property integer $end_month
 * @property double $amount
 *
 * The followings are the available model relations:
 * @property Families $family
 * @property Transactions $trans
 */
class Subscription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subscription the static model class
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
		return 'subscriptions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('family_id, trans_id, amount', 'required'),
			array('family_id, trans_id, start_year, start_month, end_year, end_month', 'numerical', 'integerOnly'=>true),
			array('paid_by', 'length', 'max' => 99),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, family_id, trans_id, paid_by, start_year, start_month, end_year, end_month', 'safe', 'on'=>'search'),
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
			'family' => array(self::BELONGS_TO, 'Families', 'family_id'),
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
			'family_id' => 'Family',
			'trans_id' => 'Trans',
			'paid_by' => 'Paid By',
			'start_year' => 'Start Year',
			'start_month' => 'Start Month',
			'end_year' => 'End Year',
			'end_month' => 'End Month',
		);
	}

	public function getFrom_month() {
		return $this->start_year . '-' . $this->start_month;
	}

	public function getTill_month() {
		return sprintf("%d-%02d", $this->end_year, $this->end_month);
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
		$criteria->compare('family_id',$this->family_id);
		$criteria->compare('trans_id',$this->trans_id);
		$criteria->compare('paid_by',$this->paid_by);
		$criteria->compare('start_month',$this->start_month,true);
		$criteria->compare('start_year',$this->start_year,true);
		$criteria->compare('end_month',$this->end_month,true);
		$criteria->compare('end_year',$this->end_year,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
