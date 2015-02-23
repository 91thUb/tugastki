<div id='wrapped_content'>  
    <div id="ar_left">
        <?php $form=$this->beginWidget('CActiveForm',array(
            'id'=>'searchform',
            'enableAjaxValidation'=>false,
        )); ?>
        
            <div id='search_form_container'>
                <input type="text" name="q" id="q" value="<?php echo isset($query)? $query : "" ?>"/>
                <input type="submit" name="s" id="s" value=""/>
            </div>
            <div id="search_form_description">
                Search from indexed document
            </div>
            <div id="search_logo">
            </div>
            <div id="search_text">
                SearchD
            </div>
         <?php
             $this->endWidget(); 
         ?>
        
        <div id="search_retype_query" style="max-width: 500px">
            <?php echo isset($query)? "<i>Search result for : </i> " . $query : "" ?>
            <?php //echo isset($query)? "<br/><i>Get results in : </i> " . $time . " seconds." : "" ?>
        </div>
        
        <div id="search_result_container">
            <?php if(isset($result) && count($result)> 0): ?>
            <?php foreach($result as $doc): ?>
            <div class="search_result">
                <div class="sign"></div>
                <div class="title">
                    <a href="<?= $doc['url']; ?>" target="_blank"><?= $doc['title']; ?></a> [<?php echo sprintf('%0.4f', $weight[$doc['id']]);   ?>]
                </div>
                <div class="author">
                    Author : <?= $doc['author']; ?>
                </div>
                <div class="content">
                    <?= $doc['content']; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <br/>
            <br/>
            <?php endif; ?>
        </div>
    </div>
</div>