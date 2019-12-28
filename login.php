<?php

require_once('./core/constants.php');
require_once('./core/functions.php');

    if(isAuthenticated())
    {
        header('Location: ' . ADMIN_URL);
    }

    display_flash();
?>


<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <style type="text/css">
    div.login-form{
      margin-top: 100px;
      border: 1px solid #f1f1f1;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 1px 1px 3px rgb(0, 0, 0, 0.1);
    }
  </style>
 
</head>
<body>
  <div class="container">
    <div class="col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4 login-form">


      <form class="form-signin" method="POST" action="<?PHP echo CORE_ACTION ?>">
        <h2 class="form-signin-heading text-center">Please sign in</h2>
        <input type="hidden" name="form" value="formlogin" />
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
        <br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
       <br>
       <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" >
       <p><br>  <div class="container"> did Not have an Account </div> <li><a href="./registration.php"><input class="btn btn-lg btn-primary btn-block"  value="Register here" ></a></li></p>

      </form>
    </div>
  </div> <!-- /container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>