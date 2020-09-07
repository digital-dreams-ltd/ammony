<?php

	if(isset($_COOKIE["ELIMS-Login"]))

	{

					require_once "Database_Connect.php";

					$userid=$_COOKIE["ELIMS-Login"];

					//$db->query("insert into accesslog values ('$userid',now(),'D','Logged Out')") or die($db->error);



					setcookie("ELIMS-Login", '', time()-3600); 

					/*if(session_is_registered('username')){

					session_unset();

					session_destroy(); 

                    } 
                    */
	}

				header("Location:index.php");	







?>