<?php 
$errors = [];
$messages = [];

if (!empty($_FILES)) {
	
	for ($i=0; $i < count($_FILES['files']['name']) ; $i++) {

		$fileName = $_FILES['files']['name'][$i];

		if ($_FILES['files']['size'][$i] > UPLOAD_MAX_SIZE) {
			$errors[] = 'Недопустимый размер файла ' . $fileName;
			continue;
		};

		if (!in_array($_FILES['files']['type'][$i], ALLOWED_TYPES)) {
         $errors[] = 'Недопустимый формат файла ' . $fileName;
         continue;
      }

		$filePath = UPLOAD_DIR . '/' . basename($fileName);
		
		if (!move_uploaded_file($_FILES['files']['tmp_name'][$i], $filePath)) {
			$errors[] = 'Ошибка загрузки файла' . $fileName;
			continue;
		}
	}

	if (empty($errors)) {
		$messages = 'Файлы были загружены';
	}
};

if (!empty($_POST['name'])) {

	$filePath = UPLOAD_DIR . '/' . $_POST['name'];
	$commentPath = COMMENT_DIR . '/' . $_POST['name'] . '.txt';

	unlink($filePath);

	if (file_exists($commentPath)) {
		unlink($commentPath);
	}

	$messages[] = 'Файл был удален';
};

$files = scandir(UPLOAD_DIR);
$files = array_filter($files, function ($file) {
	return !in_array($file, ['.', '..', '.gitkeep']);
});

?>
