<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('term/admin'); ?>">Term</a>
    <small>></small> 
    <a href="#">Update</a>
</div>


<?php
/* @var $this TermController */
/* @var $model Term */
?>


<div id="wrapped_content">
    <h1>Update Term '<?php echo $model->term; ?>'</h1>
    
    <div class="form_actions"> 
        <a href="<?php echo $this->createUrl('term/admin'); ?>"><span class="icon_edit"> </span>Close</a>
    </div>
    
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>