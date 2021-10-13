<?php

class CommentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

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
			array(
				'allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view', 'postComments'),
				'users' => array('*'),
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update'),
				'users' => array('@'),
			),
			array(
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin'),
				'users' => array('admin'),
			),
			array(
				'allow', // allow only the owner to perform 'delete' actions
				'actions' => array('delete'),
				'expression' => array('CommentController', 'allowOnlyOwner')
			),
			array(
				'deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$_POST = json_decode(file_get_contents("php://input"), true);

		$comment = new Comment();

		$comment->content = $_POST['comment'];
		$comment->post_id = $_POST['id'];
		$comment->comment_user_id = Yii::app()->user->id;
		$comment->created_at = date('Y-m-d H:i:s');

		if ($comment->validate()) {
			$comment->save();
			$this->sendResponse(200, $body = 'Comentado.', $contentType = 'application/json');
		} else {
			//var_dump($comment->getErrors());
			$this->sendResponse(500, $body = json_encode($comment->getErrors()), $contentType = 'application/json');
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Comment'])) {
			$model->attributes = $_POST['Comment'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('update', array(
			'model' => $model,
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

		$this->sendResponse(200, $body = 'Deletado.', $contentType = 'application/json');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Comment');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionPostComments($id)
	{
		$comments = Comment::model()->with(array(
			'commentUser' => array(
				'select' => 'id, name',
			)
		))
			->findAll(array(
				'condition' => 't.post_id=:id',
				'order' => 't.created_at DESC',
				'params' => array(':id' => $id)
			));

		$commentArr = [];
		foreach ($comments as $comment) {
			$commentArr[] = [
				'name' => $comment->commentUser->name,
				'id' => $comment->id,
				'content' => $comment->content,
				'date' => $comment->created_at,
				'post' => $comment->post_id,
				'owner' => $comment->commentUser->id == Yii::app()->user->id,
			];
		}

		$this->renderJSON($commentArr);
	}

	/**
	 * Allow only the owner to do the action
	 * @return boolean whether or not the user is the owner
	 */
	public function allowOnlyOwner()
	{
		$_POST = json_decode(file_get_contents("php://input"), true);

		$comment = Comment::model()->findByPk($_POST["id"]);
		return $comment->comment_user_id == Yii::app()->user->id;
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Comment']))
			$model->attributes = $_GET['Comment'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Comment::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Return data to browser as JSON and end application.
	 * @param array $data
	 */
	protected function renderJSON($data)
	{
		header('Content-type: application/json');
		echo CJSON::encode($data);

		foreach (Yii::app()->log->routes as $route) {
			if ($route instanceof CWebLogRoute) {
				$route->enabled = false; // disable any weblogroutes
			}
		}
		Yii::app()->end();
	}
}
