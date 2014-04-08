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
 * This is the model class for table "deaths".
 *
 * The followings are the available columns in table 'deaths':
 * @property integer $id
 * @property integer $member_id
 * @property string $death_dt
 * @property string $cause
 * @property string $fname
 * @property string $lname
 * @property double $age
 * @property string $profession
 * @property string $buried_dt
 * @property string $minister
 * @property string $burial_place
 * @property string $ref_no
 * @property string $residence
 * @property string $community
 * @property string $parents_relatives
 * @property string $sacrament
 *
 * The followings are the available model relations:
 * @property DeathCertificate[] $deathCerts
 */
class DeathRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeathRecord the static model class
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
		return 'deaths';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('death_dt, buried_dt, burial_place, fname, lname, age', 'required'),
			array('age, member_id', 'numerical', 'integerOnly'=>true),
			array('cause', 'length', 'max'=>100),
			array('fname, community', 'length', 'max'=>50),
			array('lname, profession, burial_place, sacrament', 'length', 'max'=>25),
			array('minister, residence, parents_relatives', 'length', 'max'=>75),
			array('ref_no', 'length', 'max'=>10),
			array('buried_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, death_dt, cause, fname, lname, age, profession, buried_dt, minister, burial_place, ref_no', 'safe', 'on'=>'search'),
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
			'deathCerts' => array(self::HAS_MANY, 'DeathCertificate', 'death_id'),
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
			'member_id' => 'Member ID',
			'death_dt' => 'Death Date',
			'cause' => 'Cause of Death',
			'fname' => 'First Name',
			'lname' => 'Last Name',
			'age' => 'Age',
			'profession' => 'Profession',
			'buried_dt' => 'Buried Date',
			'minister' => 'Minister',
			'burial_place' => 'Burial Place',
			'ref_no' => 'Ref No',
			'residence' => 'Residence',
			'community' => 'Community',
			'parents_relatives' => 'Parents / Relatives Name',
			'sacrament' => 'Sacrament',
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
		if (isset($this->death_dt) and $this->death_dt) {
			$criteria->compare('death_dt', date('Y-m-d',
				CDateTimeParser::parse($this->death_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		$criteria->compare('cause',$this->cause,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('profession',$this->profession,true);
		if (isset($this->buried_dt) and $this->buried_dt) {
			$criteria->compare('buried_dt', date('Y-m-d',
				CDateTimeParser::parse($this->buried_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		$criteria->compare('minister',$this->minister,true);
		$criteria->compare('residence',$this->residence,true);
		$criteria->compare('community',$this->community,true);
		$criteria->compare('parents_relatives',$this->parents_relatives,true);
		$criteria->compare('sacrament',$this->sacrament,true);
		$criteria->compare('burial_place',$this->burial_place,true);
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
                    $year = date_format(new DateTime($this->death_dt), 'Y');
                    $cond = "death_dt >= '$year-01-01' and death_dt <= '$year-12-31'";
                    $parms = array();
                    if (isset($this->id)) {
                        $parms[':id'] = $this->id;
                        $cond = "$cond and id<=:id";
                    }
                    $recs = DeathRecord::model()->findAll(array(
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
		$recs = DeathRecord::model()->findAll(array(
			'condition'	=> 'year(death_dt)=year(:death_dt) and id<=:id',
			'params'	=> array(':death_dt' => $this->death_dt, ':id' => $this->id)
		));
		return date_format(new DateTime($this->death_dt), 'Y') . '/' . count($recs);
	}
}
