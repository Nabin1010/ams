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

?>
<table class="table table-hover">
<tr>
<th>S.No.</th>
<th>Full Name</th>
<th>Email</th>
<th>Phone Number</th>
<th>Role</th>
<th>Thumbnail</th>
<th>Action</th>
</tr>
<?php
$conn = db_get_conn();
$query = "
SELECT
tbluser.id, tbluser.fullname, tbluser.email, tbluser.phone,
tbluser.image, tblrole.name, tblrole.slug
FROM tbluser JOIN tblrole
ON tbluser.role_id = tblrole.id";
if ($result = $conn->query($query))
{
$count = 1;
/* fetch associative array */
while ($row = $result->fetch_assoc())
{
$image = USER_IMG.$row['image'];
echo "
<tr>
<td>{$count}</td>
<td><a href='detail.php?id={$row['id']}'>{$row['fullname']}</a></td>
<td>{$row['email']}</td>
<td>{$row['phone']}</td>
<td>{$row['name']}</td>
<td><img src='{$image}' alt='{$row['fullname']}' style='height:
48px; width: 48px;' /></td>
<td>
<a href='edit.php?id={$row['id']}'>Edit</a>
<a href='delete.php?id={$row['id']}'>Delete</a>
</td>
</tr>
";
$count++;
}
/* free result set */
$result->free();
}
/* close connection */
$conn->close();
?>
</table>
<?php
require_once('../inc/footer.php');
?>