<?php
/* @var $this StopWordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Stop Words',
);

$this->menu=array(
	array('label'=>'Create StopWord', 'url'=>array('create')),
	array('label'=>'Manage StopWord', 'url'=>array('admin')),
);
?>

<h1>Stop Words</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
