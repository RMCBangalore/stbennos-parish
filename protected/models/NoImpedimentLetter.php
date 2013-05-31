<?php

/**
 * This is the model class for table "no_impediment_letters".
 *
 * The followings are the available columns in table 'no_impediment_letters':
 * @property integer $id
 * @property integer $banns_id
 * @property string $letter_dt
 *
 * The followings are the available model relations:
 * @property Banns $banns
 */
class NoImpedimentLetter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NoImpedimentLetter the static model class
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
		return 'no_impediment_letters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('banns_id', 'numerical', 'integerOnly'=>true),
			array('letter_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, banns_id, letter_dt', 'safe', 'on'=>'search'),
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
			'banns' => array(self::BELONGS_TO, 'BannsRecord', 'banns_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'banns_id' => 'Banns',
			'letter_dt' => 'Letter Date',
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
		$criteria->compare('banns_id',$this->banns_id);
		$criteria->compare('letter_dt',$this->letter_dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
