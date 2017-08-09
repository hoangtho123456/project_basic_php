<?php
	if(!defined('IN_SITE'))die('The request not found!');
	//function create URL
	function base_url($uri=''){
		return 'http://localhost/projectPHP_BASIC/'.$uri;
	}
	//function redirect
	function redirect($url){
		header("Location:{$url}");
		exit();
	}

	//function get value from Post
	function input_post($key){
		return isset($_POST[$key])?trim($_POST[$key]):false;
	}
	//function get value from get
	function input_get($key){
		return isset($_GET[$key])?trim($_GET[$key]):false;
	}
	//FUNCTION check submit
	function is_submit($key){
		return (isset($_POST['request_name'])&& $_POST['request_name']==$key);
	}//key mac dinh la request-name request_name .<input type="hidden" name="request_name" value="login"/>

	// Hàm show error
	/*function show_error($error, $key){
    	echo '<span style="color:red;">'.(empty($error[$key])?"":$error[$key]).'</span>';
	}*/
	function show_error($error,$key){
		echo '<span style="color:red;">'.(empty($error[$key])?"":$error[$key]).'</span>';
	}
	//create query string
	
	function create_link($uri,$filter=array()){
	 	$string='';
	 	foreach ($filter as $key => $val) {
	 		if($val!=''){
	 			$string.="&{$key}={$val}";
	 		}
	 	}
	 	return  $uri .($string?'?'.ltrim($string,'&'):'');
	 }
	 //ham phan trang
	function paging($link,$total_records,$current_page,$limit){
	 	//tinh tong so phan trang
	 	$total_page=ceil($total_records/$limit);

	 	//gioi han current_page trong khoang tu 1 den total page
	 	if($current_page>$total_page){
	 		$current_page=$total_page;
	 	}
	 	else if($current_page<1){
	 		$current_page=1;
	 	}

	 	//tim start
	 	$start=($current_page-1)*$limit;

	 	$html='';

	 	//neu current_page >1 va total_page>1 hien thi prev
	 	if($current_page>1 && $total_page>1){
	 		$html.='<a href="'.str_replace('{page}', $current_page-1, $link).'">Prev</a>';
	 	}

	 	for ($i=1; $i<=$total_page ; $i++) { 
	 		//neu la trang hien tai thi hien thi the span,khong thi the a
	 		if ($i==$current_page) {
	 			$html.='<span>'.$i.'</span>';
	 		}
	 		else{
	 			$html.='<a href="'.str_replace('{page}', $i, $link).'">'.$i.'</a>';
	 		}
	 	}
	 	//neu current_page <total_page va total_page>1 hien thi next
	 	if($current_page<$total_page && $total_page>1){
	 		$html.='<a href="'.str_replace('{page}', $current_page+1, $link).'">Next</a>';
	 	}
	 	//result
	 	return array(
	 		'start'=>$start,
	 		'limit'=>$limit,
	 		'html'=>$html
	 		);
	 }
	/*$link=create_link(base_url('admin'),array(
		'm'=>'user',
		'a'=>'list',
		'page'=>'{page}',
		'username'=> $filter['username']
		));	 

	//paging
	$paging=paging($link,1000,2,10);*/
?>
