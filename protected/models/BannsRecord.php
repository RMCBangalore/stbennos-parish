<?php

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
		$criteria->compare('banns_dt1',$this->banns_dt1,true);
		$criteria->compare('banns_dt2',$this->banns_dt2,true);
		$criteria->compare('banns_dt3',$this->banns_dt3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
}
