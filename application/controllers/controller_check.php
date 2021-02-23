<?php

	class Controller_Check extends Controller
	{
		
		function action_index()
		{
			$this->view->generate('check_view.php', 'template_view.php');
		}
	};

 ?>