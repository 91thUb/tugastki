<div id='wrapped_content'>
    
    <div id="company_info">
        <div id="company_text_header">
            Application Name
        </div>
        <div class="text_description">
            Some text here to decription your company application. Its can be one or two line.
        </div>
        <br/>
        <div class="text_description">
            Talk about some benefits using this application:
            <ul>
                <li>
                    User can be do something better.
                </li>
                <li>
                    Using a new brand new server, heavy trafic data doesn't matter.
                </li>
                <li>
                    Elegant user interface, doesn't make user thinking twice.
                </li>
            </ul>
        </div>
        <br/>
        <div class="text_description">
            End of description, you can write anything.
        </div>
    </div>
    
    <div id="login">
        <?php $form=$this->beginWidget('CActiveForm',array(
            'id'=>'login-form',
            'enableAjaxValidation'=>false,
        )); ?>

        <div id="login_title_text">
            Login
        </div>
        <br/>
        <div class="form">
            <div class="row">
                <?php echo $form->labelEx($model,'username'); ?>
                <?php echo $form->textField($model,'username', array('size'=> 35)); ?>
                <?php echo $form->error($model,'username'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password', array('size'=> 35)); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::submitButton('Login'); ?>
                <?php echo $form->checkbox($model, 'rememberMe', array('style'=>'margin: 2px 0px 2px 10px;')); ?> Remember me
            </div>
        </div>
        <?php
             $this->endWidget(); 
        ?>
    </div>
</div>