<?php
	if(!defined('IN_SITE'))die('The request not found!');
	//bien luu ket noi
	$conn=null;
	//connect function
	function db_connect(){
		global $conn;
		if(!$conn){
			$conn=mysqli_connect('localhost','root','123456','php_example')
			or die("can't not connect database");
			mysqli_set_charset($conn,'utf-8');
		}
	}
	//close connect
	function db_close(){
		global $conn;
		if($conn){
			mysqli_close($conn);
		}
	}
	//ham lay danh sach, ket qua tra ve la cac record trong mot mang
	function db_get_list($sql){
		db_connect();
		global $conn;
		$data=array();
		$result=mysqli_query($conn,$sql);
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}
	//ham lay chi tiet, dung select theo id vi no tra ve 1 record
	function db_get_row($sql){
		db_connect();
		global $conn;
		$result=mysqli_query($conn,$sql);
		$row=array();
		if(mysqli_num_rows($result)>0){
			$row=mysqli_fetch_assoc($result);
		}
		return $row;
	}
	//ham thuc thi cau truy van insert,update,delete
	function db_execute($sql){
		db_connect();
		global $conn;
		return mysqli_query($conn,$sql);
	}
	//ham tao cau truy van them Where
	function db_create_sql($sql,$filter=array()){
		//Chuoi where
		$where='';

		//lap qua bien filter va bo sung vao where
		foreach ($filter as $field => $value) {
			if($value!=''){
				$value=addslashes($value);
				$where.="AND $field ='$value',";
			}
		}
		//REMOVE and in head string
		$where=trim($where,'AND');

		$where=trim($where,', ');

		//nếu có điều kiện where thì nối chuỗi
		if($where){
			$where=' WHERE '.$where;
		}

		return str_replace('{where}', $where, $sql);
	}
	
	function db_insert($table,$data=array()){
		$field="";
		$value="";

		//lap mang du lieu de noi chuoi
		foreach ($data as $field => $value) {
			$field.=$field.',';
			$value.="'".addslashes($value)."',";
		}
		//xoa ky tu,noi chuoi
		$field=trim($field,',');
		$value=trim($value,',');

		//
		$sql="INSERT INTO {$table}($field) VALUES ({$value})";
		return db_execute($sql);
	}	
?>

<!--echo db_create_sql("SELECT * FROM tb_user {where}", array('id' => '1'));
SELECT * FROM tb_user WHERE id = '1'
-->