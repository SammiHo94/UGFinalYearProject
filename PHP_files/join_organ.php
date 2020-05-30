<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
// 检查输入数据是否合法
$checknum = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//验证学号
	if (empty($_POST["stuID"])) {
			echo ' <script type="text/javascript" charset="utf-8">alert("学号不能为空");history.back();</script>';
			$checknum = 1;
			exit();
		}elseif(preg_match("/^[0-9]{12}$/",$_POST["stuID"])){
			$IDExist = IfExistOrNot($_POST["stuID"]);
			if(!empty($IDExist)){
				echo ' <script type="text/javascript" charset="utf-8">alert("该学号未注册");history.back();</script>';
				$checknum = 1;
				exit();
			}else{
				$stuID = test_input($_POST["stuID"]) ;
			}   
		}else{
			echo ' <script type="text/javascript" charset="utf-8">alert("学号为12位数字");history.back();</script>';
			$checknum = 1; 
			exit();  
		}

//验证社团
	if (empty($_POST["department_name"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("未选择部门");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$department_ID = test_input($_POST["department_name"]) ;
	}
		
		//验证职位
	if (empty($_POST["position_name"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("未选择职位");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$position_name = test_input($_POST["position_name"]) ;
	}
		
		/*//查看获取的数据
		echo $stuID."<br/>"; 
		echo $club_ID."<br/>"; 
		echo $position_name."<br/>"; 
		echo "checknum is".$checknum."<br/>";*/
		
		
	if ($checknum == 0) {
		//插入数据
		$sql="INSERT INTO `joinorgan` (`joinID`,`stuID`, `deID`, `position`) VALUES ('','" . $stuID . "','" . $department_ID . "','" . $position_name . "')";
		//echo $sql."<br>";
		
		$result = mysql_query($sql);
		
		if ($result) {
			$id = mysql_insert_id();
			echo "<script>alert('你的申请号为".$id."')</script>";
			echo "<script>history.go(-1);</script>";
		} else {
			echo "<script>if(confirm('申请失败，请重新填写')){
				window.location.href='http://localhost/Organization/application/joinclub.html';
				}else {
					history.go(-1);
					}
				</script>";
	
		}
		mysql_close();
	}
}
?>