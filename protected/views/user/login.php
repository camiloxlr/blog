<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-login-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation' => false,
	)); ?>

	<div class="card signup_v4 mb-30">
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<h5 class="text-center mt-4 mb-4">Login</h5>
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

					<div class="mt-2 mb-1 d-flex justify-content-between align-items-center">
						<button class="btn btn-primary full-width d-none" type="submit">Login</button>
						<a href="<?php echo Yii::app()->baseUrl.'/index.php/user/create' ?>">Registrar-se</a>
						<?php echo CHtml::submitButton('Entrar'); ?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->