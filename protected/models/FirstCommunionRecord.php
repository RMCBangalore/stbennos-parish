<?php

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
 * @property FirstCommunionCerts[] $firstCommunionCerts
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
			'firstCommunionCerts' => array(self::HAS_MANY, 'FirstCommunionCerts', 'first_comm_id'),
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
		$criteria->compare('communion_dt',$this->communion_dt,true);
		$criteria->compare('ref_no',$this->ref_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function get_refno() {
		$recs = firstCommunionRecord::model()->findAll(array(
			'condition'	=> 'year(communion_dt)=year(:communion_dt) and id<=:id',
			'params'	=> array(':communion_dt' => $this->communion_dt, ':id' => $this->id)
		));
		return date_format(new DateTime($this->communion_dt), 'Y') . '/' . count($recs);
	}
}
