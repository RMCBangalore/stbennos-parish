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
 * This is the model class for table "field_names".
 *
 * The followings are the available columns in table 'field_names':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property FieldValues[] $fieldValues
 */
class FieldNames extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FieldNames the static model class
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
		return 'field_names';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'fieldValues' => array(self::HAS_MANY, 'FieldValues', 'field_id'),
		);
	}

    public static function values($name) {
        $model = self::model()->find(array(
            'condition' => 'name=:name',
            'params'    => array(':name' => $name)
        ));
		foreach($model->fieldValues as $fv) {
			$table[$fv->code] = $fv->name;
		}
		return $table;
    }
	
	public static function value($name, $code) {
		if (empty($code)) {
			return null;
		}
		$fv = FieldNames::values($name);
		return $fv[$code];
	}

	public static function find_value($name, $val) {
		$model = self::model()->find(array(
		    'condition' => 'name=:name',
		    'params'    => array(':name' => $name)
		));
		foreach($model->fieldValues as $fv) {
			if (0 == strcasecmp($fv->name,$val)) {
				return $fv->code;
			}
		}
		return null;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
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
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
