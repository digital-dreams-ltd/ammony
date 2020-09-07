<?php
	//require_once "get_role_func.php";
	//require_once "get_role_desc.php";
	//require_once "get_company_info.php";
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
<title>Biz</title>
<script type="text/javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="scripts/extra.js"></script>
<script type="text/javascript" src="scripts/materialize.js"></script>
</head>
<body>
<main>
<div class="mycontainers">
  <div class="parallax-container slht">
    <div class="parallax"><img src="images/shop.jpg"></div>
    <?php require_once("nav.php")?>
    <div class="container">
      <div class="mid_parallax">
        <h1 class="text-parallax white-text center-align">Let's Get Your Store Online Today</h1>
        <h5 class="white-text center-align">Your One Stop Shop</h5>
        <a class="waves-effect waves-light btn-large trial_btn blue darken-2">Get Free Trial</a>
      </div>
    </div>
    </div>
   <div class="container">
      <div class="row">
         <h4 class="">Everything that you need</h4>
      </div>
   </div>
   <div class="blue darken-2 trial_reg">
      <h3 style="font-weight:300" class="center">Start Your 14-Day Free Trial Today</h3>
    <form style="padding:10px 10%" class="row">
        <div class="input-field col s12 m3">
          <input placeholder="Email Address" type="email" class="inp" required="required">
        </div>
        <div class="input-field col s12 m3">
          <input placeholder="Password" type="password" class="inp" required="required">
        </div>
        <div class="input-field col s12 m3">
          <input placeholder="Your Store Name" type="text" class="inp" required="required">
        </div>
         <div class="col s12 m3">
       <a class="waves-effect waves-light btn-large create_store s12 m3 black">Create Your Store</a>
       </div>
      </form>
      <h5 class="center">No Risk. It's Free. It's Absolutely Free.</h5>
   </div>
   </main>
  <div class="foot black">
  
  </div>
   
</div>
</body>
</html>