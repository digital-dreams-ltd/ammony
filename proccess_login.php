<?php
	$_exception=1; 
	if(isset($_POST["username"]))
	{
		
		require_once "Database_Connect.php";
		require_once "get_param.php";
		extract($_POST, EXTR_OVERWRITE);
			$query="select id, name, roleid,accesslevel,warehouse from users where username = '$username' and password='$password'";
			$result=$db->query($query) or die($db->error);
			if($row=$result->fetch_assoc())
			{
				setcookie("ELIMS-Login", $row['id'], time()+36000); 
				setcookie("ELIMS-Login_Name", $row['name'], time()+36000); 
				setcookie("ELIMS-RoleId", $row['roleid'], time()+36000); 
				setcookie("ELIMS-AccessLevel", $row['accesslevel'], time()+36000); 
				setcookie("ELIMS-Warehouse", $row['warehouse'], time()+36000);
				$whname= getDataValue($row['warehouse'],'warehouse');
				setcookie("ELIMS-Warehouse_Name", $whname, time()+36000);
				$userid=$row['id'];
				//$db->query("insert into accesslog values ('$userid',now(),'D','Logged in')") or die($db->error);
				
				//session_start();
  				//session_register('userid'); 
				header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

				header("Location:default.php");
				die();
			} else
			{
				$msg= "Username or password is incorrect";
				header( "Location:index.php?msg=$msg");	
				die();
			}
			$result->free();
			$db->close();
	
	}  else header( "Location:index.php");
	
?>