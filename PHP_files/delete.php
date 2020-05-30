<?php
	session_start();
	require "functions.php";
	powerconn($_SESSION["power"]);
	header("Content-Type: text/html;charset=utf-8"); 
	
		$mode = $_GET["mode"];
		switch($mode){
			case 1: // 删除参赛表
				$camID=$_GET["data"];
				$sql="DELETE FROM `campaign` WHERE (`campaignID`='".$camID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
				   			echo "<script>alert('已删除信息')</script>";
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('该活动已结束，不能删除')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 2:  //删除申请组织
				$joinID=$_GET["data"];
				$sql = "SELECT * FROM `joinorgan` WHERE (`joinID`='".$joinID."')";
				$result = mysql_query ($sql);
				$row = mysql_fetch_array($result);
				if($row["state"]!="审理中"){
					echo "<script>alert('该申请已审批，不能删除')</script>";
					echo "<script>history.go(-1);</script>";
				}else{
					$sql2="DELETE FROM `joinorgan` WHERE (`joinID`='".$joinID."')";
				   		$result2 = mysql_query ($sql2);
				   		if($result2){
				   			echo "<script>alert('已删除信息')</script>";
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('删除失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				}
				break;
				
			case 3:  //删除申请社团
				$joinID=$_GET["data"];
				$sql = "SELECT * FROM `joinclub` WHERE (`joinID`='".$joinID."')";
				$result = mysql_query ($sql);
				$row = mysql_fetch_array($result);
				echo $row['state'];
				if($row['state']!="审理中"){
					echo "<script>alert('该申请已审批，不能删除')</script>";
					echo "<script>history.go(-1);</script>";
				}else{
					$sql2="DELETE FROM `joinclub` WHERE (`joinID`='".$joinID."')";
				   		$result2 = mysql_query ($sql2);
				   		if($result2){
				   			echo "<script>alert('已删除信息')</script>";
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('删除失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				}
				break;
			
			case 4:  //删除活动
				$actID=$_GET["data"];
				$sql="DELETE FROM `activity` WHERE (`actID`='".$actID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
				   			echo "<script>alert('已删除信息')</script>";
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('删除失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 5:  //删除获奖
				$awardsID=$_GET["data"];
				$sql="DELETE FROM `awards` WHERE (`awardsID`='".$awardsID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
				   			echo "<script>alert('已删除信息')</script>";
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('删除失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 6:  //删除组织
				$organID=$_GET["data"];
				$sql="DELETE FROM `organ` WHERE (`organID`='".$organID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
				   			echo "<script>alert('已删除信息')</script>";
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('删除失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 7:  //删除社团
				$clubID=$_GET["data"];
				$sql="DELETE FROM `club` WHERE (`clubID`='".$clubID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
				   			echo "<script>alert('已删除信息')</script>";
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('删除失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
				
			case 8:  //删除物资
				$materID=$_GET["data"];
				$sql="DELETE FROM `materials` WHERE (`materID`='".$materID."')";
				   		$result = mysql_query ($sql);
				   		if($result){
				   			echo "<script>alert('已删除信息')</script>";
							echo "<script>history.go(-1);</script>";
				   		}else{
				   			echo "<script>alert('删除失败')</script>";
							echo "<script>history.go(-1);</script>";
				   		}
				break;
		}

?>