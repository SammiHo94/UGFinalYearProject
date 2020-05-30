<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
// 检查输入数据是否合法
	
$checknum = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//验证编号
	if (empty($_POST["campaign_ID"])) {
			echo ' <script type="text/javascript" charset="utf-8">alert("编号不能为空");history.back();</script>';
			$checknum = 1;
			exit();
		}elseif(preg_match("/^[0-9]{8}$/",$_POST["campaign_ID"])){
			$IDExist = IfExistOrNot_camID($_POST["campaign_ID"]);
			if(!empty($IDExist)){
				echo ' <script type="text/javascript" charset="utf-8">alert("该编号未注册");history.back();</script>';
				$checknum = 1;
				exit();
			}else{
				$campaign_ID = test_input($_POST["campaign_ID"]) ;
			}   
		}else{
			echo ' <script type="text/javascript" charset="utf-8">alert("编号为8位数字");history.back();</script>';
			$checknum = 1; 
			exit();  
		}

	//验证奖项
	if (empty($_POST["award_name"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("奖项不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$award_name = test_input($_POST["award_name"]);
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
		$sql = "INSERT INTO awards (awardsID,campaignID,awards) VALUES ('','" . $campaign_ID . "','" . $award_name . "')";
		//echo $sql."<br>";
		$result = mysql_query($sql);
		if ($result) {
			$id = mysql_insert_id();
			echo "<script>alert('你的申请号为".$id."')</script>";
			echo "<script>history.go(-1);</script>";
		} else {
			echo "<script type='text/javascript' charset='utf-8'>if(confirm('申请失败，请重新填写')){
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