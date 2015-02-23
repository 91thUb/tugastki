<?php

class StopWordController extends CoreController
{
    public $moduleName = 'Stop Word';
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new StopWord;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StopWord']))
		{
			$model->attributes=$_POST['StopWord'];
			if($model->save())
            {
				Yii::app()->user->setFlash('success', 'Stop Word "' . $model->word .'" saved!');
                $model=new StopWord;
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StopWord']))
		{
			$model->attributes=$_POST['StopWord'];
			if($model->save())
            {
				Yii::app()->user->setFlash('success', 'Stop Word "' . $model->word .'" updated!');
				$model=$this->loadModel($model->id);
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        
        Yii::app()->user->setFlash('success', 'Term "'. $model->word .'" deleted!');
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('stopWord/admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StopWord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StopWord']))
			$model->attributes=$_GET['StopWord'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=StopWord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stop-word-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionAddFromFile()
    {
        $model = new FormStopWord();
        
        if(isset($_POST['FormStopWord']))
        {
            $model->attributes = $_POST['FormStopWord'];
            $file = CUploadedFile::getInstance($model, 'file');
            
            if($model->validate())
            {
                if($file != null)
                {
                    $filePath = Yii::app()->basePath . '/../files/stopword/stopword.txt';
                    $file->saveAs($filePath);
                    
                    $handle = fopen($filePath, 'r');

                    if($handle)
                    {
                        $models = StopWord::model();
                        $tr = $models->dbConnection->beginTransaction();
                        
                        try
                        {
                            if(isset($_POST['deleteData']))
                            {
                                StopWord::model()->deleteAll();
                            }
                            
                            while($line = fgets($handle))
                            {
                                $model = new StopWord();
                                $model->word = $line;
                                $model->save();
                            }
                            
                            $tr->commit();
                            Yii::app()->user->setFlash('success', 'Stop words saved!');
                        }
                        catch(Exception $e)
                        {
                            $tr->rollback();
                            Yii::app()->user->setFlash('error', 'Error, please try again');
                        }
                    }
                    else
                    {
                        Yii::app()->user->setFlash('error', 'Error, please try again');
                    }

                    fclose($handle);
                    
//                    unlink($filePath);
                }
                else
                {
                    Yii::app()->user->setFlash('error', 'Error, please try again');
                }
            }
        }
        
        $this->render('selectFile',array(
            'model' => $model
        ));
    }
}
