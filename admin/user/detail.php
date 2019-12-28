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
    				$query = "SELECT tbluser.id, tbluser.fullname, tbluser.email, tbluser.image, tblrole.name                         
    				FROM tbluser JOIN tblrole                         
    				ON tbluser.role_id = tblrole.id
                    WHERE tbluser.id = {$_GET['id']}";        
    				if($result = $conn->query($query))             
    					{                 
    						if($result->num_rows == 1)                 
    							{                     
    								$user = $result->fetch_assoc();                     
    								$image = USER_IMG.$user['image'];                     
    								echo "                         
    								<div class='col-md-offset-3 col-md-6'>                             
    								<h2 class=''text-center'>User Detail</h2>                             
    								<table style='border-collapse: collapse; width: 100%;' class='table table-hover'>                                 
    								<tr>                                     
    								<th>ID: </th>                                     
    								<td>{$user['id']}</td>                                 
    								</tr> 


    								 <tr>                                     
    								 <th>Fullname: </th>                                     
    								 <td>{$user['fullname']}</td>
    								 </tr>

    								 <tr>                                     
    								 <th>Email: </th>                                     
    								 <td>{$user['email']}</td> 
    								  </tr>

    								  <tr>                                     
    								  <th>Image: </th>                                     
    								  <td><img src='{$image}' alt='{$user['fullname']}' style='height: 48px; width: 48px;'/>
    								  </td>                                 
    								  </tr>
                                                                       
    								  <tr>                                     
    								  <th>name: </th>                                     
    								  <td>{$user['name']}</td>

    								  </tr>                             
    								  </table>                         
    					</div>                     
    				";                 
    			} 
    			else                 
    				{                     
    					set_flash('warning', '404 Not Found', 'Unable to find user.');                     
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