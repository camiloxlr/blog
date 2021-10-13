<?php

class PostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'comment'),
				'users'=>array('@'),
			),
			array('allow', // allow only the owner to perform 'delete' actions
                'actions' => array('delete'),
                'expression' => array('PostController','allowOnlyOwner')
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
     * Allow only the owner to do the action
     * @return boolean whether or not the user is the owner
     */
    public function allowOnlyOwner()
	{
		$_POST = json_decode(file_get_contents("php://input"), true);


		$post = Post::model()->findByPk($_POST["id"]); 
		return $post->user_id == Yii::app()->user->id;
		
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = 'vue_app';

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'comments' => $this->getComments($id)
		));
	}

	/**
	 * Adiciona um comentário ao post.
	 */
	public function actionComment()
	{
		$comment = new Comment();

		$comment->content = $_POST['comment'];
		$comment->post_id = $_POST['id'];
		$comment->comment_user_id = Yii::app()->user->id;
		$comment->created_at = date('Y-m-d H:i:s');

		if($comment->validate())
   			$comment->save();
		else
			var_dump($comment->getErrors());

		$this->actionView($_POST['id']);
	}

	/**
	 * Pega os comentários do post.
	 * @param integer $id do post
	 */
	public function getComments($id)
	{
		/*
		return Yii::app()->db->createCommand()
			->select('*')
			->from('comment')
			->where('post_id=:id', array(':id'=>$id))
			->queryAll();*/

		return Comment::model()->with('commentUser')->findAll(array(
			'select'=>'content',
			'condition'=>'post_id=:id',
			'order'=>'t.created_at DESC',
			'params'=>array(':id'=>$id),
		));

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Post;

		$this->layout = 'auth';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$_POST['Post']['user_id'] = Yii::app()->user->id;
			$_POST['Post']['is_published'] = 1;

			
			if($model->image=CUploadedFile::getInstance($model,'image')) {
				$extension = explode('/',$model->image->type)[1];
				$model->image->saveAs(Yii::app()->basePath."/../images/".$model->id.".".$extension);
				$model->image = $model->id.".".$extension;
			}

			$_POST['Post']['image'] = $model->image;
			$model->attributes=$_POST['Post'];

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout = 'auth';

		$model=$this->loadModel($id);

		$image = $model->image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Post']))
		{
			$upload = CUploadedFile::getInstance($model,'image');

			if ($upload) {
				
				if ($image != null && $image != "") {
					$rootPath = Yii::app()->getBasePath().'/..';
					unlink($rootPath.'/images/'.$image);
				}

				$model->image = $upload;
				$extension = explode('/',$upload->type)[1];
				$model->image->saveAs(Yii::app()->basePath."/../images/".$model->id.".".$extension);
				$model->image = $model->id.".".$extension;
				$image = $model->id.".".$extension;
			}

			$_POST['Post']['image'] = $image;
			$model->attributes=$_POST['Post'];

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$this->loadModel($id)->delete();
		
		if ($model->image != null && $model->image != "") {
			$rootPath = Yii::app()->getBasePath().'/..';
			unlink($rootPath.'/images/'.$model->image);
		}

		$this->sendResponse(200, $body = 'Deletado.', $contentType = 'application/json');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout = 'vue_app';

		//var_dump($_POST);
		//die();

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$criteria=new CDbCriteria;
			
			$criteria->condition="is_published=1";	
			
			if (isset($id) && $id != 0){
				$criteria->condition="is_published=1 and category_id=:category";	
			}	

			$criteria->params=array(':category'=>$id);
			$criteria->with=array('user');

			$criteria->order='t.created_at DESC';

			/*
			$criteria = array(
				'condition'=>'is_published=1',
				'order'=>'user.created_at DESC',
				'with'=>array('user'),
			);
			*/

			$dataProvider=new CActiveDataProvider('Post', array(
				'criteria'=>$criteria,
				'pagination'=>array(
					'pageSize'=>2,
				)
			));
		} else {
			$dataProvider=new CActiveDataProvider('Post', array(
				'criteria'=>array(
					'condition'=>'is_published=1',
					'order'=>'t.created_at DESC',
					'with'=>array('user'),
				),
				'pagination'=>array(
					'pageSize'=>2,
				)
			));
		}

		$categories = Category::model()->findAll();

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'categories'=>$categories,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Post the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Post $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
