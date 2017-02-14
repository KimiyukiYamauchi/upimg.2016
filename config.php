<?php

ini_set('display_errors', 1);
define('MAX_FILE_SIZE', 1 * 1024 * 1024); 		// 1MB
define('THUMBNAIL_WIDTH', 400);
define('IMAGES_DIR', __DIR__ . '/images'); 		// アプロードした画像
define('THUMBNAIL_DIR', __DIR__ . '/thumbs'); // 横幅400の画像 

require_once (__DIR__ . '/functions.php');		// 共通関数の読み込み
