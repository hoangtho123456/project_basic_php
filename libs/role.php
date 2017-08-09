<?php
	if(!defined('IN_SITE'))die('The request not found!');
	//ham thiet lap la da dang nhap
	function set_logged($username,$level){
		session_set('ss_user_token',array(
			'username'=>$username,
			'level'=>$level
		));
	}

	//dang xuat
	function set_logout(){
		session_delete('ss_user_token');
	}

	//ham kiem tra trang thai nguoi dung da dang nhap hay chua?
	function is_logged(){
		$user=session_get('ss_user_token');
		return $user;
	} 

	//ham kiem tra co phai admin
	function is_admin(){
		$user=is_logged();
		if(!empty($user['level'])&& $user['level']=='1'){
			return true;
		}
		return false;
	}
	//get user current
	function get_current_username(){
		$user=is_logged();
		return (isset($user['username'])?$user['username']:'');
	}
	//get level current
	function get_current_level(){
		$user=is_logged();
		return (isset($user['level'])?$user['level']:'');
	}
	//function check if is supper_admin
	function is_supper_admin(){
		$user=is_logged();
		if(!empty($user['level']) && $user['level']==1 && $user['username']=='admin'){
			return true;
		}
		return false;
	}
?>