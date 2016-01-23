<?php

/**
 * This is the model class for table "borrow".
 *
 * The followings are the available columns in table 'borrow':
 * @property string $id
 * @property string $profile_id
 * @property string $book_id
 * @property string $check_out_date
 * @property string $due_date
 * @property string $return_date
 *
 * The followings are the available model relations:
 * @property Book $book
 * @property Profile $profile
 */
class Borrow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'borrow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profile_id, book_id, check_out_date, due_date', 'required'),
			array('profile_id, book_id', 'length', 'max'=>10),
			array('return_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, profile_id, book_id, check_out_date, due_date, return_date', 'safe', 'on'=>'search'),
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
			'book' => array(self::BELONGS_TO, 'Book', 'book_id'),
			'profile' => array(self::BELONGS_TO, 'Profile', 'profile_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'profile_id' => 'Profile',
			'book_id' => 'Book',
			'check_out_date' => 'Check Out Date',
			'due_date' => 'Due Date',
			'return_date' => 'Return Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('profile_id',$this->profile_id,true);
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('check_out_date',$this->check_out_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('return_date',$this->return_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Borrow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
