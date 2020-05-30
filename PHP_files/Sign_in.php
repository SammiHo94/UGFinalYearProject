<?php
	session_start();    //在session之前不能有任何输出哦,在php.5以下的版本会有问题.
	require "functions.php";
	powerconn("");
	header("Content-Type: text/html;charset=utf-8"); 


$checknum = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	switch ($_POST["power_name"])
	{
		case 1:
			if (empty($_POST["stuID"])) {
				echo ' <script type="text/javascript" charset="utf-8">alert("账号不能为空");history.back();</script>';
				$checknum = 1;
				exit();
			}elseif(preg_match("/^[0-9]{12}$/",$_POST["stuID"])){
				$IDExist = IfExistOrNot($_POST["stuID"]);
				if(!empty($IDExist)){
					echo ' <script type="text/javascript" charset="utf-8">alert("该账号未注册");history.back();</script>';
					$checknum = 1;
					exit();
				}else{
					$stuID = test_input($_POST["stuID"]) ;
				}   
			}else{
				echo ' <script type="text/javascript" charset="utf-8">alert("账号为12位数字");history.back();</script>';
				$checknum = 1; 
				exit();  
			}
	
			//验证密码
			if (empty($_POST["PW"])) {
				echo '<script type="text/javascript" charset="utf-8">alert("密码不能为空");history.back();</script>';
				$checknum = 1;
				exit();
			} else {
				$password = test_input($_POST["PW"]);
			}
			
			/*//测试传入值
			echo $stuID."<br />";
			echo $password."<br />";*/
		
		
			//开始查询
			if($checknum ==0){
				$sql = "select * from member where stuID = '".$stuID."' and PW = '".$password."'";
				//echo $sql;
				$result = mysql_query($sql);    
				$row = mysql_fetch_array($result); 
				
				/* //调试
				var_dump($row);
				echo $sql.'</br>'; //查询语句
				$num_rows = mysql_num_rows($result);
				echo $num_rows.'</br>';     //结果数   
				echo empty($row).'</br>';*/
				
			    if (empty($row)){     //查询不到数据，不存在该学号
			    	 echo ' <script type="text/javascript" charset="utf-8">alert("你输入的账号与密码不一致！");history.back();</script>';
					  exit();  
			    }else{	
					$_SESSION['uid'] = $row["stuname"];
					$_SESSION['power']= "1";  //设置用户组的权限
					$_SESSION['stuID']= $row["stuID"];
					header("location: http://localhost/Organization/about/myself.html"); 
			    }  
			}
			break;
		
		
		case 2:
			if (empty($_POST["stuID"])) {
				echo ' <script type="text/javascript" charset="utf-8">alert("账号不能为空");history.back();</script>';
				$checknum = 1;
				exit();
				}elseif(preg_match("/^[0-9]{3}$/",$_POST["stuID"])){
				$IDExist = IfExistOrNot_organID($_POST["stuID"]);
				if(!empty($IDExist)){
					echo ' <script type="text/javascript" charset="utf-8">alert("该账号未注册");history.back();</script>';
					$checknum = 1;
					exit();
				}else{
					$stuID = test_input($_POST["stuID"]) ;
				}   
			}else{
				echo ' <script type="text/javascript" charset="utf-8">alert("账号格式不对");history.back();</script>';
				$checknum = 1; 
				exit();  
			}
	
			//验证密码
			if (empty($_POST["PW"])) {
				echo '<script type="text/javascript" charset="utf-8">alert("密码不能为空");history.back();</script>';
				$checknum = 1;
				exit();
			} else {
				$password = test_input($_POST["PW"]);
			}
			
			/*//测试传入值
			echo $stuID."<br />";
			echo $password."<br />";*/
		
		
			//开始查询
			if($checknum ==0){
				$sql = "select * from organ where organID = '".$stuID."' and PW = '".$password."'";
				//echo $sql;
				$result = mysql_query($sql);    
				$row = mysql_fetch_array($result); 
				
				/* //调试
				var_dump($row);
				echo $sql.'</br>'; //查询语句
				$num_rows = mysql_num_rows($result);
				echo $num_rows.'</br>';     //结果数   
				echo empty($row).'</br>';*/
				
			    if (empty($row)){     //查询不到数据，不存在该学号
			    	 echo ' <script type="text/javascript" charset="utf-8">alert("你输入的账号与密码不一致！");history.back();</script>';
					  exit();  
			    }else{	
					$_SESSION['uid'] = $row["organname"];
					$_SESSION['power']= "2";  //设置用户组的权限
					$_SESSION['organID']= $row["organID"];
					header("location: http://localhost/Organization/about/myself.html"); 
			    }  
			}
			break;
			
		case 3:
			if (empty($_POST["stuID"])) {
				echo ' <script type="text/javascript" charset="utf-8">alert("账号不能为空");history.back();</script>';
				$checknum = 1;
				exit();
			}elseif(preg_match("/^[0-9]{3}$/",$_POST["stuID"])){
				$IDExist = IfExistOrNot_clubID($_POST["stuID"]);
				if(!empty($IDExist)){
					echo ' <script type="text/javascript" charset="utf-8">alert("该账号未注册");history.back();</script>';
					$checknum = 1;
					exit();
				}else{
					$stuID = test_input($_POST["stuID"]) ;
				}   
			}else{
				echo ' <script type="text/javascript" charset="utf-8">alert("账号格式不对");history.back();</script>';
				$checknum = 1; 
				exit();  
			}
	
			//验证密码
			if (empty($_POST["PW"])) {
				echo '<script type="text/javascript" charset="utf-8">alert("密码不能为空");history.back();</script>';
				$checknum = 1;
				exit();
			} else {
				$password = test_input($_POST["PW"]);
			}
			
			/*//测试传入值
			echo $stuID."<br />";
			echo $password."<br />";*/
		
		
			//开始查询
			if($checknum ==0){
				$sql = "select * from club where clubID = '".$stuID."' and PW = '".$password."'";
				//echo $sql;
				$result = mysql_query($sql);    
				$row = mysql_fetch_array($result); 
				
				/* //调试
				var_dump($row);
				echo $sql.'</br>'; //查询语句
				$num_rows = mysql_num_rows($result);
				echo $num_rows.'</br>';     //结果数   
				echo empty($row).'</br>';*/
				
			    if (empty($row)){     //查询不到数据，不存在该学号
			    	 echo ' <script type="text/javascript" charset="utf-8">alert("你输入的账号与密码不一致！");history.back();</script>';
					  exit();  
			    }else{	
					$_SESSION['uid'] = $row["clubname"];
					$_SESSION['power']= "3";  //设置用户组的权限
					$_SESSION['clubID']= $row["clubID"];
					header("location: http://localhost/Organization/about/myself.html"); 
			    }  
			}
			break;
			
		default:
			//验证账号
			$stuID = test_input($_POST["stuID"]);
			$password = test_input($_POST["PW"]);
			echo $stuID;
			echo $password;
			if (empty($stuID)) {
				echo ' <script type="text/javascript" charset="utf-8">alert("账号不能为空");history.back();</script>';
				exit();
			}elseif($stuID=="admin"){
				//验证密码
				if (empty($password)) {
					echo '<script type="text/javascript" charset="utf-8">alert("密码不能为空");history.back();</script>';
					exit();
				} elseif($password=="admin") {
					$_SESSION['uid'] = "管理员";
					$_SESSION['power']= "";  //设置用户组的权限
					header("location: http://localhost/Organization/about/myself.html"); 
				}else{
					echo ' <script type="text/javascript" charset="utf-8">alert("你输入的密码不正确！");history.back();</script>';
					exit(); 
				}
			}else{
				echo ' <script type="text/javascript" charset="utf-8">alert("你输入的账号不正确！");history.back();</script>';
					exit(); 
			}
			break;
	}
}

?>