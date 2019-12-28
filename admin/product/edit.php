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
			   tblproduct.id, tblproduct.name, tblproduct.description, tblproduct.available_qty, tblproduct.cat_id, tblcategory.name AS cat_name
			   FROM tblproduct JOIN tblcategory
			   ON tblproduct.cat_id = tblcategory.id
			   WHERE tblproduct.id={$_GET['id']}";
		   
		   if($result = $conn->query($query))
		   {

		   	if($result->num_rows == 1)
		   {

			   $categoryquery = "SELECT * FROM tblcategory";
			   $categoryresult = $conn->query($categoryquery);
			   $product = $result->fetch_assoc();
	   	?>
			<div class="row">
			   <div class=" col-md-offset-3 col-md-6">
			      <form method="POST" action="<?PHP echo CORE_ACTION ?>">
			         <input type="hidden" name="form" value="formproductedit" />
			         <input type="hidden" name="product_id" value="<?php echo
			            $_GET['id'] ?>" />
			         <div class="form-group">
			            <label for="name">Name</label>
			            <input type='text' name='name' id="name"
			               class="form-control" value='<?php echo $product['name']; ?>' />
			         </div>
			         <div class="form-group">
			            <label for="category">Category</label>
			            <select name="category_id" id="category" class="form-control">
			            <?php
			               while($row = $categoryresult->fetch_assoc())
			               {
				               if($row['id'] == $product['cat_id'])
				               {
				              	 echo "<option value='{$row['id']}' selected>{$row['name']}</option>";
				               }
				               else
				               {
				              	 echo "<option value='{$row['id']}'>{$row['name']}</option>";
				               }
			               }
			               ?> </select>
			         </div>

			         <div class="form-group">
			            <label for="available_qty">Avalilabe Quatity</label>
			            <input type='number' name='available_qty' id="available_qty"
			               class="form-control" value='<?php echo $product['available_qty']; ?>' />
			         </div>

			         <div class="form-group">
			            <label for="description">Description</label>
			            <input type='text' name='description' id="description"
			               class="form-control" value='<?php echo $product['description']; ?>' />
			         </div>
			         
			         <div>
			            <button type="submit" class="btn btn-primary" >Apply</
			            button>
			         </div>
			      </form>
			   </div>
			</div>
			<?php
			}
		}
			$conn->close();
	}

}
require_once('../inc/footer.php');
?>