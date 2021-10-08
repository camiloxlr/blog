<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs = array(
	'Artigos' => array('index'),
	$model->title,
);
?>

<div class="px-4">


		<?php if($model->user_id == Yii::app()->user->id || true): ?>
			<button class="btn btn-sm btn-danger mb-2" style="float: right;" id="delete-post">Apagar</button>
		<?php endif; ?>

	<h5 class="mt-5"><?php echo $model->title; ?></h5>

	<p><?php echo $model->content; ?></p>
	<div class="row mt-3">
		<div class="col-md-10">
			<input type="text" class="w-100" placeholder="Insira um comentário..." id="comment-input">
		</div>
		<div class="col-md-2">
			<button class="btn btn-primary btn-sm" id="send-comment">Comentar</button>
		</div>
	</div>
	<h6 class="mt-3 mb-2">Comentários</h6>
	<div><?php
			foreach ($comments as $comment) {
				echo '<div class="row">';
				echo '<div class="col-12">';
				echo '<p>' . $comment['commentUser']['name'] . '</p>';
				echo '<div class="col-12 mt-1">';
				echo '<p class="pl-3">' . $comment['content'] . '</p>';
				echo '</div></div>';
			}
			?></div>
</div>

<script>
	$("#delete-post").click(function(){
		let data = {
			'id': <?php echo $model->id; ?>
		};
		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createAbsoluteUrl("post/delete"); ?>',
			data: data,
			success: function(data) {
				alert(data);
			},
			error: function(data) { // if error occured
				alert("Deu ruim.");
			},

			dataType: 'html'
		});
	});

	$("#send-comment").click(function(){
		let data = {
			'id': <?php echo $model->id; ?>,
			'comment': $("#comment-input").val(),
		};
		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createAbsoluteUrl("post/comment"); ?>',
			data: data,
			success: function(data) {
				alert(data);
			},
			error: function(data) { // if error occured
				alert("Deu ruim.");
			},

			dataType: 'html'
		});
	});
</script>