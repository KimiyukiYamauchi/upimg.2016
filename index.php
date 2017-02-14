<?php

require_once (__DIR__ . '/config.php'); 
require_once (__DIR__ . '/ImageUploader.php');

if(!function_exists('imagecreatetruecolor')){
	echo 'GD not installed';
	exit;
}

$uploader = new \MyApp\ImageUploader();

if($_SERVER['REQUEST_METHOD'] === 'POST'){ // 画像がアップされた?
	$uploader->upload();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Image Uploader</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo h(MAX_FILE_SIZE); ?>">
	<input type="file" name="image">
	<input type="submit" value="upload">
</form>
	
</body>
</html>
