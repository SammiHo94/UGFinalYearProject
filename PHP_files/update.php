<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
	
		$mode = $_GET["mode"];
		switch($mode){
			case 1: // 通过加入组织
				$joinID=$_GET["data"];
				$sql="UPDATE `joinorgan` SET `state`='通过' WHERE (`joinID`='".$joinID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 2: // 驳回加入组织
				$joinID=$_GET["data"];
				$sql="UPDATE `joinorgan` SET `state`='已驳回' WHERE (`joinID`='".$joinID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 3: // 通过借出物资
				$borrowID=$_GET["data"];
				$sql="UPDATE `borrow` SET `state`='通过' WHERE (`borrowID`='".$borrowID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 4: // 驳回借出物资
				$borrowID=$_GET["data"];
				$sql="UPDATE `borrow` SET `state`='已驳回' WHERE (`borrowID`='".$borrowID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 5: // 归还物资
				$borrowID=$_GET["data"];
				$sql="UPDATE `borrow` SET `state`='已归还' WHERE (`borrowID`='".$borrowID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
				
			case 6: // 通过借出场地
				$bookID=$_GET["data"];
				$sql="UPDATE `booksite` SET `state`='通过' WHERE (`bookID`='".$bookID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 7: // 驳回借出场地
				$bookID=$_GET["data"];
				$sql="UPDATE `booksite` SET `state`='已驳回' WHERE (`bookID`='".$bookID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 8: // 归还物资
				$bookID=$_GET["data"];
				$sql="UPDATE `booksite` SET `state`='已归还' WHERE (`bookID`='".$bookID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 9: // 通过加入组织
				$joinID=$_GET["data"];
				$sql="UPDATE `joinclub` SET `state`='通过' WHERE (`joinID`='".$joinID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 10: // 驳回加入组织
				$joinID=$_GET["data"];
				$sql="UPDATE `joinclub` SET `state`='已驳回' WHERE (`joinID`='".$joinID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 11: // 退出组织
				$joinID=$_GET["data"];
				$sql="UPDATE `joinorgan` SET `state`='已退出' WHERE (`joinID`='".$joinID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 12: // 退出社团
				$joinID=$_GET["data"];
				$sql="UPDATE `joinclub` SET `state`='已退团' WHERE (`joinID`='".$joinID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('修改失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
		}
			

?>