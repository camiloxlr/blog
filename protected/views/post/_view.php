<?php
/* @var $this PostController */
/* @var $data Post */
$postUrl = Yii::app()->baseUrl.'/index.php/post/view/id/'.$data->id;
?>

<div class="card articleItem px-2 mt-3" onclick="openArticle(<?php echo $data->id; ?>)" style="cursor:pointer;">
	<div class="row">
		<div class="col-3 d-flex justify-content-center align-items-center">
			<img class="postImage" src="<?=Yii::app()->request->baseUrl?>/images/<?php echo $data->image; ?>" alt="">
		</div>
		<div class="col-9">
			<div class="row">

				<div class="col-12 mt-2">
					<span class="postTitle"><?php echo CHtml::encode($data->title); ?></span>
					<br />
				</div>

				<div class="col-12">
					<?php echo mb_strimwidth($data->content, 0, 60, "...") ?>
					<br />
				</div>

				<div class="col-6">
					Autor: 
					<?php echo CHtml::encode($data->user->name); ?>
					<br />
				</div>

				<div class="col-6">
					<?php echo CHtml::encode($data->getAttributeLabel('reading_time')); ?>:
					<?php echo CHtml::encode($data->reading_time).'min'; ?>
					<br />
				</div>

				<div class="col-6">
					<?php echo CHtml::encode($data->getAttributeLabel('published_at')); ?>:
					<?php echo CHtml::encode($data->published_at); ?>
					<br />
				</div>

				<div class="col-6 mb-1">
					<?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:
					<?php echo CHtml::encode($data->category->name); ?>
					<br />
				</div>

				<div class="col-6 mb-3 d-none">
					<?php echo CHtml::link('Ler este artigo', array('view', 'id' => $data->id)); ?>
				</div>	
			</div>
		</div>
	</div>
</div>
</a>