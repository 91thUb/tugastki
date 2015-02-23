<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('document/admin'); ?>">Document</a>
    <small>></small> 
    <a href="#">Update</a>
</div>

<?php
/* @var $this DocumentController */
/* @var $model Document */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Document', 'url'=>array('index')),
	array('label'=>'Create Document', 'url'=>array('create')),
	array('label'=>'View Document', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Document', 'url'=>array('admin')),
);
?>

<div id="wrapped_content">
    <h1>Update Document <?php echo $model->title; ?></h1>
    
    <div class="form_actions"> 
        <a href="<?php echo $this->createUrl('document/admin'); ?>"><span class="icon_edit"> </span>Close</a>
    </div>
    
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>