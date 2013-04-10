<?php

/**
 * This is the model class for table "marriage_certs".
 *
 * The followings are the available columns in table 'marriage_certs':
 * @property integer $id
 * @property string $cert_dt
 * @property integer $marriage_id
 *
 * The followings are the available model relations:
 * @property Marriages $marriage
 */
class MarriageCertificate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MarriageCertificate the static model class
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
		return 'marriage_certs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('marriage_id', 'numerical', 'integerOnly'=>true),
			array('cert_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cert_dt, marriage_id', 'safe', 'on'=>'search'),
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
			'marriage' => array(self::BELONGS_TO, 'Marriages', 'marriage_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cert_dt' => 'Cert Dt',
			'marriage_id' => 'Marriage',
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
		$criteria->compare('cert_dt',$this->cert_dt,true);
		$criteria->compare('marriage_id',$this->marriage_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}