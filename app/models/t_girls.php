<?php
namespace app\models;
Class t_girls extends \app\core\Model
{
	public function imgURL()
	{
		return '/images/girls/'.$this->img;
	}
}