<?php

class FormDocument extends CFormModel
{
    public $file;
    
    public function rules()
    {
        return array(
            array('file', 'file', 'allowEmpty' => false)
        );
    }

    public function attributeLabels()
    {
        return array(
            'file' => 'Document XML',
        );
    }
}