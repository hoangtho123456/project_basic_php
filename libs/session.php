<?php session_start();
	if(!defined('IN_SITE'))die('The request not found!');
	//gan function(SET)
	function session_set($key,$value){
		$_SESSION[$key]=$value;
	}

	//lay session GET
	function session_get($key){
		return (isset($_SESSION[$key])?$_SESSION[$key]:false);
	}

	//xoa session
	function session_delete($key){
		if(isset($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
	}
?>