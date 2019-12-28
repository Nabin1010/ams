<nav id="sidebar">
    <div class="sidebar-header">
        <h3><?php echo PROJECT_NAME; ?></h3>
        <p>Minor Project I</p>
    </div>
    <ul class="list-unstyled components">
    <li  class="active"><a href="<?php echo ADMIN_URL; ?>">Dashboard</a></li>
    <?php
        if(isAuthorized('admin'))
        {
        	?>
    <li>
        <a href="#overview-sub-menu" data-toggle="collapse" aria-expanded="false">User</a>
        <ul class="collapse list-unstyled" id="overview-sub-menu">
            <li><a href="<?php echo ADMIN_URL.'user/'; ?>">User List</a></li>
            <li><a href="<?php echo ADMIN_URL.'user/create.php'; ?>">Create User</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#overview-sub-menu1" data-toggle="collapse" aria-expanded="false">product</a>
        <ul class="collapse list-unstyled" id="overview-sub-menu1">
            <li><a href="<?php echo ADMIN_URL.'product/'; ?>">Product List</a></li>
            <li><a href="<?php echo ADMIN_URL.'product/create.php'; ?>">Create product</a></li>
        </ul>
    </li>
    <?php
        }
        ?>
    <li><a href="<?php echo ADMIN_URL.'category/'; ?>">Category</a></li>
</nav>
<div id="content">