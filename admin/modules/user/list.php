<?php
	if(!defined('IN_SITE'))die('The request not found!');
	//check user permission,if not admin -> return logout page
	if(!is_admin()){
		redirect(base_url('admin'),array('m'=>'common','a'=>'logout'));
	}
?>
<?php include_once('widgets/header.php');?>

<?php // VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG 
	//total_records
	$sql=db_create_sql('SELECT count(id) as counter from tb_user {where}');
	$result=db_get_row($sql);
	$total_records=$result['counter'];

	//get current page
	$current_page=input_get('page');
	//input_get('page');
	//lấy limit
	$limit=10;

	//get link
	$link=create_link(base_url('admin'),array(
		'm'=>'user',
		'a'=>'list',
		'page'=>'{page}'
		));
	//phân trang
	$paging=paging($link,$total_records,$current_page,$limit);

	//get list user
	$sql=db_create_sql("SELECT * FROM tb_user {where} LIMIT {$paging['start']},{$paging['limit']}");
	$users=db_get_list($sql);
?>
 
<h1>Danh sách thành viên</h1>
<div class="controls">
    <a class="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'add')); ?>">Thêm</a>
</div>
<table cellspacing="0" cellpadding="0" class="form">
    <thead>
        <tr>
            <td>Username</td>
            <td>Email</td>
            <?php if(is_supper_admin()){ ?>
			<td>Action</td>
			<?php }?>
        </tr>
    </thead>
    <tbody>
		<!--// VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG-->
        <?php  foreach ($users as $item) {?>
		<tr>
			<td><?php echo $item['username']; ?></td>
			<td><?php echo $item['email'];  ?></td>
			<?php if(is_supper_admin()){ ?>
			<td>
				<form method="POST" class="form-delete" action="<?php echo create_link(base_url('admin/index.php'),array('m'=>'user', 'a'=>'delete')); ?>">
					<a href="<?php echo create_link(base_url('admin'),array('m' => 'user', 'a' => 'edit', 'id' => $item['id']));?>">Edit</a>
					<input type="hidden" name="user_id" value="<?php echo $item['id']; ?>"/>
		            <input type="hidden" name="request_name" value="delete_user"/>
		            <a href="#" class="btn-submit">Delete</a>
				</form>
			</td>
			<?php }?>
		</tr>
		<?php }?>
    </tbody>
</table>
 
<div class="pagination">
    <?php // VỊ TRÍ 03: CODE HIỂN THỊ CÁC NÚT PHÂN TRANG 
		echo $paging['html'];
	?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//Nếu người dùng click vào nút delete thì submit form
		$('.btn-submit').click(function(){
			$(this).parent().submit();
			return false;
		});

		//nếu submit form thì hỏi người dùng có chắc hay không
		$('.form-delete').submit(function(){
			if(!confirm("Bạn có chắc muốn xóa thành viên này không?")){
				return false; 
			}
			//nếu người dùng muốn xóa thì thêm vào form một input hidden có gtri là
			//url hiện tại ,trang delete sẽ lấy url này để chuyển hướng trở lại sau khi xóa
			$(this).append('<input type="hidden" name="redirect" value="'+window.location.href+'"/>');

			//thực hiện xóa
			return true;
		});
	});
</script>
<?php include_once('widgets/footer.php');?>