<?php

class SiteController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->redirect(array('post/index'));

		$connection = Yii::app()->db; 
		$command = $connection->createCommand('select * from user');
		$dataReader = $command->query(); // execute a query SQL
		$rows=$dataReader->readAll();

		var_dump($rows);

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
}