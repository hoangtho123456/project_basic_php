<?php
	$error=array();
	//b1: if admin,redirect
	if (is_admin()) {
		redirect(base_url('admin/?m=common&a=dashboard'));
	}
	//b2:if user submit form
	if(is_submit('login')){
		//get username and pass
		$username=input_post('username');
		$password=input_post('password');
		//check user name
		if (empty($username)) {
			$error['username']='you must press your username';
		}
		if (empty($password)) {
			$error['password']='you must press your password';
		}

		//if not error
		if(!$error){
			//include file xu ly database
			include_once('database/user.php');
			//get info follow username
			$user=db_user_get_by_username($username);
			//if not result
			if(empty($user)){
				$error['username']='user name is wrong';
			}
			//if has a result but pass wrong
			elseif ($user['password']!=md5($password)) {
				$error['password'] = 'your password is not true';
			}
			if(!$error){
				set_logged($user['username'],$user['level']);
				redirect(base_url('admin/?m=common&a=dashboard'));
			}
		}
	}
?>
<?php
	if(!defined('IN_SITE'))die('The request not found!');
	include_once('widgets/header.php');
	?>

<h1>Trang đăng nhập</h1>
<form method="post" action="<?php echo base_url('admin/?m=common&a=login'); ?>">
	<table>
		<tr>
			<td>UserName</td>
			<td><input type="text" name="username" value=""/>
			<?php show_error($error,'username'); ?>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" value=""/>
				<?php show_error($error,'password'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="hidden" name="request_name" value="login"/>
			</td>
			<td><input type="submit" name="login-tbn" value="Log In"></td>
		</tr>
	</table>
</form>
<?php include_once('widgets/footer.php');?>