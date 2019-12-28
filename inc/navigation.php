 <nav class="navbar navbar-inverse" >
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
          <ul class="nav navbar-nav">
            <li><a href="<?php echo ROOT_FOLDER; ?> ">Home</a></li>
            <li><a href="./aboutus.php">About Us</a></li>
            <li><a href="./ourteam.php">Our Team</a></li>
             <li><a href="./contactus.php">Contact us</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <?php

            if(!isAuthenticated()){
             echo "<li><a href='/ams/login.php'>Login</a></li>
                  <li><a href='/ams/registration.php'>Register</a></li>";
            }

            else{
              ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo USER_IMG.$_SESSION['session']['user']['image']; ?>" height=35 width=35 class="img-circle"> <?php echo $_SESSION['session']['user']['fullname']; ?> <b
                    class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo ROOT_FOLDER.'customer_profile/'; ?>"><i class="glyphicon
                        glyphicon-cog"></i> Account</a></li>
                    <li class="divider"></li>
                    <li><a href="/ams/signout.php"><i class="glyphicon glyphicon-log-out"></i>
                        Sign-out</a>
                    </li>
                </ul>
            </li>
            <?php
            }

            ?>
        </ul>
         
        </div><!--/.navbar-collapse -->
      </div>
    </nav>