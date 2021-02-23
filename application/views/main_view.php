<?php 
	$_SESSION['auth'] = false;
 ?>
<div class="container">
	<h1>Добро пожаловать на сайт Галерея!</h1> 
	<div class="row">
		<p>
		Просмотривать изображения и комментарии могут все пользователи!
		</p>

		<p>
			Для добавления изображения и комментариев необходимо авторизоваться на сайте! 
		</p>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<Button type="button" class="btn btn-outline-warning"><a href="/log">Авторизация!</a></Button>
		</div>
		<div class="col-sm-4">
			<Button  type="button" class="btn btn-outline-warning"><a href="/form">Регистрация!</a></Button>
		</div>
		<div class="col-sm-4">
			<Button type="button" class="btn btn-outline-warning"><a href="/download">Зайти как гость!</a></Button>
		</div>
	</div>
</div>




