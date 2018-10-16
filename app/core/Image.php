<?php
namespace app\core;
Class Image
{

	public $image;
   	public $image_type;

	public function canUpload($data, $path){
		$data = (object)$data;
		if($data->name == '') return false;
		if($data->size == 0) return false;

		$getMime = explode('.', $data->name);
		$mime = strtolower(end($getMime));
		$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg', 'pdf','txt');

		if(!in_array($mime, $types)) return false;
		
		return $this->make_upload($data, $path);
	}

	public function make_upload($data, $path){	
		// формируем уникальное имя картинки: случайное число и name
		
		$filename=ROOT.$path;
		//echo $filename;
		if (!file_exists($filename)) {
			umask(0);
			mkdir($filename, 0777, true);
			umask(0);
		}

		$data->name = date('d-m')."_".rand(1,1000)."_".$data->name;
		$name = $data->name;
		$current_path=$filename.'/'.$name;
		
		if(copy($data->tmp_name, $current_path)) return $path.'/'.$name;
		
		return false;
	}

	public static function getImgList($path)
	{
		if(!empty($path)) :
			$data = NULL;
			
			if(!is_dir($path)) return array('Не существует каталога');
			$files = scandir($path);
			if(!is_array($files)) return array('Каталог пуст');
			$skip = array('.', '..');
			foreach ($files as $key => $value) :
				if(!in_array($value, $skip))
				{
					$data[] = $path.'/'.$value;
				}
			endforeach;
			/*если фаилы обнаруженны*/
			if(!empty($data)) return $data;
			/*иначе ложь*/
			return array('Не обнаруженнл');
		endif;
		return array('Отрицательно');
	}

	public static function deleteImage($img)
	{
		if(is_file(ROOT.$img))
			unlink(ROOT.$img);
	}

	public static function deleteCatalog($path)
	{
		if(file_exists(ROOT.'/'.$path)) ://проверяем есть ли каталог
			if(!empty($path)) : //на всякий случай на пустоту относительного адреса
				$files = new \RecursiveDirectoryIterator(ROOT.'/'.$path); //получаем фаилы
				foreach($files as $file){
					@unlink($file->getRealPath());
				}
				rmdir(ROOT.'/'.$path);
			endif;
		endif;
	}


	public function load($filename) {
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		if( $this->image_type == IMAGETYPE_JPEG ) {
			$this->image = imagecreatefromjpeg($filename);
		} elseif( $this->image_type == IMAGETYPE_GIF ) {
		 	$this->image = imagecreatefromgif($filename);
		} elseif( $this->image_type == IMAGETYPE_PNG ) {
		 	$this->image = imagecreatefrompng($filename);
		}
   	}

   	public function save($filename, $image_type=IMAGETYPE_JPEG, $compression=85, $permissions=null) {
		if( $image_type == IMAGETYPE_JPEG ) {
		 	imagejpeg($this->image,$filename,$compression);
		} elseif( $image_type == IMAGETYPE_GIF ) {
		 	imagegif($this->image,$filename);
		} elseif( $image_type == IMAGETYPE_PNG ) {
		 	imagepng($this->image,$filename);
		}
		if( $permissions != null) {
		 	chmod($filename,$permissions);
		}
   	}
	public function output($image_type=IMAGETYPE_JPEG) {
		if( $image_type == IMAGETYPE_JPEG ) {
		 imagejpeg($this->image);
		} elseif( $image_type == IMAGETYPE_GIF ) {
		 imagegif($this->image);
		} elseif( $image_type == IMAGETYPE_PNG ) {
		 imagepng($this->image);
		}
	}
	public function getWidth() {
	  	return imagesx($this->image);
	}
	public function getHeight() {
	  	return imagesy($this->image);
	}
	public function resizeToHeight($height) {
		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width,$height);
	}
   	public function resizeToWidth($width) {
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resize($width,$height);
   	}
   	public function scale($scale) {
		$width = $this->getWidth() * $scale/100;
		$height = $this->getheight() * $scale/100;
		$this->resize($width,$height);
   	}
	public function resize($width,$height) {
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}
}