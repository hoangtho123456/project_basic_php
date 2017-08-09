<?php
	if(!defined('IN_SITE'))die('The request not found!');
//Thiết lập font chữ utf8 không bị lỗi font
	header('Content-Type: text/html; charset=utf-8');
	//check permission
	if(!is_supper_admin()){
		redirect(base_url('admin'),array('m'=>'common','a'=>'logout'));
	}
	//user submit form
	if(is_submit('delete_user')){
		//get id and set type
		$id=(int)input_post('user_id');
		
		echo input_post('redirect'); 

		if($id){
			//get user info
			$user=db_get_row(db_create_sql('SELECT * FROM tb_user {where}',array('id'=>$id)));

			//check if admin is delete?
			if($user['username']=='admin'){
				?>
				<script type="text/javascript">
					window.alert("you can not delete admin information!");
					window.location='<?php echo input_post('redirect')?>';
				</script>
				<?php
			}
			else{
				$sql=db_create_sql('DELETE FROM tb_user {where}',array('id'=>$id));
				if(db_execute($sql)){
					?>
	                <script language="javascript">
	                    alert('Xóa thành công!');
	                    window.location = '<?php echo input_post('redirect'); ?>';
	                </script>
                    <?php
				}
				else{
					?>
	                <script language="javascript">
	                    alert('Xóa thất bại!');
	                    window.location = '<?php echo input_post('redirect'); ?>';
	                </script>
	                <?php

				}
			}
		}
	}
	else{
    // Nếu không phải submit delete user thì chuyển về trang chủ
    redirect(base_url('admin'));
	}
?>