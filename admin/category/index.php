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
<div class="col-md-offset-2 col-md-6">
	<h2 class="text-center">Categories</h2>
<form method="POST" action="<?PHP echo CORE_ACTION ?>">
<input type="hidden" name="form" value="addcategoryform" />

<div class="form-group col-md-5">
<input type="text" name="cat_name" class="form-control " id="Name" placeholder = "Category Name"required/>
</div>
<div class="form-group col-md-5">
<input type="text" name="cat_slug" class="form-control " id="Name" placeholder = "Slug"required/>
</div>

<input type="submit" value="Add" class="btn btn-primary col-md-2">
</form>



<table class="table table-hover">
<tr>
<th>s.No.</th>
<th>Category</th>
<th>Action</th>
</tr>
<?php
$conn = db_get_conn();
$query = "SELECT tblcategory.id, tblcategory.name FROM tblcategory";

if($result = $conn->query($query))
{
$count = 1;
/* fetch associative array */
while ($row = $result->fetch_assoc())
{
echo "
<tr>
<td>{$count}</td>
<td>{$row['name']}</td>
<td>
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
</div>
<?php
require_once('../inc/footer.php');
?>