<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs = array(
	'Artigos' => array('index'),
	$model->title,
);
?>

<div class="">
		<?php if($model->user_id == Yii::app()->user->id): ?>
			<button class="btn btn-sm btn-danger" style="float: right;" onclick="deleteArticle(<?php echo $model->id; ?>)" id="delete-post">Apagar</button>
			<a href="<?php echo Yii::app()->createAbsoluteUrl("post/update", ['id' => $model->id]); ?>" class="btn btn-sm btn-secondary mr-2" style="float: right;" id="edit-post">Editar</a>
		<?php endif; ?>
	<div class="row">
		<div class="col-12 d-flex justify-content-center align-items-center">
			<img id="post-image" src="<?=Yii::app()->request->baseUrl?>/images/<?php echo $model->image; ?>" alt="">
		</div>
	</div>
	<h5 class="mt-5"><?php echo $model->title; ?></h5>

	<p><?php echo $model->content; ?></p>
	
	<?php if(!Yii::app()->user->isGuest): ?>
		<div class="row mt-4">
			<div class="col-md-10">
				<input type="text" class="w-100" maxlength="30" placeholder="Insira um comentário..." id="comment-input">
			</div>
			<div class="col-md-2">
				<button class="btn btn-primary btn-sm" id="send-comment" v-on:click="sendComment(<?php echo $model->id; ?>)">Comentar</button>
			</div>
		</div>
	<?php endif; ?>

	<h6 class="mt-3 mb-2">Comentários</h6>
	<div class="row">
		<div class="col-12 mt-1" v-for="comment in comments">
			<span>{{comment.name}}</span>
			<br>
			<span>{{comment.content}}</span>
		</div>
	</div>
</div>