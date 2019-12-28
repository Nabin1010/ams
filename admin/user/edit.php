<?php
    require_once('./../../core/constants.php');
    require_once('./../../core/functions.php');
    
    if(!isAuthenticated()){
    	header('Location: ' .LOGIN_PAGE);
    }
    
    require_once('../inc/header.php');
    require_once('../inc/sidebar.php');
    require_once('../inc/navigation.php');
    display_flash();
    if(isset($_GET['id']))
    {
    if(is_numeric($_GET['id']))
    {
    $conn = db_get_conn();
    $query = "
    SELECT
    tbluser.id, tbluser.fullname, tbluser.email, tbluser.image,
    tblrole.name, tblrole.id AS role_id
    FROM tbluser JOIN tblrole
    ON tbluser.role_id = tblrole.id
    WHERE tbluser.id={$_GET['id']}";
    
    if($result = $conn->query($query))
    {
    if($result->num_rows == 1)
    {
    $rolequery = "SELECT * FROM tblrole";
    $roleresult = $conn->query($rolequery);
    $user = $result->fetch_assoc();
    $image = USER_IMG.$user['image'];
    ?>
<div class="row">
    <div class=" col-md-offset-3 col-md-6">
        <form method="POST" action="<?PHP echo CORE_ACTION ?>">
            <input type="hidden" name="form" value="formuseredit" />
            <input type="hidden" name="user_id" value="<?php echo
                $_GET['id'] ?>" />
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type='text' name='fullname' id="fullname"
                    class="form-control" value='<?php echo $user['fullname']; ?>' />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type='email' name='email' id="email"
                    class="form-control" value='<?php echo $user['email']; ?>' />
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role_id" id="role" class="form-control">
                <?php
                    while($row = $roleresult->fetch_assoc())
                    {
                    if($row['id'] == $user['role_id'])
                    {
                    echo "<option value='{$row['id']}' selected>{$row['name']}</option>";
                    }
                    else
                    {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    }
                    ?></select>
            </div>
            <div>
                <input type="submit" value="Apply" class="btn btn-primary">
            </div>
        </form>
    </div>
    <div class="form-group" class="col-md-3">
    <img src='<?php echo $image; ?>' class="profile-image"
        alt='<?php echo $user['fullname']; ?>' style='height: 150px; width: 150px;' />
    </div>
</div>
<!-- Change user password -->
<div class="row">
<div class="col-md-offset-3 col-md-6">
<button type="button" class="btn btn-primary text-center" datatoggle="
    modal" data-target="#changepasswordmodal">Change Password</button>
<div class="modal fade" id="changepasswordmodal" tabindex="-
    1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" datadismiss="
    modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title"
    id="exampleModalLabel">Change Password</h4>
</div>
<div class="modal-body">
<form method="POST" action="<?PHP echo
    CORE_ACTION ?>">
<input type="hidden" name="form" value="
    formusereditpassword" />
<input type="hidden" name="user_id" value="<?
    php echo $_GET['id'] ?>" />
<div class="form-group">
<label for="currentpassword">Current
Password</label>
<input type="password"
    name="currentpassword" id="currentpassword" class="form-control" required />
</div>
<div class="form-group">
<label for="newpassword">New Password</label>
<input type="password"
    name="newpassword" id="newpassword" class="form-control" required />
</div>
<div class="form-group">
<label for="renewpassword">Re New Password</label>
<input type="password"
    name="renewpassword" id="renewpassword" class="form-control" required />
</div>
<div class="modal-footer">
<button type="submit" class="btn btnprimary">Change Password</button>

</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
    }
    else
    {
    set_flash('warning', '404 Not Found', 'Unable to find user.');
    display_flash();
    }
    }
    $conn->close();
    }
    }
    require_once('../inc/footer.php');
    ?>