<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)); ?>
