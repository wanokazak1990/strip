<?php
namespace app\core;
Class day_user extends \app\core\Model 
{
	public static function checkUser()
	{
		if(!isset($_SESSION['user']))
		{
			$_SESSION['user'] = "1";
			$counter = new \app\core\day_user();
			$counter->getRowByParam('day',strtotime(date('d-m-Y')));
			if($counter->id)
			{
				$counter->usercount++;
				$counter->updateData();
				\app\core\devices::regDevice();
			}
			else{
				$counter->usercount=1;
				$counter->day = strtotime(date('d-m-Y'));
				$counter->insertData();
			}
			return "set_session";
		}
		return "active_session";
	}

	public static function nowUsers()
	{
		$us = new \app\core\day_user();
		$us->getRowByParam('day',strtotime(date("d-m-Y")));
		return $us;
	}
	public static function yesterdayUsers()
	{
		$us = new \app\core\day_user();
		$us->getRowByParam('day',strtotime(date("d-m-Y", microtime(true)-(60*60*24))));
		return $us;
	}
	public static function totalusers()
	{
		$us = new \app\core\day_user();
		$sql = "SELECT sum(usercount) as summa FROM {$us->table}";
		$data = $us->getCustomSQLNonClass($sql);
		if($data)
		{
			$us->usercount = $data[0]['summa'];
		}
		return $us;
	}
}