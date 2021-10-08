<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
	'Artigos',
);
?>

<div class="row">
	<div class="col-12 d-flex justify-content-end">
		<?php if (!Yii::app()->user->isGuest) : ?>
			<a class="btn btn-sm btn-primary" href="<?php echo Yii::app()->baseUrl . '/index.php/post/create' ?>">Adicionar</a>
		<?php endif ?>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<select name="category" id="category">
			<option value="0">Todas categorias</option>
			<?php foreach ($categories as $category) : ?>
				<option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)); ?>

<script>
	$('#category').change(function() {
		let data = {
			'id': $('#category').val()
		};
		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createAbsoluteUrl("post/FilterByCategory"); ?>',
			data: data,
			success: function(data) {
				//alert(data);
				$(".list-view").html(data);
			},
			error: function(data) { // if error occured
				alert("Error occured.please try again");
				alert(data);
			},

			dataType: 'html'
		});
	});
</script>