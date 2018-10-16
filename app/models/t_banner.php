<?php
namespace app\models;
Class t_banner extends \app\core\Model
{
	public function imgURL()
	{
		return '/images/slider/'.$this->img;
	}
}