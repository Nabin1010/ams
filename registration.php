<?php
   require_once('./core/constants.php');
   require_once('./core/functions.php');
   
   require_once('./inc/header.php');
  
   ?>
  <div class="container-fluid">
   <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo ROOT_FOLDER;?>">AMS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" method="POST" action="<?php echo CORE_ACTION ?>">
            <input type="hidden" name="form" value="formlogin" />
            <div class="form-group">
              <input type="email" name="email" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    <!--navbar ends-->
<div class="row col-md-12">
   <!-- /container -->
   <div class="item active col-md-8">
               <img src=assets/img/falful.jpg class="img-rounded" alt="Cinque Terre" width="800" height="600">
    </div>        
   <div class="container col-md-4 registration-form">
      <?php display_flash(); ?>
      <form class="form-registration" method="POST" action="<?PHP echo CORE_ACTION ?>">
         <h2 class="form-registration-heading text-center">Register Here</h2>
         <input type="hidden" name="form" value="formregistration" />
         <div class="form-group">
            <label for="fullname" >Full name:</label>
            <input type="text" id="inputname" class="form-control" name="fullname"  required autofocus>
         </div>
         <div class="form-group">
            <label for="Email" >Email address</label>
            <input type="email" id="inputEmail" class="form-control" name="email" required autofocus>
         </div>
         <div class="form-group">
            <label for="inputPassword" >Password</label>
            <input type="password" id="inputPassword" class="form-control" name="password" required>
         </div>
         <div class="form-group">
            <label for="inputRePassword" >Confirm Password</label>
            <input type="password" id="inputRePassword" class="form-control" name="password_confirm" required>
         </div>
         <div class="form-group">
            <label for="phone Number" >Phone Number</label>
            <input type="number" id="inputNumber" class="form-control" name="phonenumber" required autofocus>
         </div>
         <button class="btn btn-lg btn-primary btn-block" type="submit" name="login-form">Register</button>
      </form>
   </div>
</div>
</div>

<?php
   require_once('./inc/footer.php');
   ?>