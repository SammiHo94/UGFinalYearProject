<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
// 检查输入数据是否合法
	
$checknum = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//验证物资
	if (empty($_POST["name"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("物资名不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$name = test_input($_POST["name"]);
	}
	
	//验证数量
	if (empty($_POST["num"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("数量不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} elseif(preg_match("/^[0-9]$/",$_POST["num"])){
			$num = test_input($_POST["num"]);    
	} else{
		echo ' <script type="text/javascript" charset="utf-8">alert("数量必须为数字");history.back();</script>';
		$checknum = 1;   
		exit();
	}
	
	//验证数量
	if (empty($_POST["nowhave"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("现存量不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} elseif(preg_match("/^[0-9]$/",$_POST["nowhave"])){
			$nowhave = test_input($_POST["nowhave"]);    
	} else{
		echo ' <script type="text/javascript" charset="utf-8">alert("现存量必须为数字");history.back();</script>';
		$checknum = 1;   
		exit();
	}
	
		/*//查看获取的数据
		echo $stu_ID."<br/>"; 
		echo $site_name."<br/>"; 
		echo $num."<br/>"; 
		echo $borrow_date."<br/>"; 
		echo $return_date."<br/>"; 
		echo "checknum is".$checknum."<br/>";*/

		/*//测试查询
		$data = test_input($_POST["stuID"]);
		$sql = "SELECT * FROM member WHERE stuID = '".$data."'"; 
		$result2 = mysql_query($sql);    
		$row = mysql_fetch_array($result2); 
		var_dump($row);*/
		
		
	if ($checknum == 0) {
		//插入数据
		$sql = "INSERT INTO `site` (`siteID`,`sitename`, `quantity`, `nowhave`) VALUES ('','" . $name . "','" . $num . "','" . $nowhave . "')";
		//echo $sql."<br>";
		$result = mysql_query($sql);
		//echo $result;
		if ($result) {
			$id = mysql_insert_id();
			echo "<script>alert('编号号为".$id."')</script>";
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