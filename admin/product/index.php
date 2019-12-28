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
<th>s.No.</th>
<th>Name</th>
<th>Description</th>
<th>Available_qty</th>
<th>Cateogy</th>
<th>Action</th>
</tr>
<?php
$conn = db_get_conn();
$query = "
SELECT
	tblproduct.id, tblproduct.name, tblproduct.description, tblproduct.available_qty,
 tblcategory.name AS cat_name
FROM tblproduct JOIN tblcategory
ON tblproduct.cat_id = tblcategory.id";
if ($result = $conn->query($query))
{
$count = 1;
/* fetch associative array */
while ($row = $result->fetch_assoc())
{
//$image = USER_IMG.$row['image'];
echo "
<tr>
<td>{$count}</td>
<td><a href='detail.php?id={$row['id']}'>{$row['name']}</a></td>
<td>{$row['description']}</td>
<td>{$row['available_qty']}</td>
<td>{$row['cat_name']}</td>


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