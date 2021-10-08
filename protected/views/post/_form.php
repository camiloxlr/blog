<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reading_time'); ?>
		<?php echo $form->numberField($model,'reading_time'); ?>
		<?php echo $form->error($model,'reading_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<div class="col-12 px-0 d-flex justify-content-between align-items-center">
			<a href="<?php echo Yii::app()->baseUrl.'/index.php/post/index' ?>" class="btn btn-sm btn-secondary">Voltar</a>
			<?php echo CHtml::submitButton('Salvar'); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->