<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('stopWord/admin'); ?>">Stop Word</a>
    <small>></small> 
    <a href="#">Create</a>
</div>
    
    
<?php
/* @var $this TermController */
/* @var $model Term */
?>

<div id="wrapped_content">
    <h1>Create Stop Word</h1>
    
    <div class="form_actions"> 
        <a href="<?php echo $this->createUrl('stopWord/admin'); ?>"><span class="icon_edit"> </span>Close</a>
    </div>
    
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>