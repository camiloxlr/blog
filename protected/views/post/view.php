<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs = array(
	'Artigos' => array('index'),
	$model->title,
);
?>

<div class="px-4">

<div class="row">
	<div class="col-12">
		<?php if(true): ?>

		<?php endif; ?>
	</div>
</div>

	<h5 class="mt-5"><?php echo $model->title; ?></h5>

	<p><?php echo $model->content; ?></p>

	<h6 class="mt-4 mb-2">Comentários</h6>
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