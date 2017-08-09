<?php
	if(!defined('IN_SITE'))die('The request not found!');
?>
<?php 
	//check permission
	if (!is_admin()) {
		redirect(base_url('admin'),array('m'=>'common','a'=>'logout'));
	}
?>
<?php
	$error=array();
	
	//CODE SUBMIT FORM
// Nếu người dùng submit form
	if(is_submit('add_user'))
	{
	    // Lấy danh sách dữ liệu từ form
	    $data = array(
	        'username'  => input_post('username'),
	        'password'  => input_post('password'),
	        're-password'  => input_post('re-password'),
	        'email'     => input_post('email'),
	        'fullname'  => input_post('fullname'),
	        'level'     => input_post('level'),
	    );
	    $data1 = array(
	        'username' => 'DANGHOANGT',
	        'password' => '123',
	        're-password' => '123',
	        'email'     => 'thyhuynh@gmail.com',
	        'fullname'  => 'dangddd',
	        'level'     => "2",
	    );
	     //echo $data['username'].'<br>';
	    // require file xử lý database cho user
	    require_once('database/user.php');
	     
	    // Thực hiện validate
	    //$error = db_user_validate($data);
	    $error = db_user_validate($data);
/*	     
	     if(!$error){
	     	unset($data1['re-password']);
	     	db_insert('tb_user',$data1);
			//db_insert('tb_user',$data1);
			?>
			<script>
					//alert('Add user success!');
				window.location = '<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>';
	     	</script>
	     	<?php
	     }
*/
	    // Nếu validate không có lỗi
	    if (!$error)
	    {
	        // Xóa key re-password ra khoi $data
	        unset($data['re-password']);
	         
	        // Nếu insert thành công thì thông báo
	        // và chuyển hướng về trang danh sách user
	        if (db_insert('tb_user',$data)){
	            ?>
	            <script>
	                alert('Add user success!');
	                window.location = '<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>';
	            </script>
	            <?php
	            die();
	        }
	        else echo "???????";
	    }
	   else {
	   		echo show_error($error,'email');
	   		echo show_error($error,'username');
	   		echo show_error($error,'fullname');
	   		echo show_error($error,'level');
	   		echo show_error($error,'password');
	   		echo "????";
	   };
	}	
	//else echo "???????";
?>
<?php include_once('widgets/header.php');?>
<h1>Add Member</h1>

<div class="controls">
	<a href="#" class="button" onclick="$('#mainform').submit()">Save</a>
	<a href="<?php echo create_link(base_url('admin'),array('m'=>'user','a'=>'list'));?>" class="button">Back</a>
</div>

<form id="mainform" method="post" action="<?php echo create_link(base_url('admin/index.php'),array('m'=>'user','a'=>'add'));?>">
	<input type="hidden" name="request_name" value="add_user" />
	<table cellspacing="0" cellpadding="0" class="form">
		<tr>
			<td >User name</td>
			<td>
				<input type="text" name="username" value="<?php echo input_post('username'); ?>"/>
				<?php show_error($error,'username')?>
			</td>
		</tr>
		<tr>
            <td>password</td>
            <td>
                <input type="password" name="password" value="<?php echo input_post('password'); ?>" />
                <?php show_error($error, 'password'); ?>
            </td>
        </tr>
        <tr>
            <td>Re_password</td>
            <td>
                <input type="password" name="re-password" value="<?php echo input_post('re-password'); ?>" />
                <?php show_error($error, 're-password'); ?>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="text" class="long" name="email" value="<?php echo input_post('email'); ?>"  />
                <?php show_error($error, 'email'); ?>
            </td>
        </tr>
        <tr>
            <td>Fullname</td>
            <td>
                <input type="text" class="long" name="fullname" value="<?php echo input_post('fullname'); ?>" />
                <?php show_error($error, 'fullname'); ?>
            </td>
        </tr>
		<tr>
			<td>Level</td>
			<td>
				<select name="level">
					<option value="">--Level--</option>
					<option value="1" <?php echo (input_post('level')==1)?'selected':''; ?> >Admin</option>
					<option value="2" <?php echo (input_post('level')==2)?'selected':''; ?> >Member</option>
				</select>
				<?php show_error($error,'level')?>
			</td>
		</tr>
	</table>
</form>

<?php include_once('widgets/footer.php');?>