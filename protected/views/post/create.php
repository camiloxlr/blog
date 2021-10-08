<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Artigos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h5>Novo artigo</h5>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>