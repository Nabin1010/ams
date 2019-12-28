
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
$conn = db_get_conn();
$query = "SELECT * FROM tblcategory";
$result = $conn->query($query);
$conn->close();
?>
<div class="col-md-offset-3 col-md-6">
<form method="POST" action="<?PHP echo CORE_ACTION ?>" enctype="multipart/form-data">
<input type="hidden" name="form" value="formproductcreate" />

<div class="form-group">
<label for="Name"> Name</label>
<input type="text" name="name" class="form-control" id="Name" required/>
</div>
<div class="form-group">
<label for="description">Description </label>
<input type="text" name="description" class="form-control" id="description" required/>
</div>
<div class="form-group">
<label for="available_qty">Available_qty </label>
<input type="number" name="available_qty" class="form-control" id="available_qty" required/>
</div>
<div class="form-group">
<label for="category">category</label>
<select name="category_id" id="category_id" class="form-control">
<?php
while($row = $result->fetch_assoc())
{
	// dd($row);
echo "<option value=".$row['id'].">".$row['name']."</option>";
}
?>
</select>
</div>
<div class="form-group">
	<label for="product_image">Product Image</label>
    <input type="file" name="image" id="product_image" required />
    <p class="help-block">.jpg and .png only (2 MB max)</p> 
</div>
<input type="submit" value="Add Product" class="btn btn-primary">
</form>
</div>
<?php
require_once('../inc/footer.php');
?>