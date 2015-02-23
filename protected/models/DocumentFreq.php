<?php

/**
 * This is the model class for table "document_freq".
 *
 * The followings are the available columns in table 'document_freq':
 * @property integer $id
 * @property integer $id_document
 * @property integer $id_document_freq_type
 * @property integer $id_term
 * @property double $weight
 *
 * The followings are the available model relations:
 * @property Document $idDocument
 * @property DocumentFreqType $idDocumentFreqType
 * @property Term $idTerm
 */
class DocumentFreq extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentFreq the static model class
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
		return 'document_freq';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_document, id_document_freq_type, id_term', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_document, id_document_freq_type, id_term, weight', 'safe', 'on'=>'search'),
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
			'document' => array(self::BELONGS_TO, 'Document', 'id_document'),
			'documentFreqType' => array(self::BELONGS_TO, 'DocumentFreqType', 'id_document_freq_type'),
			'term' => array(self::BELONGS_TO, 'Term', 'id_term'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_document' => 'Id Document',
			'id_document_freq_type' => 'Id Document Freq Type',
			'id_term' => 'Id Term',
			'weight' => 'Weight',
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
		$criteria->compare('id_document',$this->id_document);
		$criteria->compare('id_document_freq_type',$this->id_document_freq_type);
		$criteria->compare('id_term',$this->id_term);
		$criteria->compare('weight',$this->weight);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}