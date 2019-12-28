<?php
require_once('../core/constants.php');
require_once('../core/functions.php');

if(!isAuthenticated())
{
    header('Location: ' . LOGIN_PAGE);
}

$user_id = $_SESSION['session']['user']['id'];
$conn = db_get_conn();

require_once('../inc/header.php');
require_once('../inc/navigation.php');

display_flash();

// Get user detail and display
$query = "
            SELECT
                tbluser.id, tbluser.fullname, tbluser.email, tbluser.image, tblrole.name
                FROM tbluser JOIN tblrole
                ON tbluser.role_id = tblrole.id
                WHERE tbluser.id={$user_id}
        ";
if($result = $conn->query($query))
{
    if($result->num_rows == 1)
    {
        $user = $result->fetch_assoc();
        ?>
        <div class="col-md-offset-3 col-md-6">
            <table class="table table-hover">
                <tr>
                    <th>ID: </th>
                    <td><?php echo $user['id'] ?></td>
                    <td rowspan="4">
                        <img src="<?php echo USER_IMG.$user['image']; ?>" alt="<?php echo $user['fullname']; ?>" style="height: 150px; width: 150px;" />
                    </td>
                </tr>
                <tr>
                    <th>Name: </th>
                    <td><?php echo $user['fullname'] ?></td>
                </tr>
                <tr>
                    <th>Email: </th>
                    <td><?php echo $user['email'] ?></td>
                </tr>
                <tr>
                    <th>Role: </th>
                    <td><?php echo $user['name'] ?></td>
                </tr>
            </table>
        </div>
        <?php
    }
    else
    {
        set_flash('warning', '404 Not Found', 'Unable to find user.');
        display_flash();
    }
}

// Upload user image
?>

<div class="row">
    <div class="col-md-offset-3 col-md-2">
        <button type="button" class="btn btn-primary text-center" data-toggle="modal" data-target="#changepasswordmodal">Change Password</button>
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-primary text-center" data-toggle="modal" data-target="#changeimagemodal">Change Profile Image</button>
    </div>    
        <div class="modal fade" id="changepasswordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo CORE_ACTION; ?>" method="POST">
                            <input type="hidden" name="form" value="formchangepassword" />
                            <div class="form-group">
                                Old Password: <input type="password" class="form-control" name="oldpassword" id="oldpassword" required />
                        </div>
                           <div class="form-group">
                                New Password: <input type="password" class="form-control"name="newpassword" id="newpassword" required />
                            </div>
                            <div class="form-group">
                                Re New Password: <input type="password" class="form-control" name="renewpassword" id="renewpassword" required />
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary" value="Change Password" />
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="changeimagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Change Profile Image</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo CORE_ACTION; ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="form" value="formimageupload" />
                            <div class="form-group">
                                <input type="file" name="image" required />
                                <p class="help-block">1 MB max</p>
                                <input type="submit" class="btn btn-primary"value="Upload"/>
                                
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        
    </div>



<?php
require_once('../inc/footer.php');
$conn->close();