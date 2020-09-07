<?php
	//require_once ("proccess_login.php");

	require_once ("Database_Connect.php");

	require_once "get_company_info.php";

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/materialize.css" rel="stylesheet" type="text/css" media="screen,projection"/>

<link href="css/index.css" rel="stylesheet" type="text/css"/>

<link href="css/responsive.css" rel="stylesheet" type="text/css"/>

<link href="font/roboto/Roboto-Thin.ttf" rel="stylesheet" />

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<title><?php echo $company_name; ?> | LinkBiz</title>

<script type="text/javascript" src="scripts/jquery-2.1.3.min.js"></script>

<script type="text/javascript" src="scripts/extra.js"></script>

<script type="text/javascript" src="scripts/materialize.js"></script>

</head>

<body>

<div class="mycontainers">

  <div class="parallax-container slht1">

    <div class="parallax"><img src="images/shop.jpg"></div>

    <?php require_once("nav.php")?>

    <div class="container row">

      <div class="login_form white">

        <h5 style="font-weight:300" class="text-login blue-text darken-2-text center-align">Log In</h5>

        <form style="padding:10px 10%" class="row" action="proccess_login.php" method="post" enctype="application/x-www-form-urlencoded">

        <div class="input-field col s12">

          <input placeholder="Username" type="text" class="inp1" required="required" name="username">

        </div>

        <div class="input-field col s12">

          <input placeholder="Password" type="password" class="inp1" required="required" name="password">

        </div>

    

       <input type ="submit" class="btn-large blue darken-3 col s12 login_store" value ="submit" name ="submit"/>

       <p class="input-field col s12">

      <input type="checkbox" class="filled-in" id="filled-in-box"/>

      <label for="filled-in-box" style="left:0">Remember me</label>

    </p>

      </form>

      </div>

    </div>

    </div>

  </div>  

</body>

</html>