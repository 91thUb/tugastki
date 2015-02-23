<?php
/* @var $this StopWordController */
/* @var $model StopWord */

$this->breadcrumbs=array(
	'Stop Words'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StopWord', 'url'=>array('index')),
	array('label'=>'Create StopWord', 'url'=>array('create')),
	array('label'=>'Update StopWord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StopWord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StopWord', 'url'=>array('admin')),
);
?>

<h1>View StopWord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'word',
	),
)); ?>
