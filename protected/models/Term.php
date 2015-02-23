<?php

/**
 * This is the model class for table "term".
 *
 * The followings are the available columns in table 'term':
 * @property integer $id
 * @property string $term
 * @property integer $freq
 *
 * The followings are the available model relations:
 * @property DocumentFreq[] $documentFreqs
 */
class Term extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Term the static model class
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
		return 'term';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('freq', 'numerical', 'integerOnly'=>true),
			array('term', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, term, freq', 'safe', 'on'=>'search'),
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
			'documentFreqs' => array(self::HAS_MANY, 'DocumentFreq', 'id_term'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'term' => 'Term',
			'freq' => 'Freq',
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
		$criteria->compare('term',$this->term,true);
		$criteria->compare('freq',$this->freq);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getTermWeightTfIdfByTermAndByDocumentId($term, $documentId, $type = 2)
    {
        $criteria = new CDbCriteria();
		$criteria->select = 't.*';
        $criteria->join   = 'LEFT JOIN term as tr ON t.id_term = tr.id';
		$criteria->condition = 't.id_document =:documentId AND t.id_document_freq_type =:type AND tr.term =:term';
		$criteria->params = array(':documentId' => $documentId, ':type' => $type, ':term' => $term);
        
        $result = 0;
        
        $docFreq = DocumentFreq::model()->find($criteria);
        
        if(count($docFreq) > 0 )
            $result = $docFreq->weight;
        
        return $result;
    }
}