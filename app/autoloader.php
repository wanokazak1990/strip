<?php
namespace autoloader;
Class autoloader
{
	public function __construct() {
		spl_autoload_register(function($class_name) {
			$classPath = \explode('\\',$class_name);
			if(count($classPath)>1)
			{
				$input = array_pop($classPath).'.php';
				$classPath[] = $input;
				$path = implode('/',$classPath);
				if(\file_exists($path))
				{
					include_once $path;
					return true;
				}
				return false;
			}
			
			else{
				$class = $classPath[0];
				$array_path = array(
					'/app/components/mobile_detect/',
					'/app/components/PDF/dompdf/include/',
					'/app/components/PDF/dompdf/lib/',
					'/app/components/PDF/dompdf/lib/fonts/',
					'/app/components/PDF/dompdf/lib/html5lib/',
					'/app/components/PDF/dompdf/lib/php-font-lib/',
					'/app/components/QR/'
				);
				
				foreach($array_path as $path){
					$path = ROOT.$path.$class.'.php';
					if(is_file($path)) {
						include_once ($path);	
						return true;
					}	
				}
			}
		});
	}
}
