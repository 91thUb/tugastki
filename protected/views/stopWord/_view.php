<?php
/* @var $this StopWordController */
/* @var $data StopWord */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('word')); ?>:</b>
	<?php echo CHtml::encode($data->word); ?>
	<br />


</div>