<?php
	if(!defined('IN_SITE'))die('The request not found!');
	function db_user_get_by_username($username){
		$username=addslashes($username);
		$sql="SELECT * FROM tb_user WHERE username='$username'";
		return db_get_row($sql);
	}
	//validate db user
	function db_user_validate($data){
		//Bien chua loi
		$error=array();

		//username
		if (isset($data['username'])&& $data['username']=='') {
			$error['username']='you still not enter username';
		}

		//email
		if (isset($data['email'])&& $data['email']=='') {
			$error['email']='you still not enter email';
		}
		if (isset($data['email']) && filter_var($data['email'],FILTER_VALIDATE_EMAIL)===false) {
			$error['email']='email is not correct';
		}

		//password
		if (isset($data['password']) && $data['password'] == ''){
        $error['password'] = 'you still not enter password';
    	}

    	//re-password
    	if (isset($data['password'])&& isset($data['re-password']) && $data['password']!=$data['re-password']) {
    		$error['re-password']='re-password is not equal';
    	}

    	//level
    	if (isset($data['level'])&& !in_array($data['level'], array('1','2'))) {
    		$error['level'] = 'Level bạn chọn không tồn tại';
    	}

    	/* VALIDATE LIÊN QUAN CSDL */
    	//user name
    	if (!($error) && isset($data['username']) && $data['username']){
    		$sql="SELECT count(id) as counter FROM tb_user WHERE username='".addslashes($data['username'])."'";
    		$row=db_get_row($sql);
    		if ($row['counter']>0) {
    			$error['username'] = 'User name was exist';
    		}
    	}

    	//email
    	if (!($error)&& isset($data['email'])&& $data['email']) {
    		$sql="SELECT count(id) as counter FROM tb_user WHERE email='".addslashes($data['email'])."'";
    		$row=db_get_row($sql);
    		if ($row['counter']>0) {
    			$error['email']='Email was exist';
    		}
    	}
    	return $error;
	}
	?>

