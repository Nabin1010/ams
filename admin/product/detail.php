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
                    $query = "SELECT tblproduct.id, tblproduct.name,  tblproduct.price, tblproduct.description, tblproduct.available_qty,tblproduct.product_image, tblcategory.name AS cat_name                        
                    FROM tblproduct JOIN tblcategory                         
                    ON tblproduct.cat_id = tblcategory.id                         
                    WHERE tblproduct.id={$_GET['id']}";
                    //dd($query);
                     
                    if($result = $conn->query($query))             
                        {                 
                            if($result->num_rows == 1)                 
                                {                     
                                    $product = $result->fetch_assoc();
                                   $image = PRODUCT_IMG.$product['product_image'];

                                   //dd($image);                                          
                                    echo "                         
                                    <div class='col-md-offset-3 col-md-6'>                             
                                    <h2 class=''text-center'>product Detail</h2>                             
                                    <table style='border-collapse: collapse; width: 100%;' class='table table-hover'>                                 
                                    <tr>                                     
                                    <th>ID: </th>                                     
                                    <td>{$product['id']}</td>                                 
                                    </tr> 


                                     <tr>                                     
                                     <th>productname: </th>                                     
                                     <td>{$product['name']}</td>

                                     </tr>                                 
                                     <tr>                                     
                                     <th>description: </th>                                     
                                     <td>{$product['description']}</td> 

                                      </tr>                                 
                                                                       
                                      <tr>                                     
                                      <th>available_qty </th>                                     
                                      <td>{$product['available_qty']}</td>

                                      </tr> 
                                      <tr>                                     
                                      <th>category name</th>                                     
                                      <td>{$product['cat_name']}</td>

                                      </tr>
                                     
                                      <tr>                                     
                                      <th>product_image </th>                                     
                                      <td><img src='{$image}' style='height: 48px; width: 48px;'/> </td>

                                      </tr>

                                      <tr>                                     
                                      <th>price </th>                                     
                                      <td>{$product['price']}</td>
                                      </tr>                       
                                      </table>                         
                        </div>                     
                    ";                 
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
 
require_once('../inc/footer.php'); 
 
?>  