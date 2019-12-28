<nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="collapse navbar-collapse">
        <div class="navbar-header"></div>
        <button type="button" id="sibebarCollpase" class="btn btn-info navbar-info">
        <i class="glyphicon glyphicon-align-left"></i>
        </button>
    
    
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo USER_IMG.$_SESSION['session']['user']['image']; ?>" height=35 width=35 class="img-circle"> <?php echo $_SESSION['session']['user']['fullname']; ?> <b
                    class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo '/ams/admin/profile/'; ?>"><i class="glyphicon
                        glyphicon-cog"></i> Account</a></li>
                    <li class="divider"></li>
                    <li><a href="/ams/signout.php"><i class="glyphicon glyphicon-log-out"></i>
                        Sign-out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
  
</nav>