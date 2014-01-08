<?php
#
# This file is part of St. Benno's Parish Software
#
# St. Benno's Parish Software - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# St. Benno's Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# St. Benno's Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

/**
 * This is the model class for table "confirmations".
 *
 * The followings are the available columns in table 'confirmations':
 * @property integer $id
 * @property integer $member_id
 * @property string $ref_no
 * @property string $name
 * @property string $confirmation_dt
 * @property string $church
 * @property string $dob
 * @property string $baptism_dt
 * @property string $baptism_place
 * @property string $parents_name
 * @property string $residence
 * @property string $godparent_name
 * @property string $minister
 *
 * The followings are the available model relations:
 * @property ConfirmationCertificate[] $confirmationCerts
 */
class ConfirmationRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConfirmationRecord the static model class
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
		return 'confirmations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('confirmation_dt, dob, name, parents_name, baptism_dt', 'required'),
			array('name, godparent_name', 'length', 'max'=>75),
			array('member_id', 'numerical', 'integerOnly'=>true),
			array('church, residence, baptism_place, minister', 'length', 'max'=>50),
			array('ref_no', 'length', 'max'=>10),
			array('confirmation_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, confirmation_dt, church', 'safe', 'on'=>'search'),
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
			'confirmationCerts' => array(self::HAS_MANY, 'ConfirmationCertificate', 'confirmation_id'),
			'member' => array(self::BELONGS_TO, 'People', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'confirmation_dt' => 'Confirmation Date',
			'dob' => 'Date of Birth',
			'baptism_dt' => 'Baptism Date',
			'church' => 'Church',
			'ref_no' => 'Ref No',
			'parents_name' => 'Parent’s Name',
			'godparent_name' => 'Godparent’s Name',
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
		$criteria->compare('confirmation_dt',$this->confirmation_dt,true);
		$criteria->compare('church',$this->church,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('baptism_dt',$this->baptism_dt,true);
		$criteria->compare('baptism_place',$this->baptism_place,true);
		$criteria->compare('parents_name',$this->parents_name,true);
		$criteria->compare('residence',$this->residence,true);
		$criteria->compare('godparent_name',$this->godparent_name,true);
		$criteria->compare('minister',$this->minister,true);
		$criteria->compare('ref_no',$this->ref_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function get_refno() {
		$recs = ConfirmationRecord::model()->findAll(array(
			'condition'	=> 'year(confirmation_dt)=year(:confirmation_dt) and id<=:id',
			'params'	=> array(':confirmation_dt' => $this->confirmation_dt, ':id' => $this->id)
		));
		return date_format(new DateTime($this->confirmation_dt), 'Y') . '/' . count($recs);
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
                if (!isset($this->ref_no)) {
                    $year = date_format(new DateTime($this->confirmation_dt), 'Y');
                    $cond = "confirmation_dt >= '$year-01-01' and confirmation_dt <= '$year-12-31'";
                    $parms = array();
                    if (isset($this->id)) {
                        $parms[':id'] = $this->id;
                        $cond = "$cond and id<=:id";
                    }
                    $recs = ConfirmationRecord::model()->findAll(array(
                        'condition'     => $cond,
                        'params'        => $parms, 
                    ));
                    $cnt = count($recs);
                    if (!isset($this->id)) {
                        ++$cnt;
                    }
                    $this->ref_no = "$year/$cnt";
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
