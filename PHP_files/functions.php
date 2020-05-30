<?php
//连接数据库，参数为用户名和密码
function dbconnect($uid, $pwd) {
	$serverName = "localhost";//数据库服务器地址
	//$uid:数据库用户名,$pwd:数据库密码
	//连接数据库
	$con = mysql_connect($serverName, $uid, $pwd) or die('DataBase not connect:' . mysql_error());
	mysql_select_db("organization0406", $con);
	/*//验证是否连接成功
	 if(!$con) echo "Error !";
	 else echo "Ok!";*/
}

//验证权限并登陆
function powerconn($power){
	if (!session_id()) {
		session_start();
	}
	switch($power){
		case 1:
			dbconnect("normal_user","normal");
			break;
		case 2:
			dbconnect("manager","manager");
			break;
		case 3:
			dbconnect("manager","manager");
			break;
		default:
			dbconnect("root","");
			break;
	}	
}


//整理输入的数据
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//判断学号是否存在
function IfExistOrNot($data){
	$sql = "SELECT * FROM member WHERE stuID = '".$data."'"; 
	$result = mysql_query($sql);    
	$row = mysql_fetch_array($result); 
	
	/* //调试
	var_dump($row);
	echo $sql.'</br>'; //查询语句
	$num_rows = mysql_num_rows($result);
	echo $num_rows.'</br>';     //结果数   
	echo empty($row).'</br>';*/
	
    if (empty($row)){
    	 return $data; //查询不到数据，不存在该学号
    }else{
		  $data = ""; //该学号已注册
    }  
}

//判断组织号是否存在
function IfExistOrNot_organID($data){
	$sql = "SELECT * FROM organ WHERE organID = '".$data."'"; 
	$result = mysql_query($sql);    
	$row = mysql_fetch_array($result); 
    if (empty($row)){
    	 return $data;//查询不到数据，不存在该学号
    }else{
		  $data = ""; //该学号已注册
    }  
}


//判断社团号是否存在
function IfExistOrNot_clubID($data){
	$sql = "SELECT * FROM club WHERE clubID = '".$data."'"; 
	$result = mysql_query($sql);    
	$row = mysql_fetch_array($result); 
    if (empty($row)){
    	 return $data;//查询不到数据，不存在该学号
    }else{
		  $data = ""; //该学号已注册
    }  
}


//判断参赛编号是否存在
function IfExistOrNot_camID($data){
	$sql = "SELECT * FROM campaign WHERE campaignID = '".$data."'"; 
	$result = mysql_query($sql);    
	$row = mysql_fetch_array($result); 
    if (empty($row)){
    	 return $data;//查询不到数据，不存在该学号
    }else{
		  $data = ""; //该学号已注册
    }  
}




?>




















