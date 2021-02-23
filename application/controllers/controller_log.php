<?php

	class Controller_Log extends Controller
	{
		
		function action_index()
		{
			$this->view->generate('log_view.php', 'template_view.php');
		}
	};

 ?>