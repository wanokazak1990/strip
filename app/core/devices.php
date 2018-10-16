<?php
namespace app\core;
Class devices extends \app\core\Model 
{
	public static function regDevice()
	{
		$mobile = new \Mobile_Detect();
		if ($mobile->isMobile()) {
 			$type = "mobile";
		}
		else{
			$type = "pc";
		}
		$device = new \app\core\devices();
		$device->getRowByParam('type',$type);
		if($device->id)
		{
			$device->number++;
			$device->updateData();
			return;
		}
		else
		{
			$device->number = 1;
			$device->type = $type;
			$device->insertData();
		}
		return;
	}

	
}