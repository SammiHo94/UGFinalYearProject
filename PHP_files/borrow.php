<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
// 检查输入数据是否合法
	
$checknum = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//验证编号
	if (empty($_POST["stu_ID"])) {
			echo ' <script type="text/javascript" charset="utf-8">alert("编号不能为空");history.back();</script>';
			$checknum = 1;
			exit();
		}elseif(preg_match("/^[0-9]{12}$/",$_POST["stu_ID"])){
			$IDExist = IfExistOrNot($_POST["stu_ID"]);
			if(!empty($IDExist)){
				echo ' <script type="text/javascript" charset="utf-8">alert("该学号未注册");history.back();</script>';
				$checknum = 1;
				exit();
			}else{
				$stu_ID = test_input($_POST["stu_ID"]) ;
			}   
		}else{
			echo ' <script type="text/javascript" charset="utf-8">alert("编号为12位数字");history.back();</script>';
			$checknum = 1; 
			exit();  
		}

	//验证物资
	if (empty($_POST["mater_name"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("物资未选择");history.back();</script>';
		$checknum = 1;
		exit();
	} else {
		$mater_ID = test_input($_POST["mater_name"]);
	}
	
	//验证数量
	if (empty($_POST["num"])) {
		echo ' <script type="text/javascript" charset="utf-8">alert("数量不能为空");history.back();</script>';
		$checknum = 1;
		exit();
	} elseif(preg_match("/^[0-9]$/",$_POST["num"])){
		$nowhave = "select nowhave from materials where materID = '" . $mater_ID . "'";
		$res = mysql_query($nowhave);
		$row = mysql_fetch_array($res,MYSQL_ASSOC);
		$nownum = $row["nowhave"];
		if($_POST["num"]>$nownum){
			echo ' <script type="text/javascript" charset="utf-8">alert("现存数量不足");history.back();</script>';
			$checknum = 1;   
			exit();
		}else{
			$num = test_input($_POST["num"]);    
		}
	} else{
		echo ' <script type="text/javascript" charset="utf-8">alert("数量必须为数字");history.back();</script>';
		$checknum = 1;   
		exit();
	}
	
	$borrow_date = test_input($_POST["borrow_date"]); 
	$return_date = test_input($_POST["return_date"]); 
	
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
		$sql = "INSERT INTO `borrow` (`borrowID`,`materID`, `borrower`, `number`, `borrowdate`, `returndate`) VALUES ('','" . $mater_ID . "','" . $stu_ID . "','" . $num . "','" . $borrow_date . "','" . $return_date . "')";
		//echo $sql."<br>";
		$result = mysql_query($sql);
		//echo $result;
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