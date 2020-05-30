<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
// 检查输入数据是否合法
$checknum = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//验证组织名
	if (empty($_POST["name"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("组织名不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	}else {
		$name = test_input($_POST["name"]);
	}

	//验证组织名
	if (empty($_POST["intro"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("简介不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	}else {
		$intro = test_input($_POST["intro"]);
	}
	
		$organID = test_input($_POST["organID"]); 

		/*//查看获取的数据
		echo $name."<br/>"; 
		echo $intro."<br/>"; 
		echo $organID."<br/>"; 
		
		echo "checknum is".$checknum."<br/>";*/

		/*//测试查询
		$data = test_input($_POST["stuID"]);
		$sql = "SELECT * FROM member WHERE stuID = '".$data."'"; 
		$result2 = mysql_query($sql);    
		$row = mysql_fetch_array($result2); 
		var_dump($row);*/
		
		
	if ($checknum == 0) {
		//插入数据
		$sql = "UPDATE `organ` SET `organname`='" . $name. "', `introduction`='" . $intro. "' WHERE (`organID`='" . $organID . "')";
		//echo $sql;
		$result = mysql_query($sql);
		//echo "$result".$result;
		mysql_close();
		if ($result) {
			echo "<script>alert('修改成功')</script>";
			$_SESSION['uid'] = $name;
			echo "<script>history.go(-1);</script>";
		} else {
			echo "<script>alert('修改失败')</script>";
			echo "<script>history.go(-1);</script>";
		}
	}
}
?>