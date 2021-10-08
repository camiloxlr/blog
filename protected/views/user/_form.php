<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation' => false,
	)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-12">
			<h6>Cadastro de Usuário</h6>

			<div class="row">
				<?php echo $form->labelEx($model, 'name'); ?>
				<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
				<?php echo $form->error($model, 'name'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model, 'email'); ?>
				<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
				<?php echo $form->error($model, 'email'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model, 'password'); ?>
				<?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 255)); ?>
				<?php echo $form->error($model, 'password'); ?>
			</div>

			<div class="row buttons">
				<div class="col-12 px-0 d-flex justify-content-between align-items-center">
					<a href="<?php echo Yii::app()->baseUrl.'/index.php/user/login' ?>" class="btn btn-sm btn-secondary">Voltar</a>
					<button type="button" class="btn btn-primary d-none" id="create-user">Cadastrar</button>
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Save'); ?>
				</div>
			</div>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->