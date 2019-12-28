<?php 
    require_once('./core/constants.php'); 
    require_once('./core/functions.php');  

require_once('./inc/header.php');
require_once('./inc/navigation.php');  
    
      if(!isAuthenticated()){
      header('Location: ' .LOGIN_PAGE);
        }
    
      display_flash(); 
    
      if(isset($_GET['id']))     
        { 
        if(is_numeric($_GET['id']))
        {        
            $conn = db_get_conn();             
              $query = "SELECT tblproduct.id, tblproduct.name,  tblproduct.price, tblproduct.description, tblproduct.available_qty,tblproduct.product_image, tblcategory.name AS cat_name                        
              FROM tblproduct JOIN tblcategory                         
              ON tblproduct.cat_id = tblcategory.id                         
              WHERE tblproduct.id={$_GET['id']}";
              if($result = $conn->query($query))             
                {                 
                  if($result->num_rows == 1)                 
                    {                     
                      $product = $result->fetch_assoc();
                      $image = PRODUCT_IMG.$product['product_image'];
                        ?>                         
              <div class="container">
                <h1>Order <b><?php echo $product['name'];?></b> Now !!!</h1>
                <div class="row">
                  <form method="POST" action="<?php echo CORE_ACTION ?>">
                    <input type="hidden" name="form" value="orderdetailform" />
                    <input type="hidden" name="product_id" value="<?php echo $product['id'];?>" />

                  <div class="col-md-6">
                    <img src='<?php echo $image; ?>' height=100% width=100%>
                  </div>

                  <div class="col-md-4">
                    <h2><?php echo $product['name'];?></h2>
                    <p><?php echo $product['description'];?></p>
                    <p>Category: <?php echo $product['cat_name'];?></p>
                    <p>NRs. <?php echo $product['price'];?></p>
                    <div class="form-group">
                        <label for="qty_ordred">Quantity</label>
                        <input type="number" name="qty_ordred" class="form-control" id="qty_ordred" required/> 
                    </div> 
                        <input type="submit" value="Order Now" class="btn btn-primary">
                  </div>
                  </form>
                </div>
              </div>            
  

<?php                 
} 
else                 
{                     
set_flash('warning', '404 Not Found', 'Unable to find product.');                     
display_flash();                 
}             
}            
else             
{                 
set_flash('danger', 'Error', 'Something went wrong.');                 
display_flash();             
}             
$result->free();           
$conn->close();         
}
}     
?> 
<?php 
    require_once('inc/footer.php'); 
     
    ?>