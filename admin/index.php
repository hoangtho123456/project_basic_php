<?php
	//dinh nghia hang so bao ve project
	define("IN_SITE", true);

	//lay module va action tren url
	$module=isset($_GET['m'])? $_GET['m']:'';
	$action=isset($_GET['a'])?$_GET['a']:'';

	//truong hop nguoi dung khong truyen module va action
	//lay module mac dinh la common
	//va action mac dinh la login
	if(empty($module)||empty($action)){
		$module='common';
		$action='login';
	}

	//Tao duong dan va luu vao bien patch
	$path='modules/'.$module.'/'.$action.'.php';
	//truong hop url chay dung
	if(file_exists($path)){
		include_once('../libs/session.php');
		include_once('../libs/role.php');
		include_once('../libs/helper.php');
		include_once('../libs/database.php');
		include_once($path);
	}
	else{
		//khong ton tai thi thong bao loi
		include_once('modules/common/404.php');
	}
?>