<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Artigos'=>array('index'),
	'Editar',
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'View Post', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h5>Editar Artigo</h5>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>