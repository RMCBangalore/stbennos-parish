<?php

/**
 * This is the model class for table "accounts".
 *
 * The followings are the available columns in table 'accounts':
 * @property integer $id
 * @property string $name
 * @property integer $parent
 *
 * The followings are the available model relations:
 * @property Account $parent0
 * @property Account[] $accounts
 * @property Transactions[] $transactions
 */
class Account extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Account the static model class
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
		return 'accounts';
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
			array('parent', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('type, placeholder, reserved', 'safe'),
			array('placeholder, reserved', 'default', 'setOnEmpty' => true, 'value' => null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, parent', 'safe', 'on'=>'search'),
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
			'parentAccount' => array(self::BELONGS_TO, 'Account', 'parent'),
			'childAccounts' => array(self::HAS_MANY, 'Account', 'parent'),
			'transactions' => array(self::HAS_MANY, 'Transaction', 'account'),
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
			'parent' => 'Parent',
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
		$criteria->compare('parent',$this->parent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function get($name)
	{
		return Account::model()->findByAttributes(array('name' => $name));
	}

	public static function values() {
		$data = self::model()->findAll();
		$list = array();
		foreach($data as $item) {
			$list[$item->id] = $item->name;
		}
		return $list;
	}

	public static function value($id) {
		$model = self::model()->findByPk($id);
		return $model;
	}

	public static function selectables() {
		$data = self::model()->findAll("reserved IS NULL AND placeholder IS NULL");

		$list = array();
		foreach($data as $item) {
			$list[$item->id] = $item->name;
		}

		return $list;
	}
}
