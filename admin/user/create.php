<?php
require_once('./../../core/constants.php');
require_once('./../../core/functions.php');

if(!isAuthenticated()){
	header('Location: ' .LOGIN_PAGE);
}
   if(!isAuthorized('admin'))
    {
        header('Location: ' . ADMIN_URL);
    }

require_once('../inc/header.php');
require_once('../inc/sidebar.php');
require_once('../inc/navigation.php');
display_flash();
$conn = db_get_conn();
$query = "SELECT * FROM tblrole";
$result = $conn->query($query);
$conn->close();
?>
<div class="col-md-offset-3 col-md-6">
<form method="POST" action="<?PHP echo CORE_ACTION ?>">
<input type="hidden" name="form" value="formusercreate" />
<div class="form-group">
<label for="fullname">Fullname</label>
<input type="text" name="fullname" class="form-control" id="fullname" required/>
</div>
<div class="form-group">
<label for="email">Email</label>
<input type="email" name="email" class="form-control" id="email" required/>
</div>
<div class="form-group">
<label for="phonenumber">Phone Number</label>
<input type="text" name="phonenumber" class="form-control" id="phonenumber" autocomplete="
on"/>
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" name="password" class="form-control" id="password" required/>
</div>
<div class="form-group">
<label for="passwordconfirm">Confirm Password</label>
<input type="password" name="passwordconfirm" class="form-control" id="passwordconfirm"
required/>
</div>
<div class="form-group">
<label for="role">Role</label>
<select name="role_id" id="role_id" class="form-control">
<?php
while($row = $result->fetch_assoc())
{
	// dd($row);
echo "<option value=".$row['id'].">".$row['name']."</option>";
}
?>
</select>
</div>
<input type="submit" value="Register" class="btn btn-primary">
</form>
</div>
<?php
require_once('../inc/footer.php');
?>