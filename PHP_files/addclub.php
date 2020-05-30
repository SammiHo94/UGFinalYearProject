<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
// 检查输入数据是否合法
	
$checknum = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//验证活动名
	if (empty($_POST["name"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("社团名不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$name = test_input($_POST["name"]);
	}

	//验证简介
	if (empty($_POST["intro"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("简介不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$intro = test_input($_POST["intro"]);
	}
	
	//验证密码
	if (empty($_POST["password"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("密码不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$password = test_input($_POST["password"]);
	}

		/*//查看获取的数据
		echo $campaign_ID."<br/>"; 
		echo $award_name."<br/>"; 
		
		echo "checknum is".$checknum."<br/>";*/

		/*//测试查询
		$data = test_input($_POST["stuID"]);
		$sql = "SELECT * FROM member WHERE stuID = '".$data."'"; 
		$result2 = mysql_query($sql);    
		$row = mysql_fetch_array($result2); 
		var_dump($row);*/
		
		
	if ($checknum == 0) {
		//插入数据
		$sql = "INSERT INTO `club` (`clubID`,`clubname`,  `introduction`, `PW`) VALUES ('','" . $name . "','" . $intro . "','" . $password . "')";
		//echo $sql."<br>";
		$result = mysql_query($sql);
		if ($result) {
			$id = mysql_insert_id();
			echo "<script>alert('你的申请号为".$id."')</script>";
			echo "<script>history.go(-1);</script>";
		} else {
			echo "<script type='text/javascript' charset='utf-8'>if(confirm('添加失败，请重新填写')){
				history.go(-1);
				}else {
				history.go(-1);
					}
				</script>";
	
		}
		mysql_close();
	}
}
?>