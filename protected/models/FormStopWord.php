<?php

class FormStopWord extends CFormModel
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
            'file' => 'Stop word list file',
        );
    }
}