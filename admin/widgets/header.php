<?php if(!defined('IN_SITE'))die('The request not found!'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản lý Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
</head>
<style type="text/css">
	.button{
		padding:10px 10px;
		margin-right: 20px;
		border: solid 1px green;
	}
	.form input.long[type="text"]{
	    width: 400px;
	}
	#header{
		overflow: hidden;
	}
	#header div{
		float: right;
		width: 250px;
		line-height: 50px;
	}
	#header ul{
		width: 700px;
		float: left;
	}
	#header li{
		float: left;
		list-style-type: none;
		background-color: blue;
		padding:10px 10px;
		margin-right: 20px;
		border: solid 1px green;   
	}
	#header ul li a{
		color:#fff;
		text-decoration: none;
	}
	#container{
		width: 100%;
		margin:0px auto;
		overflow: hidden;
	}
	#body{
		background:#acacac;
		margin:0;
		padding: 0;
	}
	#content{
                border-top: solid 1px #ddd;
                min-height: 600px;
                padding: 10px 30px;
            }
	.pagination a
	{
                display: inline-block;
                padding: 3px 5px;
                background: green;
                color: #fff;
                text-decoration: none;
                margin-top: 10px;
     }
    .pagination a, .pagination span{
    	margin-right: 3px;
	}
	.pagination span{
	    display: inline-block;
	    padding: 3px 5px;
	    background: gray;
	    color: #fff;
	    text-decoration: none;
	    margin-top: 10px;
	}
	table.form{
	    width: 100%;
	}
	table.form td{
	    border: solid 1px #ddd;
	    padding: 5px 10px;
	}
	table.form thead{
	    font-weight: bold;
	}
	.controls{
	    margin: 10px 0px;
	    text-align: right;
	}
</style>
<body>
	<div id="container">
		<?php if(is_admin()){ ?>
		<div id="header">
			<ul>
				<li>
					<a href="<?php echo create_link(base_url('admin'),array('m'=>'user','a'=>'list'));?>">User</a>
				</li>
				<li>
					<a href="#">Tin tức</a>
				</li>
				<li>
					<a href="#">Bình luận</a>
				</li>
			</ul>
			<div>
				Xin chào <?php echo get_current_username(); ?> |
				<a href="<?php echo base_url('admin/?m=common&a=logout')?>">LogOut</a>
			</div>	
		</div>
		<?php }?>
		<div id="content">
			
		


