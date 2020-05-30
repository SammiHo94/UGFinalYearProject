<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
// 检查输入数据是否合法
$checknum = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//验证姓名
	if (empty($_POST["name"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("姓名不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	}else {
		$stuname = test_input($_POST["name"]);
	}

	//验证性别
	if (empty($_POST["sex"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("未选择性别");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$sex = test_input($_POST["sex"]);
	}

	//验证手机号
	if (empty($_POST["telenum"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("手机号不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} elseif(preg_match("/^[0-9]{11}$/",$_POST["telenum"])){
		$telenum = test_input($_POST["telenum"]);    
	} else{
		echo ' <script type="text/javascript" charset="utf-8">alert("手机号为11位数字");history.back();</script>';
		$checknum = 1;   
		exit();
	}
	
	//验证宿舍号
	if (empty($_POST["Dome"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("宿舍号不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$Dome = test_input($_POST["Dome"]);
	}

	//验证入学年份
	if (empty($_POST["classgroup"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("入学年份不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} elseif(preg_match("/^20[0-9]{2}$/",$_POST["classgroup"])){
		$classgroup = test_input($_POST["classgroup"]); 
	} else{
		echo ' <script type="text/javascript" charset="utf-8">alert("入学年份为4位数字");history.back();</script>';
		$checknum = 1; 
		exit();  
	}
		$stuID = test_input($_POST["stuID"]); 

		/*//查看获取的数据
		echo $stuname."<br/>"; 
		echo $sex."<br/>"; 
		echo $telenum."<br/>"; 
		echo $Dome."<br/>"; 
		echo $classgroup."<br/>"; 
		
		echo "checknum is".$checknum."<br/>";*/

		/*//测试查询
		$data = test_input($_POST["stuID"]);
		$sql = "SELECT * FROM member WHERE stuID = '".$data."'"; 
		$result2 = mysql_query($sql);    
		$row = mysql_fetch_array($result2); 
		var_dump($row);*/
		
		
	if ($checknum == 0) {
		//插入数据
		$sql = "UPDATE `member` SET `stuname`='" . $stuname . "', `sex`='" . $sex . "', `telenum`='" . $telenum . "', `dome`='" . $Dome . "', `classgroup`='" . $classgroup . "' WHERE (`stuID`='" . $stuID . "')";
		//echo $sql;
		$result = mysql_query($sql);
		//echo $result;
		mysql_close();
		if ($result) {
			echo "<script>alert('修改成功')</script>";
			$_SESSION['uid'] = $stuname;
			echo "<script>history.go(-1);</script>";
		} else {
			echo "<script>alert('修改失败')</script>";
			echo "<script>history.go(-1);</script>";
		}
	}
}
?>