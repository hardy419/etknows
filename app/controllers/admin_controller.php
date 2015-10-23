<?php

class admin_controller extends base_controller
{
	public function exec()
	{
		global $Hardy_config;
		
		if(@$_COOKIE['HardyBBS'] === $Hardy_config['admin'])
		{
			$this->model = Hardy_get_class('usermgr', 'model');
			$this->model->connect();
			if(isset($_GET['delete']))
			{
				$this->model->delete($_GET['delete']);
			}
			
			$this->data['users'] = $this->model->find_all();
			$this->model->close();
			
			$this->data['rootUrl'] = $Hardy_config['base_url'];
			$this->data['admin'] = $Hardy_config['admin'];
			
			$this->view = new Hardy_view('admin');
			$this->view->render($this->data);
		}
		else
		{
			$this->data['message'] = '你无权进行此操作！';
			$this->data['retUrl'] = $Hardy_config['base_url'];
			$this->view = new Hardy_view('message');
			$this->view->render($this->data);
		}
	}
}

?>