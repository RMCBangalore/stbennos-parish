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
 * This is the model class for table "marriages".
 *
 * The followings are the available columns in table 'marriages':
 * @property integer $id
 * @property string $marriage_dt
 * @property integer $groom_id
 * @property string $groom_name
 * @property string $groom_dob
 * @property string $groom_baptism_dt
 * @property string $groom_status
 * @property string $groom_rank_prof
 * @property string $groom_fathers_name
 * @property string $groom_mothers_name
 * @property string $groom_residence
 * @property string $bride_name
 * @property integer $bride_id
 * @property string $bride_dob
 * @property string $bride_baptism_dt
 * @property string $bride_status
 * @property string $bride_rank_prof
 * @property string $bride_fathers_name
 * @property string $bride_mothers_name
 * @property string $bride_residence
 * @property integer $marriage_type
 * @property string $banns_licence
 * @property string $minister
 * @property string $witness1
 * @property string $witness2
 * @property string $remarks
 * @property string $ref_no
 *
 * The followings are the available model relations:
 * @property MarriageCertificate[] $marriageCerts
 */
class MarriageRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MarriageRecord the static model class
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
		return 'marriages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('groom_name, groom_fathers_name, groom_mothers_name, groom_status, groom_rank_prof, groom_dob, groom_residence, bride_name, bride_fathers_name, bride_mothers_name, bride_status, bride_rank_prof, bride_dob, bride_residence, bride_dob, marriage_dt, banns_licence, minister, witness1, witness2', 'required'),
			array('groom_name, groom_fathers_name, groom_mothers_name, bride_name, bride_fathers_name, bride_mothers_name, minister', 'length', 'max'=>100),
			array('groom_rank_prof, groom_residence, bride_rank_prof, bride_residence', 'length', 'max'=>25),
			array('witness1, witness2, remarks', 'length', 'max'=>75),
			array('ref_no', 'length', 'max'=>10),
			array('groom_id, bride_id, marriage_type', 'numerical', 'integerOnly'=>true),
			array('marriage_dt, groom_dob, bride_dob, groom_baptism_dt, bride_baptism_dt', 'safe'),
			array('marriage_dt, groom_dob, bride_dob, groom_baptism_dt, bride_baptism_dt', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => Yii::app()->locale->getDateFormat('short')),
			array('groom_baptism_dt, bride_baptism_dt', 'default', 'setOnEmpty' => true, 'value' => null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, marriage_dt, groom_name, groom_dob, groom_baptism_dt, groom_status, groom_rank_prof, groom_fathers_name, groom_mothers_name, groom_residence, bride_name, bride_dob, bride_baptism_dt, bride_status, bride_rank_prof, bride_fathers_name, bride_mothers_name, bride_residence, marriage_type, banns_licence, minister, witness1, witness2, remarks, ref_no', 'safe', 'on'=>'search'),
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
			'marriageCerts' => array(self::HAS_MANY, 'MarriageCertificate', 'marriage_id'),
			'groom' => array(self::BELONGS_TO, 'People', 'groom_id'),
			'bride' => array(self::BELONGS_TO, 'People', 'bride_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'marriage_dt' => 'Marriage Date',
			'groom_name' => 'Groom Name',
			'groom_dob' => 'Groom Dob',
			'groom_baptism_dt' => 'Groom Baptism Date',
			'groom_status' => 'Groom Status',
			'groom_rank_prof' => 'Groom Rank / Profession',
			'groom_fathers_name' => 'Groom Fathers Name',
			'groom_mothers_name' => 'Groom Mothers Name',
			'groom_residence' => 'Groom Residence',
			'bride_name' => 'Bride Name',
			'bride_dob' => 'Bride Dob',
			'bride_baptism_dt' => 'Bride Baptism Date',
			'bride_status' => 'Bride Status',
			'bride_rank_prof' => 'Bride Rank / Profession',
			'bride_fathers_name' => 'Bride Fathers Name',
			'bride_mothers_name' => 'Bride Mothers Name',
			'bride_residence' => 'Bride Residence',
			'marriage_type' => 'Marriage Type',
			'banns_licence' => 'By Banns or Licence',
			'minister' => 'Minister',
			'witness1' => 'Witness1',
			'witness2' => 'Witness2',
			'remarks' => 'Remarks',
			'ref_no' => 'Ref No',
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
		$criteria->compare('marriage_dt',$this->marriage_dt,true);
		$criteria->compare('groom_name',$this->groom_name,true);
		$criteria->compare('groom_dob',$this->groom_dob,true);
		$criteria->compare('groom_baptism_dt',$this->groom_baptism_dt,true);
		$criteria->compare('groom_status',$this->groom_status);
		$criteria->compare('groom_rank_prof',$this->groom_rank_prof,true);
		$criteria->compare('groom_fathers_name',$this->groom_fathers_name,true);
		$criteria->compare('groom_mothers_name',$this->groom_mothers_name,true);
		$criteria->compare('groom_residence',$this->groom_residence,true);
		$criteria->compare('bride_name',$this->bride_name,true);
		$criteria->compare('bride_dob',$this->bride_dob,true);
		$criteria->compare('bride_baptism_dt',$this->bride_baptism_dt,true);
		$criteria->compare('bride_status',$this->bride_status);
		$criteria->compare('bride_rank_prof',$this->bride_rank_prof,true);
		$criteria->compare('bride_fathers_name',$this->bride_fathers_name,true);
		$criteria->compare('bride_mothers_name',$this->bride_mothers_name,true);
		$criteria->compare('bride_residence',$this->bride_residence,true);
		$criteria->compare('marriage_type',$this->marriage_type);
		$criteria->compare('banns_licence',$this->banns_licence);
		$criteria->compare('minister',$this->minister,true);
		$criteria->compare('witness1',$this->witness1,true);
		$criteria->compare('witness2',$this->witness2,true);
		$criteria->compare('remarks',$this->remarks,true);
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
		    if ($column->dbType == 'date' and isset($this->$columnName))
		    {
			$this->$columnName = date('Y-m-d',
			    CDateTimeParser::parse($this->$columnName,
			    Yii::app()->locale->getDateFormat('short')));
		    }
		}
                if (!isset($this->ref_no)) {
                    $year = date_format(new DateTime($this->marriage_dt), 'Y');
                    $cond = "marriage_dt >= '$year-01-01' and marriage_dt <= '$year-12-31'";
                    $parms = array();
                    if (isset($this->id)) {
                        $parms[':id'] = $this->id;
                        $cond = "$cond and id<=:id";
                    }
                    $recs = MarriageRecord::model()->findAll(array(
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
		$recs = MarriageRecord::model()->findAll(array(
			'condition'	=> 'year(marriage_dt)=year(:marriage_dt) and id<=:id',
			'params'	=> array(':marriage_dt' => $this->marriage_dt, ':id' => $this->id)
		));
		return date_format(new DateTime($this->marriage_dt), 'Y') . '/' . count($recs);
	}
}
