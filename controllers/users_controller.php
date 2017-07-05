<?php 
class UsersController extends AppController
{
	var $name = "Users";
	var $components = array('Auth');
	
	function index()
	{
		
	}
	
	function beforeFilter()
	{
        parent::beforeFilter();
		$this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'welcome');
	}
	
	function login()
	{
	}
	
	function logout()
	{
		$this->redirect($this->Auth->logout());
	}
}

?>
