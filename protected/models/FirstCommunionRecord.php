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
 * This is the model class for table "first_communions".
 *
 * The followings are the available columns in table 'first_communions':
 * @property integer $id
 * @property integer $member_id
 * @property string $name
 * @property string $church
 * @property string $communion_dt
 * @property string $ref_no
 *
 * The followings are the available model relations:
 * @property FirstCommunionCertificate[] $firstCommunionCerts
 */
class FirstCommunionRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FirstCommunionRecord the static model class
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
		return 'first_communions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>75),
			array('church', 'length', 'max'=>50),
			array('member_id', 'numerical', 'integerOnly'=>true),
			array('communion_dt', 'safe'),
			array('ref_no', 'length', 'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, communion_dt, ref_no', 'safe', 'on'=>'search'),
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
			'firstCommunionCerts' => array(self::HAS_MANY, 'FirstCommunionCertificate', 'first_comm_id'),
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
			'communion_dt' => 'Communion Date',
			'ref_no' => 'Ref No',
			'church' => 'Church',
			'member_id' => 'Member ID',
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
		$criteria->compare('church',$this->church,true);
		if (isset($this->communion_dt) and $this->communion_dt) {
			$criteria->compare('communion_dt', date('Y-m-d',
				CDateTimeParser::parse($this->communion_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		$criteria->compare('ref_no',$this->ref_no,true);

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
                if (!isset($this->ref_no)) {
                    $year = date_format(new DateTime($this->communion_dt), 'Y');
                    $cond = "communion_dt >= '$year-01-01' and communion_dt <= '$year-12-31'";
                    $parms = array();
                    if (isset($this->id)) {
                        $parms[':id'] = $this->id;
                        $cond = "$cond and id<=:id";
                    }
                    $recs = FirstCommunionRecord::model()->findAll(array(
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

	public function get_refno() {
		$recs = firstCommunionRecord::model()->findAll(array(
			'condition'	=> 'year(communion_dt)=year(:communion_dt) and id<=:id',
			'params'	=> array(':communion_dt' => $this->communion_dt, ':id' => $this->id)
		));
		return date_format(new DateTime($this->communion_dt), 'Y') . '/' . count($recs);
	}
}
