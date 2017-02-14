<?php

namespace MyApp;

class ImageUploader {

	private $_imageFileName;

	public function upload(){
		try {
			// error check
			$this->_validateUpload();

			// type check
			$ext = $this->_validateImageType();

			//var_dump($ext);
			//exit;

			// save
			$this->_save($ext);

			// create thumbnail

		} catch(\Exception $e){
			echo $e->getMessage();
			exit;
		}
		// redirect
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		exit;
	}

	private function _save($ext){
		$this->_imageFileName = sprintf(
															'%s_%s.%s',
															time(),
															sha1(uniqid(mt_rand(), true)),
															$ext
														);
		//var_dump($this->_imageFileName);
		//exit;

		$savePath = IMAGES_DIR . '/' . $this->_imageFileName;
		$res = move_uploaded_file($_FILES['image']['tmp_name'], $savePath);
		if($res === false){
			throw new \Exception('Could not upload!');
		}
	}
	
	private function _validateImageType() {
		$imageType = exif_imagetype($_FILES['image']['tmp_name']);
		switch($imageType) {
			case IMAGETYPE_GIF:
				return 'gif';
			case IMAGETYPE_JPEG:
				return 'jpg';
			case IMAGETYPE_PNG:
				return 'png';
			default:
				throw new \Exception('PNG/JPEG/GIF only!');
		}

	}

	private function _validateUpload() {
		//var_dump($_FILES);
		//exit;

		// アップロード処理が正常に行われたかチェック
		if( !isset($_FILES['image']) || !isset($_FILES['image']['error'])) {
			throw new \Exception('Upload Error!');

		}

		// エラーメッセージのチェック
		switch($_FILES['image']['error']){
			case UPLOAD_ERR_OK:
				return true;
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				throw new \Exception('File too larege!');
			default:
				throw new \Exception('Err: ' . $_FILES['image']['error']);	
		}
	}

}
