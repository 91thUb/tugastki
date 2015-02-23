<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property integer $id
 * @property string $author
 * @property string $title
 * @property string $content
 * @property string $published
 * @property string $url
 *
 * The followings are the available model relations:
 * @property DocumentFreq[] $documentFreqs
 */
class Document extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Document the static model class
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
		return 'document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('author, title, content, published, url', 'required'),
			array('author, title, published', 'length', 'max'=>255),
			array('content, url', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, author, title, content, published, url', 'safe', 'on'=>'search'),
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
			'documentFreqs' => array(self::HAS_MANY, 'DocumentFreq', 'id_document'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author' => 'Author',
			'title' => 'Title',
			'content' => 'Content',
			'published' => 'Published',
			'url' => 'Url',
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
		$criteria->compare('author',$this->author,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('published',$this->published,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getN()
    {
        return Document::model()->count();
    }
    
    public static function getDf($term)
    {
        $criteria = new CDbCriteria();
		$criteria->select = 't.id';
		$criteria->join = 'LEFT JOIN term as tr ON t.id_term = tr.id';
		$criteria->condition = 'tr.term =:term AND t.id_document_freq_type = 1';
		$criteria->params = array(':term' => strtolower($term));
        
        return DocumentFreq::model()->count($criteria);
    }
}