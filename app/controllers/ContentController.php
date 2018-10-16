<?php
namespace app\controllers;
use \app\models as models;
use \app\core\Html;
use \app\core\factory;
class ContentController extends \app\core\Controller{
	public function __construct()
	{
		parent::__construct();
		\app\core\day_user::checkUser();
	}

	public function actionIndex() 
	{
		$banners 	= 	factory::add("t_banner")->	getAllByParam('status',1);
		$girls 		= 	factory::add("t_girls")->	getAllByParam('status',1);
		$afishes 	= 	factory::add("t_afisha")->	getAllByParam('status',1,9);
		$this->view->render("landing.php","header.php",array(
			'banners'=>$banners,
			'girls'=>$girls
		));
	}	
}