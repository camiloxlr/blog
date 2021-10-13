<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
		
	/**
	 * Send raw HTTP response
	 * @param int $status HTTP status code
	 * @param string $body The body of the HTTP response
	 * @param string $contentType Header content-type
	 * @return HTTP response 
	 */
	protected function sendResponse($status = 200, $body = '', $contentType = 'application/json')
	{
		// Set the status
		$statusHeader = 'HTTP/1.1 ' . $status;
		header($statusHeader);
		// Set the content type
		header('Content-type: ' . $contentType);
	 
		echo $body;
		Yii::app()->end();
	}
}