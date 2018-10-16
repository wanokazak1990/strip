<?php
namespace app\core;

Class factory
{
	public function add($class)
	{
		$object = '\\app\\models\\'.$class;
		return new $object;
	}
}